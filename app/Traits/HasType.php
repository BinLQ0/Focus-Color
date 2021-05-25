<?php

namespace App\Traits;

use App\Models\ProductType;

/**
 * 
 */
trait HasType
{
    public function type()
    {
        return $this->belongsTo(ProductType::class, 'inventory_id');
    }
}