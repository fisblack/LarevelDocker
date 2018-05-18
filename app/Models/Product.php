<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'dim_products';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = true;

    public $fillable = [
        'isbn',
        'name',
        'name_en',
        'description',
        'cover_image_id',
        'cost',
        'suggested_member_price',
        'suggested_retail_price',
        'product_type_id',
        'page_count',
        'weight',
        'width',
        'depth',
        'height',
        'shipping_method_id',
        'reward_points',
        'point_redemption_for_free_gift',
        'is_point_redemption_only',
        'is_join_promotion',
        'is_free_shipping',
        'file_ref'
    ];

    public function category()
    {
        return $this->belongsToMany(
            'SenseBook\Models\Category',
            'product_categories',
            'product_id',
            'category_id'
        )->withTrashed();
    }

    public function writer()
    {
        return $this->belongsToMany(
            'SenseBook\Models\Writer',
            'product_writers',
            'product_id',
            'writer_id'
        )->withTrashed();
    }

    public function shipping()
    {
        return $this->hasOne('SenseBook\Models\ShippingType', 'id', 'shipping_method_id');
    }

    public function productType()
    {
        return $this->hasOne('SenseBook\Models\ProductType', 'id', 'product_type_id');
    }

    public function coverImage()
    {
        return $this->hasOne('SenseBook\Models\UnitImage', 'id', 'cover_image_id');
    }

    public function imageCover()
    {
        return $this->belongsTo('SenseBook\Models\UnitImage', 'id', 'product_id');
    }
}
