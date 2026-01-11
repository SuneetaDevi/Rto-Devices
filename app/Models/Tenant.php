<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['name', 'email', 'subdomain', 'valid_till'];

    public function users()
    {
        return $this->hasMany(TenantUser::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function stores()
    {
        return $this->hasMany(TenantStore::class, 'tenant_id', 'id');
    }

}
