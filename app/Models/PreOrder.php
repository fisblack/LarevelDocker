<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SenseBook\Scopes\PreOrderScope;

class PreOrder extends Model
{
    use SoftDeletes;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PreOrderScope());
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dim_sale_orders';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'member_id',
        'document_date_id',
        'billing_address_line_1',
        'billing_address_line_2',
        'billing_sub_district_id',
        'billing_district_id',
        'billing_province_id',
        'billing_postcode_id',
        'shipping_address_line_1',
        'shipping_address_line_2',
        'shipping_sub_district_id',
        'shipping_district_id',
        'shipping_province_id',
        'shipping_postcode_id',
        'delivery_date_id',
        'description',
        'is_preorder',
        'is_paid',
        'shipping_method_id',
        'payment_method',
        'point_redemption_id',
        'point_accural_id',
        'price_before_discount',
        'shipping_fee',
        'discount',
        'total_price'
    ];
}
