<?php

namespace App\Models;

use App\Traits\HasStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory, HasStock;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'warehouse_id', 'note'];

    /**
     * Get the name rack with warehouse.
     *
     * @return string
     */
    public function getFullCodeAttribute()
    {
        return "{$this->code} ( {$this->warehouse->name} )";
    }

    /**
     *  Scope to get rack with history transaction
     *  @param Int $product_id
     */
    public function scopeWithHistoryOfProduct($query, $product_id)
    {
        $query->with(['history' => function ($q) use ($product_id) {
            return $q->when($product_id, function ($q) use ($product_id) {
                return $q->where('product_id', $product_id)->with('histories');
            });
        }]);
    }

    /**
     *  Get Warehouse
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
