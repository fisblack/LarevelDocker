<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportPayment extends Model
{
    use SoftDeletes;
    protected $table = 'dim_report_payments';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = true;
    protected $fillable = [
        'order_id',
        'bank_id',
        'payment_amount',
        'slip_location',
        'description',
        'report_timestamp',
        'created_at',
    ];
}
