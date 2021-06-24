<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class History extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'histories';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the parent historyable model.
     */
    public function histories()
    {
        return $this->morphTo('histories', 'histories_type', 'histories_id')->orderBy('date');
    }

    /**
     * 
     */
    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    /**
     * 
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
