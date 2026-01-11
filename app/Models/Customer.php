<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel naming convention)
    protected $table = 'customers';

    // Mass assignable fields
    protected $guarded = [];

    /**
     * A customer belongs to a tenant
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Optionally, add any accessors or helper functions
     */
    public function getFullContactAttribute()
    {
        return $this->name . ($this->email ? " ({$this->email})" : '') . ($this->phone ? " - {$this->phone}" : '');
    }
}
