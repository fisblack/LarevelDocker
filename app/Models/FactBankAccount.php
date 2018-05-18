<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FactBankAccount extends Model
{

    use SoftDeletes;

    protected $table = 'fact_bank_accounts';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = true;

    protected $fillable = [
        'id','name', 'logo'
    ];

    protected $dontKeepAuditOf = ['created_at', 'updated_at'];

    protected $allowedAccountTypes = [
        'เงินฝากออมทรัพย์',
        'เงินฝากกระแสรายวัน',
        'เงินฝากประจำ',
        'ตั๋วแลกเงิน',
        'เงินฝากปลอดภาษี'
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function getAccountTypes()
    {
        return $this->allowedAccountTypes;
    }
}
