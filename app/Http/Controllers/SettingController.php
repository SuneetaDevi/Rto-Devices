<?php

namespace App\Http\Controllers;

use App\Models\TenantUser;
use App\Models\TenantStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Display the main Settings landing page (mapped to tenant.setting).
     */
    public function index()
    {
        return view('tenant.settings.index');
    }

    // --- Store Settings ---

    /**
     * Display the list of stores (mapped to tenant.setting.stores).
     */
    public function storesIndex()
    {
        $data['title'] = "Stores";
        $tenant = app('currentTenant');
        $data['rows'] = TenantStore::with(['tenant', 'accountManager', 'dealerManager'])
            ->where('tenant_id', $tenant->id)
            ->get();
        return view('tenant.settings.stores', $data);
    }

    /**
     * Display the form to edit a specific store (mapped to tenant.setting.stores.edit).
     * The $store parameter corresponds to the store ID.
     */
    public function editStore($tenant_domain, $storeId)
    {
        // $tenant_domain is implicitly available via the route
        $tenant = app('currentTenant');
        $store = TenantStore::where('tenant_id', $tenant->id)->findOrFail($storeId);
        $tenantUsers = TenantUser::where('tenant_id', $tenant->id)->get();

        return view('tenant.settings.update_store', compact('store', 'tenantUsers'));
    }

    /**
     * Handle the update of a specific store (mapped to tenant.setting.stores.update).
     */
    public function updateStore(Request $request, $storeId)
    {
        // $tenant_domain is implicitly available via the route
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

    // --- User Settings ---

    /**
     * Display the list of users (mapped to tenant.setting.users).
     */
    public function usersIndex()
    {
        $data['title'] = "User";
        $tenant = app('currentTenant');
        $data['rows'] = TenantUser::where('tenant_id', $tenant->id)->with('tenant', 'stores')->get();
        // dd($data['rows'][0]);
        return view('tenant.settings.users', $data);
    }



    /**
     * Display the form to create a new user (mapped to tenant.setting.users.create).
     */
    public function usersCreate()
    {
        $stores = app('currentTenant')->stores()->get();
        $data['stores'] = $stores;

        return view('tenant.settings.create_user', $data);
    }

    public function usersStore(Request $request)
    {

        $tenant = app('currentTenant'); // current tenant from app container

        // Validate input
        $request->validate([
            'email' => 'required|email|unique:tenant_users,email',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'username' => 'nullable|string|max:255|unique:tenant_users,username',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'timezone' => 'nullable|string|max:50',
            'role' => 'nullable|in:COMPANY_ADMIN,STORE_USER,STORE_MANAGER',
            'store' => 'nullable',
            'status' => 'nullable|in:ACTIVE,INACTIVE',
        ]);

        // Generate a random password if not provided
        // $password = $request->password ?? \Illuminate\Support\Str::random(8);
        $password = "12345678";

        // Create Tenant User
        $user = TenantUser::create([
            'tenant_id' => $tenant->id,
            'email' => $request->email,
            'name' => $request->first_name . " " . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone_full,
            'username' => $request->username,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'zip' => $request->zip,
            'city' => $request->city,
            'state' => $request->state,
            'timezone' => $request->timezone,
            'role' => $request->role,
            'store_id' => $request->store,
            'status' => $request->status,
            'is_admin' => $request->role === 'COMPANY_ADMIN' ? 1 : 0,
            'password' => Hash::make($password),
        ]);

        // Optionally, send welcome email
        // Mail::to($user->email)->send(new TenantUserWelcomeMail($user, $password));

        return redirect()->route('tenant.setting.users', $tenant->subdomain)
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the form to update an existing user (mapped to tenant.setting.users.update).
     * Renamed parameter from $latestCustomersid to $id for clarity.
     */
    public function usersEdit($tenant_domain, $id)
    {
        $tenant = app('currentTenant');
        $data['user'] = TenantUser::where('tenant_id', $tenant->id)->find($id);
        $data['stores'] = $tenant->stores()->get();
        // dd($data);
        return view('tenant.settings.update_user', $data);
    }

    public function usersUpdate(Request $request, $tenant_domain, $id)
    {
        $tenant = app('currentTenant'); // current tenant
        $user = TenantUser::find($id);
        // Make sure the user belongs to this tenant
        if ($user->tenant_id !== $tenant->id) {

            return redirect()->back()->with('error', 'User does not belong to your tenant.');
        }

        // Validate input
        $request->validate([
            'email' => 'required|email|unique:tenant_users,email,' . $user->id,
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'username' => 'nullable|string|max:255|unique:tenant_users,username,' . $user->id,
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'timezone' => 'nullable|string|max:50',
            'role' => 'nullable|in:COMPANY_ADMIN,STORE_USER,STORE_MANAGER',
            'status' => 'nullable|in:ACTIVE,INACTIVE',
        ]);

        try {
            //code...
            // Update fields
            $user->update([
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'username' => $request->username,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'zip' => $request->zip,
                'city' => $request->city,
                'state' => $request->state,
                'timezone' => $request->timezone,
                'role' => $request->role,
                'status' => $request->status,
                'is_admin' => $request->role === 'COMPANY_ADMIN' ? 1 : 0,
            ]);

            return redirect()->route('tenant.setting.users', $tenant->subdomain)
                ->with('success', 'User updated successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return redirect()->back()->with('error', 'User not updated');
        }

    }
}
