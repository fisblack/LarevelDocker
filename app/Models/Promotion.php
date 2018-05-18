<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Promotion extends Model
{
    public $timestamps = false;

    public $fillable = [
        'birthday_discount',
        'birthday_discount_unit',
        'birthday_month_discount',
        'birthday_month_discount_unit',
        'second_tuesday_discount',
        'second_tuesday_discount_unit',
        'free_shipping_amount_condition',
        'free_shipping_weight_condition',
        'double_point_start_date',
        'double_point_end_date',
    ];

    protected $appends  = [
        'date_from',
        'date_to',
    ];

    public function getDateFromAttribute()
    {
        return Carbon::parse($this->double_point_start_date)->format('d-m-Y');
    }

    public function getDateToAttribute()
    {
        return Carbon::parse($this->double_point_end_date)->format('d-m-Y');
    }
}
