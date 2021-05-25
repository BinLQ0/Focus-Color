<?php

namespace App\Models;

use App\Traits\HasStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
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
    protected $fillable = ['name', 'address'];

    /**
     * 
     */
    public function racks()
    {
        return $this->hasMany(Rack::class);
    }
}
