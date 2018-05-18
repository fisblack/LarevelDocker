<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRegion extends Model
{
    protected $table = 'dim_shipping_regions';
    public $primaryKey = 'id';

    public $fillable = [
        'region_name',
    ];

    public function fees()
    {
        return $this->hasMany('SenseBook\Models\ShippingFee', 'region_id');
    }
}
