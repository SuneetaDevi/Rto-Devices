<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use App\Models\TenantUser;
use App\Models\TenantStore;
use Illuminate\Http\Request;

class TenantDashboardController extends Controller
{
    // Apply middleware if not already applied in routes
    public function __construct()
    {
        $this->middleware(['auth:tenant', 'identify.tenant']);
    }

    /**
     * Show the tenant dashboard.
     */
    public function index($tenant_domain)
    {
        // Get current tenant from middleware
        $tenant = app('currentTenant');

        // Example data: number of users and customers
        $userCount = $tenant->users()->count();
        $customerCount = $tenant->customers()->count();

        // Example: list of latest 5 customers
        $latestCustomers = $tenant->customers()->latest()->take(5)->get();

        // Pass data to the dashboard view
        // return view('tenant.dashboard', compact(
        //     'tenant',
        //     'userCount',
        //     'customerCount',
        //     'latestCustomers'
        // ));
        return view('tenant.contracts.home');


    }
    public function devicemgmt()
    {
        return view('tenant.devicemgmt');
    }
    public function inventory()
    {
        return view('tenant.inventory');
    }
    public function enrollment()
    {
        return view('tenant.enrollment');
    }
    public function reports()
    {
        return view('tenant.reports');
    }
    public function admin()
    {
        return view('tenant.admin');
    }
    public function support()
    {
        return view('tenant.support');
    }

    public function switchStore(Request $request)
    {
        $storeId = $request->query('store');
        $tenant = app('currentTenant');

        $store = $tenant->stores()->where('id', $storeId)->first();

        if (!$store) {
            return redirect()->back()->with('error', 'Store not found or does not belong to your tenant.');
        }

        session(['current_store_id' => $store->id]);

        app()->instance('currentStore', $store);

        return redirect()->back()->with('success', 'Switched to store: ' . $store->store_name);
    }



    public function training()
    {
        return view('tenant.training.index');
    }
    public function referral()
    {
        return view('tenant.referral.index');
    }
    public function resources()
    {
        return view('tenant.resources.index');
    }


    public function resourcesPage($tenant_domain, $slug)
    {
        $data['row'] = CustomPage::where('url_slug', $slug)->first();
        // dd($data['row'], $slug);
        return view('tenant.resources.page', compact('slug', 'data'));
    }

    public function setting()
    {
        return view('tenant.settings.index');
    }
    public function settingStores()
    {
        $tenant = app('currentTenant');
        $data['rows'] = TenantStore::with(['tenant', 'accountManager', 'dealerManager'])
            ->where('tenant_id', $tenant->id)
            ->get();
        // dd($data['rows']);
        return view('tenant.settings.stores', $data);
    }
    public function editStore($tenant_domain, $storeId)
    {

        $tenant = app('currentTenant');
        $store = TenantStore::where('tenant_id', $tenant->id)->findOrFail($storeId);
        $tenantUsers = TenantUser::where('tenant_id', $tenant->id)->get();

        return view('tenant.settings.update_store', compact('store', 'tenantUsers'));
    }

    public function updateStore(Request $request, $tenant_domain, $storeId)
    {
        $tenant = app('currentTenant');
        $store = TenantStore::where('tenant_id', $tenant->id)->findOrFail($storeId);

        $store->update($request->only([
            'store_name',
            'phone',
            'email',
            'address',
            'city',
            'state',
            'dealer_manager_id',
            'account_manager_id',
            'zip'
        ]));

        return redirect()->route('tenant.setting.stores', [$tenant->subdomain])->with('success', 'Store updated successfully!');
    }

    public function settingUsers()
    {
        return view('tenant.settings.users');
    }
    public function settingUsersCreate()
    {
        return view('tenant.settings.create_user');
    }
    public function settingUsersUpdate($latestCustomersid)
    {
        return view('tenant.settings.update_user');
    }





    public function report()
    {
        return view('tenant.report.index');
    }
    public function reportPortfolio()
    {
        return view('tenant.report.portfolio');
    }
    public function reportsales()
    {
        return view('tenant.report.sales');
    }
    public function reportpayment()
    {
        return view('tenant.report.payment');
    }
    public function reportdealercontractreconciliation()
    {
        return view('tenant.report.dealer_contract');
    }

    public function reportdetailedportfolio()
    {
        return view('tenant.report.detailed_portfolio');
    }
    public function deviceProvisioning()
    {
        return view('tenant.provisioning.index');
    }

    public function deviceProvisioningCreate()
    {
        return view('tenant.provisioning.create');
    }


    public function step1($tenant_domain, Request $request)
    {
        // dd($request->all());
        return view('tenant.contracts.step1');
    }

    public function step2($tenant_domain)
    {
        return view('tenant.contracts.step2');
    }

    public function step3($tenant_domain)
    {
        return view('tenant.contracts.step3');
    }

    public function step4($tenant_domain)
    {
        return view('tenant.contracts.step4');
    }

    public function step5($tenant_domain)
    {
        return view('tenant.contracts.step5');
    }

    public function step6($tenant_domain)
    {
        return view('tenant.contracts.step6');
    }


    public function contract()
    {
        return view('tenant.contracts.index');
    }
    public function contractSearch()
    {
        return view('tenant.contracts.search');
    }
    public function contractCreate()
    {
        return view('tenant.contracts.create');
    }
    public function contractIndex()
    {
        return view('tenant.contracts.index');
    }
    public function contractDetails($id)
    {
        return view("tenant.contracts.details");
    }
}