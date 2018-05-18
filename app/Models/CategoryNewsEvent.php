<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryNewsEvent extends Model
{
    use SoftDeletes;

    protected $table = 'dim_category_news_events';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = true;

    public $fillable = [
        'name_th',
        'name_en'
    ];
}
