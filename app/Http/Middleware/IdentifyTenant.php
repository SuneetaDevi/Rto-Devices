<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;

class IdentifyTenant
{
    public function handle($request, Closure $next)
    {
        $tenantDomain = $request->route('tenant_domain');

        $tenant = Tenant::where('subdomain', $tenantDomain)->first();

        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        // Bind the tenant instance to the container
        app()->instance('currentTenant', $tenant);

        return $next($request);
    }
}
