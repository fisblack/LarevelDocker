<?php

namespace SenseBook\Models;

use Baraear\ThaiAddress\Models\District;
use Baraear\ThaiAddress\Models\PostalCode;
use Baraear\ThaiAddress\Models\Province;
use Baraear\ThaiAddress\Models\SubDistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dim_addresses';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address_line_1',
        'address_line_2',
        'sub_district_id',
        'district_id',
        'province_id',
        'postal_code_id',
        'full_name'
    ];

    /**
     * Get address's sub-district.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class);
    }

    /**
     * Get address's district.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get address's province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get address's postal code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function postalCode()
    {
        return $this->belongsTo(PostalCode::class);
    }

    public function fullAddress()
    {
        $address = '';
        $address .= $this->address_line_1 ."\n";
        $address .= $this->address_line_2 ."\n";
        $address .= 'แขวง/ตำบล '.$this->subDistrict->name ."\n";
        $address .= 'เขต/อำเภอ '.$this->district->name ."\n";
        $address .= 'จังหวัด '.$this->province->name ."\n";
        $address .= 'รหัสไปษณี '.$this->postalCode->code ."\n";
        return $address;
    }
}
