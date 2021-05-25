<?php

namespace App\Models;

use App\Traits\HasStock;
use App\Traits\HasType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasType, HasStock;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     *  Scope to get product with history
     */
    public function scopeWithHistory($query)
    {
        $query->with(['history.histories']);
    }

    /**
     *  Scope to get product with specified type
     *  @param String $type
     */
    public function scopeTypeOf($query, $type = null)
    {
        $query->with('type')->when($type != null, function ($q) use ($type) {
            $q->whereHas('type', function ($q) use ($type) {
                $q->where($type, 1);
            });
        });
    }

    /**
     * Get Default Warehouse
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get Default Rack
     */
    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    /**
     * Get All Racks
     */
    public function racks()
    {
        return $this->belongsToMany(Rack::class, History::class);
    }

    /**
     * Get Unique Racks
     */
    public function uniqueOf($relation)
    {
        return $this->$relation()
            ->WithHistoryOfProduct($this->id)
            ->distinct()
            ->get();
    }
}
