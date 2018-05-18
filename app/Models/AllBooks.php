<?php
namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllBooks extends Model
{
    protected $table = 'all_books';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['allbook_image'];
}
