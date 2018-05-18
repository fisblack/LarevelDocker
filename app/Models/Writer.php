<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Writer extends Model
{
    use SoftDeletes;

    protected $table = 'dim_writers';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = true;

    public $fillable = [
        'id',
        'fullname_th',
        'namfullname_en',
        'image',
        'description_th',
        'description_en'
    ];
    public function productWriter()
    {
        return$this->belongsToMany(Product::class, 'product_writers', 'writer_id', 'product_id');
    }
}
