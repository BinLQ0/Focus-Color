<?php

namespace App\Traits;

use App\Models\Product;
use Carbon\Carbon;

/**
 * 
 */
trait Transaction
{
    /**
     * Set the product inititalization "date".
     *
     * @param  string  $value
     * @return Date ~Format('d/m/Y')
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    /**
     * Get the product inititalization date.
     *
     * @param  Date $value ~Format('Y-m-d')
     * @return Date
     */
    public function getDateAttribute($value)
    {
        return ($value instanceof Carbon) ? $value : Carbon::createFromFormat('Y-m-d', $value)->format("d/m/Y");
    }

    /**
     * Get a listed related product
     */
    public function products()
    {
        return $this->morphToMany(Product::class, 'histories')->withPivot(['quantity' ,'rack_id']);
    }
}
