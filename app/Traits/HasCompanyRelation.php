<?php

namespace App\Traits;

use App\Models\Relation;

/**
 * 
 */
trait HasCompanyRelation
{
    /**
     * 
     */
    public function company()
    {
        return $this->belongsTo(Relation::class, 'description');
    }
}
