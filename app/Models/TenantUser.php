<?php
namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class TenantUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'tenant_users';

    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function stores()
    {
        return $this->belongsTo(TenantStore::class, 'store_id');
    }
}
