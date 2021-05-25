<?php

namespace App\Traits;

use App\Models\History;
use App\Models\InitializeStock;

/**
 * 
 */
trait HasHistory
{
    /**
     * Get all history.
     */
    public function history()
    {
        return $this->hasMany(History::class);
    }

    /**
     * Get details opening balance of product.
     */
    public function initDetails()
    {
        return $this->morphedByMany(InitializeStock::class, 'histories')->withPivot(['quantity']);
    }
}
