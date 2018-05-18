<?php
namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;

    protected $table = 'dim_banks';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = true;
    
    protected $dontKeepAuditOf = ['created_at', 'updated_at'];
    protected $fillable = [
        'name', 'account_type', 'account_no', 'branch','logo'
    ];

    public function factBankAccount()
    {
        return $this->hasMany(FactBankAccount::class, 'id', 'bank_id');
    }
}
