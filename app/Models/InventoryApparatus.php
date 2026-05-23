<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryApparatus extends Model
{
    protected $table = 'inventory_apparatus';
    
    protected $fillable = [
        'name', 'total_quantity', 'available_quantity', 
        'minimum_quantity', 'notes'
    ];

    protected $casts = [
        'total_quantity' => 'integer',
        'available_quantity' => 'integer',
        'minimum_quantity' => 'integer',
    ];

    public function isLowStock()
    {
        return $this->available_quantity <= $this->minimum_quantity;
    }

    public function isSufficient($requiredQuantity)
    {
        return $this->available_quantity >= $requiredQuantity;
    }

    public function getAllocatedQuantity()
    {
        return $this->total_quantity - $this->available_quantity;
    }

    public function transactions()
    {
        return $this->morphMany(InventoryTransaction::class, 'item');
    }
}