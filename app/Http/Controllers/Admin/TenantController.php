<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tenant;
use App\Models\TenantUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{
    //
    public function index()
    {
        $data['rows'] = Tenant::get();
        return view('admin.tenant.index', $data);
    }
    public function create()
    {
        return view('admin.tenant.create');
    }

    public function store(Request $request)
    {
        // Validate form input
        $this->validate($request, [
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:tenants,email',
            'subdomain' => 'required|string|max:100|unique:tenants,subdomain',
            'valid_till' => 'required|date|after:today',
        ]);

        DB::beginTransaction();

        try {
            // Create Tenant
            $tenant = new Tenant();
            $tenant->name = $request->name;
            $tenant->email = $request->email;
            $tenant->subdomain = strtolower($request->subdomain);
            $tenant->valid_till = $request->valid_till;
            $tenant->save();

            // Create Tenant User (if needed)
            $tenantUser = new TenantUser();
            $tenantUser->tenant_id = $tenant->id;
            $tenantUser->name = $request->name;
            $tenantUser->email = $request->email;
            $tenantUser->password = bcrypt('123456'); // default password or generate random
            $tenantUser->is_admin = true;
            $tenantUser->save();

            DB::commit();

            Toastr::success('Tenant created successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.tenant.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            // Log::error($e->getMessage());
            Toastr::error('An unexpected error occurred while creating tenant', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
    public function suspensionToggle(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($id);

        $tenant->status = !$tenant->status;
        $tenant->save();

        $message = $tenant->status ? 'Tenant Activated Successfully' : 'Tenant Suspended Successfully';
        Toastr::success($message, 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    public function users($id)
    {
        $data['users'] = TenantUser::where("tenant_id", $id)->get();
        $data['tenantId'] = $id;
        // dd($data);
        return view('admin.tenant.users', $data);
    }

    public function userchangePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6', // requires password_confirmation field
        ]);

        $user = TenantUser::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
        Toastr::success('Password updated successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }



    public function userStore(Request $request, $tenantId)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:tenant_users,email',
            'password' => 'required|string|min:6',
            'is_admin' => 'required|boolean',
        ]);

        // Make sure the tenant exists
        $tenant = Tenant::findOrFail($tenantId);

        // Create the user
        $user = new TenantUser();
        $user->tenant_id = $tenant->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = $request->is_admin;
        $user->save();

        Toastr::success('User added successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back(); // Back to tenant users page
    }

    public function userdestroy($id)
    {
        $user = TenantUser::findOrFail($id);

        // Count total users of the tenant
        $tenantUsersCount = TenantUser::where('tenant_id', $user->tenant_id)->count();
        if ($tenantUsersCount <= 1) {
            Toastr::error("Cannot delete the last user of the tenant", 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        // Count total admin users of the tenant
        $tenantAdminCount = TenantUser::where('tenant_id', $user->tenant_id)->where('is_admin', 1)->count();
        if ($user->is_admin && $tenantAdminCount <= 1) {
            Toastr::error("Cannot delete the last admin user of the tenant", 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        $user->delete();

        Toastr::success("User Deleted Successfully", 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }


}
