<?php

namespace SenseBook\Models;

use Baraear\ThaiAddress\Models\District;
use Baraear\ThaiAddress\Models\PostalCode;
use Baraear\ThaiAddress\Models\Province;
use Baraear\ThaiAddress\Models\SubDistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use SenseBook\Scopes\SaleOrderScope;
use SenseBook\Traits\OrderableTrait as Orderable;

class SaleOrder extends Model
{
    use SoftDeletes, Orderable;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        // static::addGlobalScope(new SaleOrderScope());
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
        'full_name',
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
        'total_price',
        'status'
    ];

    public function documentDate()
    {
        return $this->hasOne(Date::class, 'id', 'document_date_id');
    }

    public function items()
    {
        return $this->hasMany(SaleOrderItem::class, 'sales_order_id', 'id')->orderBy('id', 'DESC');
    }

    public function tracking()
    {
        return $this->hasOne(DeliveryTrackingItem::class, 'sales_order_id', 'id');
    }

    public function payment()
    {
        return $this->hasMany(PaymentItem::class, 'sales_order_id', 'id');
    }

    public function scopeSearch($query, $request)
    {

        if ($request->has('search') && !empty($request->get('search'))) {
            $query->where(function($query) use ($request) {
                $query->where('id', 'LIKE', "%{$request->get('search')}%");
                $query->where('billing_address_line_1', 'LIKE', "%{$request->get('search')}%");
                $query->orWhere('billing_address_line_2', 'LIKE', "%{$request->get('search')}%");
                $query->orWhere('shipping_address_line_1', 'LIKE', "%{$request->get('search')}%");
                $query->orWhere('shipping_address_line_2', 'LIKE', "%{$request->get('search')}%");
                $query->orWhere('total_price', 'LIKE', "%{$request->get('search')}%");
                $query->orWhere('discount', 'LIKE', "%{$request->get('search')}%");
                $query->orWhere('full_name', 'LIKE', "%{$request->get('search')}%");
            })->orWhere('id', $request->get('search'));
        }

        return $query;
    }

    public function deliveryDate()
    {
        return $this->hasOne(Date::class, 'id', 'delivery_date_id');
    }

    public function shippingProvince()
    {
        return $this->hasOne(Province::class, 'id', 'shipping_province_id');
    }

    public function shippingDistrict()
    {
        return $this->hasOne(District::class, 'id', 'shipping_district_id');
    }

    public function shippingSubDistrict()
    {
        return $this->hasOne(SubDistrict::class, 'id', 'shipping_sub_district_id');
    }

    public function shippingPostCode()
    {
        return $this->hasOne(PostalCode::class, 'id', 'shipping_postcode_id');
    }

    public function billingProvince()
    {
        return $this->hasOne(Province::class, 'id', 'billing_province_id');
    }

    public function billingDistrict()
    {
        return $this->hasOne(District::class, 'id', 'billing_district_id');
    }

    public function billingSubDistrict()
    {
        return $this->hasOne(SubDistrict::class, 'id', 'billing_sub_district_id');
    }

    public function billingPostCode()
    {
        return $this->hasOne(PostalCode::class, 'id', 'billing_postcode_id');
    }
}
