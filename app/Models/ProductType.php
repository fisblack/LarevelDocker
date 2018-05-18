<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{

    protected $table = 'dim_product_type';
    public $primaryKey = 'id';
    public $timestamps = true;

    public $fillable = [
        'name',
    ];
}
