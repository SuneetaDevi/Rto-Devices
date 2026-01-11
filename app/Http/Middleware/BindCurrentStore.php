<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BindCurrentStore
{
    public function handle(Request $request, Closure $next)
    {
        $tenant = app('currentTenant');
        $user = auth()->user();
        // $user =  auth()->guard('tenant')->user();
        // dd($user->stores()->get());

        $storeId = session('current_store_id') ?? $user->stores()->first()->id;
        // dd($storeId);
        $currentStore = $storeId ? $tenant->stores()->find($storeId) : null;

        // Bind current store (can be null)
        app()->instance('currentStore', $currentStore);

        return $next($request);
    }
}
