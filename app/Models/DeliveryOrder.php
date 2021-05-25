<?php

namespace App\Models;

use App\Traits\HasCompanyRelation;
use App\Traits\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
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
        return 'CREDIT';
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'deliveries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'for', 'description'];
}
