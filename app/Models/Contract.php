<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Session\Store;

class Contract extends Model
{
    protected $table = 'contracts';

    protected $guarded = [];
    // A contract belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    public function stores()
    {
        return $this->belongsTo(TenantStore::class, 'store_id');

    }

    // A contract has many documents
    public function documents()
    {
        return $this->hasMany(ContractDocument::class);
    }

    // Optional: Accessor for computed value stored in DB
    public function getTotalContractValueAttribute($value)
    {
        return $value ?? ($this->retail_value * $this->rental_factor);
    }


    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function paymentDates()
    {
        return $this->hasMany(ContractPaymentDate::class, 'contract_id');
    }

    // Accessor for billing_status
    public function getBillingStatusAttribute()
    {
        $payments = $this->paymentDates()->get();
        if ($payments->every(fn($p) => $p->status === 'paid')) {
            return 'Paid';
        }

        $latestPayment = $payments->sortByDesc('payment_date')->first();
        if ($latestPayment && $latestPayment->payment_date < now()->toDateString() && $latestPayment->status !== 'paid') {
            return 'Defaulted';
        }

        return 'Active';
    }

    // Accessor for paidTillNow
    public function getPaidTillNowAttribute()
    {
        return $this->paymentDates()->where('status', 'paid')->sum('amount');
    }

    // Accessor for paymentLeft
    public function getPaymentLeftAttribute()
    {
        $totalContractValue = $this->total_contract_value ?? 0;
        $rescheduleFees = $this->reschedule_fees ?? 0;
        $downPayment = $this->down_payment ?? 0;
        $paidTillNow = $this->paidTillNow ?? 0;

        return ($totalContractValue + $rescheduleFees + $downPayment) - $paidTillNow;
    }


    // Accessor for formatted downpayment
    public function getFormattedDownPaymentAttribute()
    {
        return $this->down_payment ? '$' . number_format($this->down_payment, 2) : '$0.00';
    }

    // Accessor for formatted paidTillNow
    public function getFormattedPaidTillNowAttribute()
    {
        return '$' . number_format($this->paidTillNow, 2);
    }

    // Accessor for formatted paymentLeft
    public function getFormattedPaymentLeftAttribute()
    {
        return '$' . number_format($this->paymentLeft, 2);
    }


    // In App\Models\Contract.php

    // Accessor for next due date
    public function getNextDueDateAttribute()
    {
        // Get all payment dates that are not paid yet
        $nextPayment = $this->paymentDates()
            ->where('status', '!=', 'paid')
            ->orderBy('payment_date', 'asc')
            ->first();

        if ($nextPayment) {
            return \Carbon\Carbon::parse($nextPayment->payment_date)->format('Y-m-d');
        }

        // If all are paid, return null or a default value
        return null;
    }

    public function getNextDueAmountAttribute()
    {
        $nextPayment = $this->paymentDates()
            ->where('status', '!=', 'paid')
            ->orderBy('payment_date', 'asc')
            ->first();

        if ($nextPayment) {
            return number_format($nextPayment->amount, 2);
        }

        return 0.00; // all paid
    }



    // In App\Models\Contract.php

    public function getLeaseTermStringAttribute()
    {
        $leaseOption = $this->lease_term; // e.g., w_12, b_10, m_36

        if (!$leaseOption) {
            return null;
        }

        $frequency = '';
        $termNumber = 0;

        if (str_starts_with($leaseOption, 'w_')) {
            $frequency = 'Weeks';
            $termNumber = (int) str_replace('w_', '', $leaseOption);
        } elseif (str_starts_with($leaseOption, 'b_')) {
            $frequency = 'Biweeks';
            $termNumber = (int) str_replace('b_', '', $leaseOption);
        } elseif (str_starts_with($leaseOption, 'm_')) {
            $frequency = 'Months';
            $termNumber = (int) str_replace('m_', '', $leaseOption);
        }

        return $termNumber > 0 ? "{$termNumber} {$frequency}" : null;
    }

}
