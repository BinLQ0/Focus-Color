<?php

namespace App\Models;

use App\Traits\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
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
    protected $table = 'adjustments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'for', 'description', 'status'];
}