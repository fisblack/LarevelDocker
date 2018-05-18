<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{

    protected $table = 'home';
    public $primaryKey = 'id';
    public $timestamps = false;

    public $fillable = [
        'product_id',
        'type'
    ];

    public function product()
    {
        return $this->hasOne('SenseBook\Models\Product', 'id', 'product_id');
    }
}
