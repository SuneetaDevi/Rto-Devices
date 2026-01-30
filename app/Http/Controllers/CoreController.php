<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use App\Models\TenantStore;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DeviceProvisioning;
use Illuminate\Support\Facades\DB;

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

    public function editDevice($id)
    {
        $device = DeviceProvisioning::findOrFail($id);
        return view('tenant.provisioning.edit', compact('device'));
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

        $store = app('currentStore');

        if (!$store) {
            abort(403, 'Store not selected');
        }

        // Fetch batches from existing table
        $batches = DeviceProvisioning::where('store', $store->store_name)
            ->select(
                'batch_id',
                DB::raw('MIN(status) as status'),
                DB::raw('MIN(device_type) as device_type'),
                DB::raw('MIN(manufacturer) as manufacturer'),
                DB::raw('MIN(model) as model'),
                DB::raw('MIN(imei) as imei'),
                DB::raw('MIN(serial) as serial'),
                DB::raw('MIN(user_name) as user'),
                DB::raw('MIN(date) as date'),
                DB::raw('MIN(time) as time')
            )
            ->groupBy('batch_id')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($batch) use ($store) {

                $isPending = $batch->status === 'pending';

                return [
                    'id' => $batch->batch_id,
                    'status' => $isPending
                        ? 'Pending Initial Verification'
                        : 'Device Provisioned',

                    'status_class' => $isPending
                        ? 'pending'
                        : 'provisioned',

                    'manufacturer' => $batch->manufacturer ?? '-',
                    'model' => $batch->model ?? '-',
                    'imei' => $batch->imei,
                    'serial' => $batch->serial ?? '-',
                    'store' => 'Site ' . $store->id,
                    'user' => $batch->user,
                    'date' => $batch->date,
                    'time' => $batch->time,
                ];
            });

        return view('tenant.provisioning.index', compact('title', 'batches'));
    }

    /**
     * Display the Device Provisioning creation form.
     */
    public function deviceProvisioningCreate()
    {
        return view('tenant.provisioning.create');
    }

    public function deviceProvisioningVerify($batch)
    {
        $devices = DeviceProvisioning::where('batch_id', $batch)
            ->where('status', 'pending')
            ->get();

        return view('tenant.provisioning.verify', compact('devices', 'batch'));
    }

    public function verifyProvisionedDevice($id)
    {
        DeviceProvisioning::where('id', $id)->update([
            'status' => 'verified'
        ]);

        return back()->with('success', 'Device verified successfully');
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
            'batch_id'     => $batchId,
            'status'       => 'pending',
            'device_type'  => $item['deviceType'],
            'manufacturer' => null,
            'model'        => null,
            'imei'         => $item['imei'],
            'serial'       => $item['serialNumber'] ?? null,
            'store'        => app('currentStore')->store_name,
            'user_name'    => auth()->user()->name,
            'date'         => now()->toDateString(),
            'time'         => now()->format('H:i:s'), // ✅ FIXED FORMAT
        ]);
    }

    return redirect()
        ->route('tenant.device-provisioning', $tenant_domain)
        ->with('success', 'Devices submitted for provisioning.');
}


}