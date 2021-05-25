<?php

namespace App\Models;

use App\Traits\HasCompanyRelation;
use App\Traits\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveItem extends Model
{
    use HasFactory, HasCompanyRelation, Transaction;

    
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
    protected $table = 'receives';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
