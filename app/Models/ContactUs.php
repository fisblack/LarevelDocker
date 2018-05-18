<?php

namespace SenseBook\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'dim_contact_us';
    public $primaryKey = 'id';
    public $timestamps = true;
    
    public $fillable = [
        'title_th',
        'title_en',
        'subtitle_th',
        'subtitle_en',
        'description_th',
        'description_en',
        'address_th',
        'address_en',
        'email',
        'facebook',
        'twitter',
        'phone',
        'google_map'
    ];
}
