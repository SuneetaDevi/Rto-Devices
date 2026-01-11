<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\ContractDocument;
use App\Models\ContractPaymentDate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\ContractDocumentUploadMail;
use App\Mail\VerifyEmailOtpMarkdown;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContractController extends Controller
{
    // Constants for better maintainability
    const DOCUMENT_TYPES = ['id_front', 'id_back', 'customer'];
    const PAYMENT_FREQUENCIES = ['weekly', 'biweekly', 'monthly'];
    const DEFAULT_TAX_RATE = 0.0635;
    const PROCESSING_FEE = 5.00;


    private function findContractOrFail(string $pub_ref): Contract
    {
        $contract = Contract::where('pub_ref', $pub_ref)
            ->where('tenant_id', $this->tenant()->id)
            ->where('store_id', $this->store()->id)
            ->firstOrFail();

        return $contract;
    }


    private function tenant()
    {
        return app('currentTenant');
    }

    private function store()
    {
        return app('currentStore');
    }

    /**
     * Display the main Contract landing page
     */
    public function index()
    {
        // Using with() to prevent N+1 queries
        $contracts = Contract::where('tenant_id', $this->tenant()->id)
            ->where('store_id', $this->store()->id)
            ->with(['tenant', 'stores', 'customer'])
            ->get();
        $title = "Contract";

        return view('tenant.contracts.index', ['contracts' => $contracts, 'title' => $title]);
    }

    /**
     * Display the Contract search page
     */
    public function search()
    {
        return view('tenant.contracts.search');
    }

    /**
     * Display the details for a specific contract
     */
    public function details($tenant_domain, $pub_ref)
    {
        // dd($pub_ref);
        $contract = $this->findContractOrFail($pub_ref);
        $contract->load(['customer']); // Eager load customer relationship

        return view("tenant.contracts.details", ['contract' => $contract]);
    }

    /**
     * Display the first step of the contract creation form
     */
    public function create()
    {
        $stores = $this->tenant()->stores()->get();
        $currentUserStoreId = $this->store()->id;

        return view('tenant.contracts.create', compact('stores', 'currentUserStoreId'));
    }

    // === Contract Creation Steps ===

    /**
     * Step 1: Initialize contract
     */
    public function step1(Request $request, $tenant_domain)
    {
        try {
            if ($request->isMethod('post')) {
                $contract = $this->createNewContract($request);
            } else {
                // This also needs to be scoped to the current tenant/store
                $contract = Contract::where('pub_ref', $request->id)
                    ->where('tenant_id', $this->tenant()->id)
                    ->where('store_id', $this->store()->id)
                    ->firstOrFail();
            }

            return view('tenant.contracts.step1', compact('contract'));
        } catch (\Throwable $th) {
            Log::error('Step1 Contract Creation Error: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Failed to create contract.');
        }
    }

    /**
     * Step 2: Device information
     */
    public function step2(Request $request, $tenant_domain, $pub_ref)
    {
        $contract = $this->findContractOrFail($pub_ref);

        if ($request->isMethod('post')) {
            try {
                $contract->update([
                    'imei_serial' => $request->imei_serial,
                    'is_device_lock_installed' => (bool) $request->is_device_lock_installed
                ]);
            } catch (\Throwable $th) {
                Log::error("Error in step2: " . $th->getMessage());
                return back()->with('error', 'Failed to save IMEI/Serial.');
            }
        }

        return view('tenant.contracts.step2', compact('contract'));
    }

    /**
     * Address verification API
     */
    public function step2addressVerify(Request $request, $tenant_domain, $pub_ref)
    {
        // Verify contract exists before proceeding
        $this->findContractOrFail($pub_ref);
        $request->validate(['address' => 'required|string|max:255']);

        // In a real implementation, you would call an address verification API here
        return response()->json([
            'success' => true,
            'message' => 'Address verified successfully',
            'data' => ['address' => $request->address]
        ]);
    }

    /**
     * Email verification - send OTP
     */
    public function step2EmailVerify(Request $request, $tenant_domain, $pub_ref)
    {
        // Verify contract exists before proceeding
        $this->findContractOrFail($pub_ref);
        $request->validate(['email' => 'required|email']);

        $otp = rand(100000, 999999);
        $email = $request->email;

        // Store OTP temporarily with expiration
        Cache::put("email_otp_{$email}", $otp, now()->addMinutes(10));

        // Send verification email
        Mail::to($email)->send(new VerifyEmailOtpMarkdown($otp));

        return response()->json([
            'success' => true,
            'message' => 'Verification email sent',
            'email' => $email
        ]);
    }

    /**
     * Email verification - confirm OTP
     */
    public function step2EmailVerifyConfirm(Request $request, $tenant_domain, $pub_ref)
    {
        // Verify contract exists before proceeding
        $this->findContractOrFail($pub_ref);
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        $email = $request->email;
        $cachedOtp = Cache::get("email_otp_{$email}");

        if (!$cachedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired or not found'
            ], 422);
        }

        if ($cachedOtp != $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 422);
        }

        // Clear OTP from cache
        Cache::forget("email_otp_{$email}");

        try {
            Contract::where('pub_ref', $pub_ref)->update(['verification_method' => 'email']);
        } catch (\Throwable $th) {
            Log::error("Contract Error: " . $th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update contract'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Email successfully verified'
        ]);
    }

    /**
     * Step 3: Customer information
     */
    public function step3(Request $request, $tenant_domain, $pub_ref)
    {
        $contract = $this->findContractOrFail($pub_ref);

        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'first_name' => 'nullable|string',
                'last_name' => 'nullable|string',
                'phone' => 'nullable|string',
                'dob' => 'nullable|date',
                'ssn' => 'nullable|string',
                'address' => 'nullable|string',
                'suite' => 'nullable|string',
                'zip' => 'nullable|string',
                'city' => 'nullable|string',
                'state' => 'nullable|string',
                'email' => 'nullable|email',
                'document_type' => 'nullable|string',
                'document_state' => 'nullable|string',
                'document_number' => 'nullable|string',
            ]);

            try {
                $this->saveCustomerData($contract, $validatedData);
            } catch (\Throwable $th) {
                return back()->withErrors(['error' => 'Unable to save data: ' . $th->getMessage()]);
            }
        }

        $contractDocs = ContractDocument::where('contract_id', $contract->id)
            ->pluck('file_path', 'document_type');

        return view('tenant.contracts.step3', [
            'contract' => $contract,
            'contractDocuments' => $contractDocs,
            'contractDocumentsCount' => $contractDocs->count(),
            'customer' => $contract->customer,
        ]);
    }

    /**
     * Request document upload
     */
    public function documentRequest(Request $request, $tenant_domain, $pub_ref)
    {
        $contract = $this->findContractOrFail($pub_ref);

        $request->validate([
            'document_type' => 'required',
            'document_state' => 'required',
            'document_number' => 'required',
            'via' => 'required|in:phone,email',
            'value' => 'required',
        ]);

        try {
            // Update contract with ID info
            $contract->update([
                'document_type' => $request->document_type,
                'document_state' => $request->document_state,
                'document_number' => $request->document_number
            ]);

            // Send notification
            if ($request->via == "phone") {
                // SMS implementation would go here
                // SmsService::send($request->value, "Upload your ID here: https://domain.com/upload/$pub_ref");
            } else {
                Mail::to($request->value)->send(new ContractDocumentUploadMail($contract));
            }

            return response()->json([
                'success' => true,
                'pub_ref' => $contract->pub_ref,
                'message' => 'Upload link sent successfully.',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Check uploaded documents
     */
    public function checkUploadedDocs(Request $request, $tenant_domain, $pub_ref)
    {
        $contract = $this->findContractOrFail($pub_ref);

        $files = [];
        $uploadedCount = 0;

        foreach (self::DOCUMENT_TYPES as $type) {
            $doc = ContractDocument::where('contract_id', $contract->id)
                ->where('document_type', $type)
                ->where('is_uploaded', 1)
                ->first();

            if ($doc) {
                $uploadedCount++;
                $files[$type] = asset($doc->file_path);
            } else {
                $files[$type] = null;
            }
        }

        return response()->json([
            'success' => true,
            'uploaded' => $uploadedCount,
            'files' => $files,
        ]);
    }

    /**
     * Step 4: Contract terms
     */
    public function step4(Request $request, $tenant_domain, $pub_ref)
    {
        $contract = $this->findContractOrFail($pub_ref);
        return view('tenant.contracts.step4', compact('contract'));
    }

    /**
     * Step 5: Contract details
     */
    public function step5(Request $request, $tenant_domain, $pub_ref)
    {
        $contract = $this->findContractOrFail($pub_ref);

        if ($request->isMethod('post')) {
            $contract->update([
                'retail_value' => $request->input('retail_value'),
                'down_payment' => $request->input('down_payment'),
                'rental_factor' => $request->input('rental_factor'),
                'merchandise_condition' => $request->input('merchandise_condition'),
                'early_payoff_policy' => $request->input('early_payoff_policy'),
                'merchandise_description' => $request->input('merchandise_description'),
                'lease_term' => $request->input('lease_payment'),
                'day_of_week' => $request->input('day_of_week'),
                'first_payment_date' => $request->input('start_date'),
            ]);
        }

        return view('tenant.contracts.step5', compact('contract'));
    }

    /**
     * Step 6: Payment schedule
     */
    public function step6(Request $request, $tenant_domain, $pub_ref)
    {
        $contract = $this->findContractOrFail($pub_ref);

        if ($request->isMethod('post')) {
            $this->generatePaymentSchedule($contract, $request);
        }

        return view('tenant.contracts.step6', compact('contract'));
    }

    /**
     * Step 7: Payment processing
     */
    public function step7(Request $request, $tenant_domain, $pub_ref)
    {
        $contract = $this->findContractOrFail($pub_ref);

        if ($request->isMethod('post')) {
            $paymentMethod = $request->payment_method ?? 'cash';
            $contract->update(['payment_method' => $paymentMethod]);

            if ($paymentMethod === 'cash') {
                $this->processCashPayment($contract);
                return redirect()->route('tenant.contract.step8', [$tenant_domain, $contract->pub_ref]);
            }
        }

        $amount = $this->calculatePaymentAmount($contract);
        return view('tenant.contracts.step7', compact('contract', 'amount'));
    }

    /**
     * Process Stripe payment
     */
    public function processStripePayment(Request $request, $tenant_domain, $pub_ref)
    {
        $contract = $this->findContractOrFail($pub_ref);

        $request->validate(['payment_method_id' => 'required|string']);

        $amount = $this->calculatePaymentAmount($contract);
        $paymentMethodId = $request->payment_method_id;

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => round($amount * 100),
                'currency' => 'usd',
                'payment_method' => $paymentMethodId,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never'
                ],
                'confirm' => true,
            ]);

            $this->updatePaymentStatus($contract, $paymentIntent);

            return redirect()->route('tenant.contract.step8', [
                'tenant_domain' => $tenant_domain,
                'pub_ref' => $pub_ref
            ]);

        } catch (\Exception $e) {
            return back()->withErrors(['payment_error' => $e->getMessage()]);
        }
    }

    /**
     * Step 8: Contract completion
     */
    public function step8(Request $request, $tenant_domain, $pub_ref)
    {
        $contract = $this->findContractOrFail($pub_ref);

        if ($request->isMethod('post')) {
            return redirect()->route('tenant.contract.details', [
                'tenant_domain' => $tenant_domain,
                'pub_ref' => $pub_ref
            ]);
        }

        return view('tenant.contracts.step8', compact('contract'));
    }

    // === Helper Methods ===

    /**
     * Create a new contract with unique reference
     */
    private function createNewContract(Request $request)
    {
        // Generate unique reference
        do {
            $pubRef = random_int(10000000, 99999999);
        } while (Contract::where('pub_ref', $pubRef)->exists());

        return Contract::create([
            'tenant_id' => $this->tenant()->id,
            'store_id' => $request->store_id, // Assumes store_id is validated and belongs to tenant
            'contract_type' => $request->contract_action,
            'pub_ref' => $pubRef
        ]);
    }

    /**
     * Save or update customer data
     */
    private function saveCustomerData(Contract $contract, array $data)
    {
        DB::transaction(function () use ($contract, $data) {
            // Create or update customer
            if ($contract->customer) {
                $contract->customer->update($data);
            } else {
                $data['tenant_id'] = $this->tenant()->id;
                $customer = Customer::create($data);
                $contract->customer_id = $customer->id;
            }

            // Update contract document info
            $contract->update([
                'document_type' => $data['document_type'] ?? $contract->document_type,
                'document_state' => $data['document_state'] ?? $contract->document_state,
                'document_number' => $data['document_number'] ?? $contract->document_number,
            ]);
        });
    }

    /**
     * Reschedule an existing contract by creating a new one and generating a new payment schedule.
     */
    public function reschedule(Request $request, $tenant_domain)
    {
        $request->validate([
            'rescheduleFee' => 'required|numeric',
            'tax' => 'required|numeric',
            'paymentFee' => 'required|numeric',
            'totalPayableToday' => 'required|numeric',
            'newContractfee' => 'required|numeric',
            'paymentDay' => 'required|string',
            'startDate' => 'required|date',
            'paymentOption' => 'required|string',
            'contract_id' => 'required|string', // The pub_ref of the original contract
        ]);

        // Find original contract
        $originalContract = $this->findContractOrFail($request->contract_id);

        DB::transaction(function () use ($request, $originalContract) {
            // 1. Create new contract by copying original
            $newContract = $originalContract->replicate();
            unset($newContract->total_contract_value);

            $newContract->status = 'active';
            $newContract->reschedule_of = $originalContract->pub_ref;

            $originalPubRef = $originalContract->pub_ref;

            // Count existing reschedules
            $count = Contract::where('reschedule_of', $originalPubRef)->count() + 1;

            // New pub_ref
            $newPubRef = $originalPubRef . '_' . $count;
            $newContract->pub_ref = $newPubRef;

            // 3. Update new contract with reschedule info
            $newContract->reschedule_fee = $request->rescheduleFee;
            $newContract->reschedule_date = now()->toDateString();
            $newContract->reschedule_cost = $request->totalPayableToday;

            // $newContract->payment_day = $request->paymentDay;
            $newContract->first_payment_date = $request->startDate;
            $newContract->payment_method = $request->paymentOption;

            $newContract->save();

            // 4. Update original contract
            $originalContract->status = 'rescheduled';
            $originalContract->rescheduled_to = $newContract->pub_ref;
            $originalContract->reschedule_date = now()->toDateString();
            $originalContract->save();

            // 5. Generate payment schedule for the new contract
            $paymentRequest = new Request([
                'payment_method' => 'cash',
            ]);
            $this->generatePaymentSchedule($newContract, $paymentRequest);
        });

        return redirect()->back()->with('success', 'Contract successfully rescheduled!');
    }


    private function generatePaymentSchedule(Contract $contract, Request $request)
    {
        DB::transaction(function () use ($contract, $request) {
            // Detect lease term & frequency
            $leaseOption = $contract->lease_term;
            $frequency = 'weekly';
            $termMonths = 12;

            if ($leaseOption) {
                if (str_starts_with($leaseOption, 'w_')) {
                    $frequency = 'weekly';
                    $termMonths = (int) str_replace('w_', '', $leaseOption);
                } elseif (str_starts_with($leaseOption, 'b_')) {
                    $frequency = 'biweekly';
                    $termMonths = (int) str_replace('b_', '', $leaseOption);
                } elseif (str_starts_with($leaseOption, 'm_')) {
                    $frequency = 'monthly';
                    $termMonths = (int) str_replace('m_', '', $leaseOption);
                }
            }

            // First payment date
            $startDate = $contract->first_payment_date
                ? Carbon::parse($contract->first_payment_date)
                : now();

            // Number of payments
            $paymentsCount = match ($frequency) {
                'weekly' => $termMonths * 4,
                'biweekly' => $termMonths * 2,
                'monthly' => $termMonths,
                default => $termMonths * 4
            };

            // Calculate payment amounts
            $retailValue = $contract->retail_value;
            $downPayment = $contract->down_payment;
            $rentalFactor = $contract->rental_factor;

            // Total amount to be financed (excluding down payment)
            $contractValue = ($retailValue - $downPayment) * $rentalFactor;

            // Calculate periodic payment amount for subsequent payments
            $periodicPayment = match ($frequency) {
                'weekly' => $contractValue / ($termMonths * 4), // Weekly payment
                'biweekly' => $contractValue / ($termMonths * 2), // Biweekly payment
                'monthly' => $contractValue / $termMonths, // Monthly payment
                default => $contractValue / ($termMonths * 4), // Default to weekly
            };

            // Payment method
            $paymentMethod = $request->payment_method ?? 'cash';

            $contract->update(['payment_frequency' => $frequency]);

            // Generate payment dates
            $dates = [];
            $currentDate = $startDate->copy();

            // First payment is the down payment
            $dates[] = [
                'contract_id' => $contract->id,
                'payment_date' => $currentDate->format('Y-m-d'),
                'payment_method' => $paymentMethod ?? "cash",
                'amount' => round($downPayment, 2), // Down payment amount
                'tax_amount' => $downPayment * self::DEFAULT_TAX_RATE,
                'service_charge' => 5,
                'status' => 'pending',
                'transaction_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Move to next date for subsequent payments
            $currentDate->add(
                new \DateInterval(match ($frequency) {
                    'weekly' => 'P1W',
                    'biweekly' => 'P2W',
                    'monthly' => 'P1M',
                    default => 'P1W',
                })
            );

            // Generate subsequent payments
            for ($i = 1; $i < $paymentsCount; $i++) {
                $dates[] = [
                    'contract_id' => $contract->id,
                    'payment_date' => $currentDate->format('Y-m-d'),
                    'payment_method' => $paymentMethod,
                    'amount' => round($periodicPayment, 2), // Rounded to 2 decimal places
                    'tax_amount' => round($periodicPayment * self::DEFAULT_TAX_RATE),
                    'service_charge' => 5,
                    'status' => 'pending',
                    'transaction_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Move to next date based on frequency
                $currentDate->add(
                    new \DateInterval(match ($frequency) {
                        'weekly' => 'P1W',
                        'biweekly' => 'P2W',
                        'monthly' => 'P1M',
                        default => 'P1W',
                    })
                );
            }

            // Insert payment dates
            ContractPaymentDate::insert($dates);
        });
    }

    /**
     * Calculate payment amount with tax and fees
     */
    private function calculatePaymentAmount(Contract $contract): float
    {
        $base = $contract->down_payment;
        $tax = $base * self::DEFAULT_TAX_RATE;
        $fee = self::PROCESSING_FEE;
        return round($base + $tax + $fee, 2);
    }

    /**
     * Process cash payment
     */
    private function processCashPayment(Contract $contract)
    {
        $firstPending = ContractPaymentDate::where('contract_id', $contract->id)
            ->where('status', 'pending')
            ->orderBy('payment_date')
            ->first();

        if ($firstPending) {
            $firstPending->update([
                'status' => 'paid',
                'payment_method' => 'cash',
                'transaction_id' => null,
            ]);
        }
    }

    /**
     * Update payment status after Stripe payment
     */
    private function updatePaymentStatus(Contract $contract, \Stripe\PaymentIntent $paymentIntent)
    {
        DB::transaction(function () use ($contract, $paymentIntent) {
            $firstPending = ContractPaymentDate::where('contract_id', $contract->id)
                ->where('status', 'pending')
                ->orderBy('payment_date')
                ->first();

            if ($firstPending) {
                $firstPending->update([
                    'status' => $paymentIntent->status === 'succeeded' ? 'paid' : 'pending',
                    'payment_method' => 'credit_card',
                    'transaction_id' => $paymentIntent->id,
                ]);
            }

            // Update contract payment method if empty
            if (!$contract->payment_method) {
                $contract->update(['payment_method' => 'card']);
            }
        });
    }
}
