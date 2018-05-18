<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'dim_categories';
    public $primaryKey = 'id';
    public $timestamps = true;
    public $dates = ['deleted_at'];
    public $fillable = ['name_th', 'name_en'];

    public function product()
    {
        return $this->belongsToMany('SenseBook\Models\Product', 'product_categories', 'product_id', 'category_id')
            ->withTrashed();
    }
}
