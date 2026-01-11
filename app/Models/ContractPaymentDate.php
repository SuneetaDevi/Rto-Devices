<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ContractPaymentDate extends Model
{
    use HasFactory;

    protected $table = 'contract_payment_dates';

    protected $fillable = [
        'contract_id',
        'payment_date',
        'payment_method',
        'status',
        'transaction_id',
        'amount',
        'tax_amount',
        'service_charge'
    ];

    /**
     * Get the contract that owns the payment date.
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
