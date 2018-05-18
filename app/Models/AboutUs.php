<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'dim_about_us';
    public $primaryKey = 'id';
    public $timestamps = true;

    public $fillable = [
        'image_head',
        'image_1',
        'image_2',
        'title',
        'head_description',
        'description_1',
        'description_2',
        'footer'
    ];

    public function aboutUsWriters()
    {
        return $this->hasMany(
            AboutUsWriters::class,
            'id',
            'about_us_id'
        );
    }
}
