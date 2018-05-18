<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use SoftDeletes;

    protected $table = 'dim_points';

    public $fillable = ['points', 'discount'];

    public $dates = ['deleted_at'];
}
