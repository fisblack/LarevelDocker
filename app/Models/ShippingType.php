<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingType extends Model
{
    protected $table = 'dim_shipping_types';
    public $primaryKey = 'id';

    public $fillable = [
        'name',
    ];

    public function items()
    {
        return $this->hasMany(ShippingFee::class, 'type_id', 'id');
    }
}
