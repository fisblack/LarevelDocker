<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryTrackingItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fact_delivery_tracking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sales_order_id',
        'logistic_tracking_number'
    ];

    public $timestamps = false;
}
