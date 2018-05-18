<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\Facades\Image;

class NewsEvent extends Model
{
    use SoftDeletes;

    protected $table = 'dim_news_events';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = true;

    public $fillable = [
        'member_id',
        'category_news_events_id',
        'title_th',
        'title_en',
        'short_description_th',
        'short_description_en',
        'description_th',
        'description_en',
        'image',
        'banner',
        'news_events_date',
        'is_show'
    ];

    public function category()
    {
        return $this->hasOne('SenseBook\Models\CategoryNewsEvent', 'id', 'category_news_events_id')->withTrashed();
    }

    public function user()
    {
        return $this->hasOne('SenseBook\User', 'id', 'member_id')->withTrashed();
    }

    public function image()
    {
        return Image::make(storage_path('/images/news-and-events/'))->response('jpg');
    }
}
