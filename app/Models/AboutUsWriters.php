<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsWriters extends Model
{
    protected $table = 'dim_about_us_writers';
    public $primaryKey = 'id';
    public $timestamps = true;
    public $fillable = ['about_us_id', 'writer_image'];
}
