<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fact_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sales_order_id',
        'value'
    ];

    public $timestamps = false;
}
