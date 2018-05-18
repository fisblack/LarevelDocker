<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingFee extends Model
{
    protected $table = 'fact_shipping_fee';
    public $primaryKey = 'id';
    public $timestamps = true;

    public $fillable = [
        'type_id',
        'region_id',
        'minimum_weight',
        'maximum_weight',
        'amount',
        'point_redemption',
        'created_at',
        'updated_at',
    ];
}
