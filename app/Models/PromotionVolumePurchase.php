<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionVolumePurchase extends Model
{
    protected $table = 'promotion_volume_purchase';
    public $timestamps = false;

    public $fillable = [
        'volume_purchase',
        'volume_purchase_benefits',
    ];
}
