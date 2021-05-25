<?php

namespace App\Models;

use App\Traits\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductResult extends Model
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
    protected $table = 'results';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'for', 'description'];

    /**
     * Get Release Details
     */
    public function release()
    {
        return $this->belongsTo(MaterialRelease::class, 'for');
    }
}
