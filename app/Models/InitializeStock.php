<?php

namespace App\Models;

use App\Traits\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitializeStock extends Model
{
    use HasFactory, Transaction;

    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['type'];
    
    /**
     * Determine the transaction type.
     *
     * @return bool
     */
    public function getTypeAttribute()
    {
        return 'DEBIT';
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_inits';

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
        'for'           => 'Initial Stock',
        'description'   => 'Create Product',
    ];
}
