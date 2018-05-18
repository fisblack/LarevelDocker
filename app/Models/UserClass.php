<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserClass extends Model
{
    use SoftDeletes;

    protected $table = 'dim_user_class';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = true;

    public $fillable = [
        'name_th',
        'name_en',
        'color',
        'discount_type',
        'discount',
        'minimum_purchase',
    ];
}
