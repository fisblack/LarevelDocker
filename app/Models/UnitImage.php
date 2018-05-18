<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitImage extends Model
{

    protected $table = 'unit_images';
    public $primaryKey = 'id';
    public $timestamps = false;

    public $fillable = [
        'product_id',
        'order',
        'image'
    ];
}
