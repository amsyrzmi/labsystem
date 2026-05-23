<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMaterial extends Model
{
    protected $fillable = [
        'name', 'quantity', 'unit', 'concentration', 
        'minimum_quantity', 'notes'
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'concentration' => 'decimal:4',
        'minimum_quantity' => 'decimal:2',
    ];

    public function isLowStock()
    {
        return $this->quantity <= $this->minimum_quantity;
    }

    public function isSufficient($requiredQuantity)
    {
        return $this->quantity >= $requiredQuantity;
    }

    public function transactions()
    {
        return $this->morphMany(InventoryTransaction::class, 'item');
    }
}