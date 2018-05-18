<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General extends Model
{
    use SoftDeletes;

    protected $table = 'general';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = true;

    public $fillable = [
        'maintenance_image',
        'close_image',
        'maintenanace_cause',
        'is_maintenance',
        'is_close',
        'shipment_image',
        'return_image',
        'payment_image',
        'point_image',
    ];
}
