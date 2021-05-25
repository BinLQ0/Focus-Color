<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_supplier' => false,
        'is_customer' => false,
    ];

    /**
     * Set the material value.
     *
     * @param  bool|string  $value
     * @return void
     */
    public function setIsSupplierAttribute($value)
    {
        $this->attributes['is_supplier'] = $this->getToogleValue($value);
    }

    /**
     * Set the goods value.
     *
     * @param  bool|string  $value
     * @return void
     */
    public function setIsCustomerAttribute($value)
    {
        $this->attributes['is_customer'] = $this->getToogleValue($value);
    }

    /**
     * Custom Metdhod
     */
    public function getToogleValue($value)
    {
        return $value instanceof bool
            ? $value
            : ($value == 'on' ? true : false);
    }
}
