<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantAuthController extends Controller
{
    //
    public function showLoginForm($tenant_domain)
    {
        // Check if already logged in with tenant guard
        if (auth()->guard('tenant')->check()) {
            $tenant = auth()->guard('tenant')->user()->tenant; // get current tenant

            if ($tenant && $tenant->subdomain) {
                return redirect()->route('tenant.dashboard', ['tenant_domain' => $tenant->subdomain]);
            }
        }
        return view('tenant.auth.login', compact('tenant_domain'));
    }

    public function login(Request $request, $tenant_domain)
    {
        $tenant = \App\Models\Tenant::where('subdomain', $tenant_domain)->firstOrFail();

        app()->instance('currentTenant', $tenant);
        if (
            Auth::guard('tenant')->attempt([
                'email' => $request->email,
                'password' => $request->password,
                'tenant_id' => $tenant->id,
            ])
        ) {
            session(['tenant_id', $tenant->id]);

            return redirect()->route('tenant.dashboard', $tenant_domain);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

}
