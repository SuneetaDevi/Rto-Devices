<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use App\Models\TenantStore;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DeviceProvisioning;

class CoreController extends Controller
{
    /**
     * Display the main tenant dashboard.
     */
    public function index()
    {
        // Get current tenant from middleware
        $tenant = app('currentTenant');
        $title = "Dashboard";

        // Example data fetching logic
        // $userCount = $tenant->users()->count();
        // $customerCount = $tenant->customers()->count();
        // $latestCustomers = $tenant->customers()->latest()->take(5)->get();

        // return view('tenant.dashboard', compact('tenant', 'userCount', 'customerCount', 'latestCustomers'));
        return view('tenant.contracts.home', compact('title'));
    }

    /**
     * Display the Device Management page.
     */
    public function devicemgmt()
    {
        return view('tenant.devicemgmt');
    }

    /**
     * Display the Inventory page.
     */
    public function inventory()
    {
        return view('tenant.inventory');
    }

    /**
     * Display the Enrollment page.
     */
    public function enrollment()
    {
        return view('tenant.enrollment');
    }

    /**
     * Display the general Reports landing page. (The detailed reports are in ReportController)
     */
    public function reports()
    {
        $title = "Reports";
        return view('tenant.reports', compact('title'));
    }

    /**
     * Display the Admin page.
     */
    public function admin()
    {
        return view('tenant.admin');
    }

    /**
     * Display the Support page.
     */
    public function support()
    {
        return view('tenant.support');
    }

    /**
     * Logic to switch the current active store.
     */
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

    /**
     * Display the Training page.
     */
    public function training()
    {
        $title = "Training";
        return view('tenant.training.index', compact('title'));
    }

    /**
     * Display the Referral page.
     */
    public function referral()
    {
        $title = "Referral Program";
        return view('tenant.referral.index', compact('title'));
    }

    /**
     * Display the Resources index page.
     */
    public function resources()
    {
        $title = "Resources";
        return view('tenant.resources.index', compact('title'));
    }

    /**
     * Display a specific Resources page by slug.
     * Note: $tenant_domain parameter is available but not used here due to routing structure.
     */
    public function resourcesPage($tenant_domain, $slug)
    {
        // $tenant_domain is implicitly available via the route
        $data['row'] = CustomPage::where('url_slug', $slug)->first();
        $data['title'] = $data['row']->title ?? '';
        // dd($slug);
        return view('tenant.resources.page', compact('slug', 'data'));
    }

    /**
     * Display the Device Provisioning page.
     */
    public function deviceProvisioning()
    {
        $title = "Device Provisioning";
        return view('tenant.provisioning.index', compact('title'));
    }

    /**
     * Display the Device Provisioning creation form.
     */
    public function deviceProvisioningCreate()
    {
        return view('tenant.provisioning.create');
    }

    public function deviceProvisioningStore(Request $request, $tenant_domain)
    {
        $request->validate([
            'store' => 'required|string|max:100',
            'devices' => 'required',
        ]);

        $devices = json_decode($request->devices, true);
        $batchId = strtoupper(Str::random(8));
        foreach ($devices as $item) {
            DeviceProvisioning::create([
                'batch_id' => $batchId,
                'status' => 'pending',
                'manufacturer' => null, // to be filled by api or other method
                'model' => null, // to be filled by api or other method
                'imei' => $item['imei'],
                'serial' => $item['serialNumber'] ?? null,
                'store' => app('currentStore')->store_name,
                'user_name' => auth()->user()->name,
                'date' => now()->toDateString(),
                'time' => now()->format('H:i:s'),
            ]);
        }

        return redirect()
            ->route('tenant.device-provisioning', $tenant_domain)
            ->with('success', 'Devices submitted for provisioning.');
    }

}