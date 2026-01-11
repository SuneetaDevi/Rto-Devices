<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractDocument extends Model
{
    protected $table = 'contract_documents';

    protected $fillable = [
        'contract_id',
        'document_type',
        'file_path',
        'is_uploaded'
    ];

    // Each document belongs to a contract
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
