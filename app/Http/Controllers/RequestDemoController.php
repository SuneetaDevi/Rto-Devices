<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\TenantStore;
use App\Models\TenantUser;
use App\Models\RequestDemo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\TenantWelcomeMail;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class RequestDemoController extends Controller
{
    public function index()
    {
        $data['title'] = "Request Demo";
        $data['requests'] = RequestDemo::all(); // Fetch all demo requests

        return view('admin.request_demo.index', $data); // fixed from `request()` to `view()`
    }


    public function approve(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:request_demos,id'
        ]);

        DB::beginTransaction();

        try {


            // 🚫 Block if mail is not configured
            if (
                empty(config('mail.mailers.smtp.host')) ||
                empty(config('mail.mailers.smtp.username')) ||
                empty(config('mail.mailers.smtp.password')) ||
                empty(config('mail.from.address'))
            ) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Email service is not configured yet. Please set up the mail configuration before approving this request.'
                ], 422);
            }

            $rid = $request->id;
            $demo = RequestDemo::findOrFail($rid);
            $demo->status = 1;
            $demo->save();

            // Create tenant
            $tenant = Tenant::create([
                'name' => $demo->company_name,
                'email' => $demo->email,
                'valid_till' => now()->addDays(30),
                'subdomain' => Str::slug($demo->company_name)
            ]);

            // Generate password and create tenant admin user
            $password = Str::random(8);
            $tenantUser = TenantUser::create([
                'tenant_id' => $tenant->id,
                'name' => $demo->first_name . ' ' . $demo->last_name,
                'email' => $demo->email,
                'is_admin' => 1,
                'password' => Hash::make($password)
            ]);

            // Create initial tenant stores based on number_of_stores
            $numberOfStores = $demo->number_of_stores ?? 1; // fallback to 1 if null
            $primaryStore = null;

            for ($i = 1; $i <= $numberOfStores; $i++) {
                 $store = TenantStore::create([
                    'tenant_id' => $tenant->id,
                    'store_name' => $demo->company_name . ' Store ' . $i,
                    'dealer_manager_id' => $i === 1 ? $tenantUser->id : null,
                    'account_manager_id' => $i === 1 ? $tenantUser->id : null,
                    // optional fields can be added here if you want, e.g. city, state, etc.
                ]);

                if ($i === 1) {
                    $primaryStore = $store;
                }
            }

            if ($primaryStore) {
                $tenantUser->update([
                    'store_id' => $primaryStore->id
                ]);
            }

            // Send welcome email
            $loginUrl = route('tenant.login', ['tenant_domain' => $tenant->subdomain]);
            Mail::to($tenantUser->email)->send(new TenantWelcomeMail($tenant, $tenantUser, $password, $loginUrl));

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Tenant created and user approved successfully.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {

        DB::beginTransaction();
        try {
            $contact = RequestDemo::find($id);
            $contact->delete();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(__('Unable to delete request demo'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.request-demo.index');
        }
        DB::commit();
        Toastr::success(__('Request Demo deleted successfully'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.request-demo.index');
    }

}
