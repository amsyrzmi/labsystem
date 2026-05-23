<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $fillable = [
        'lab_request_id', 'item_type', 'item_id', 'item_name',
        'quantity', 'unit', 'transaction_type', 'status', 'completed_at'
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'completed_at' => 'datetime',
    ];

    public function labRequest()
    {
        return $this->belongsTo(LabRequest::class);
    }

    public function item()
    {
        return $this->morphTo();
    }
}