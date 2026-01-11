<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\ErrorHandler\Internal\TentativeTypes;

class TenantStore extends Model
{
    use HasFactory;
    protected $table = 'tenant_stores';
    protected $guarded = [];


    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    public function accountManager()
    {
        return $this->belongsTo(TenantUser::class, 'account_manager_id');
    }

    /**
     * Dealer Success Manager relationship
     */
    public function dealerManager()
    {
        return $this->belongsTo(TenantUser::class, 'dealer_manager_id');
    }

}
