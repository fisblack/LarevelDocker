<?php

namespace SenseBook;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SenseBook\Models\Address;
use SenseBook\Models\Date;
use SenseBook\Models\UserClass;
use SenseBook\Traits\SearchableTrait as Searchable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Searchable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dim_users';

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
        'email',
        'password',
        'full_name',
        'phone',
        'date_of_birth_id',
        'billing_address_id',
        'shipping_address_id',
        'user_class_id',
        'image',
        'type',
        'points_balance'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the user's class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userClass()
    {
        return $this->belongsTo(UserClass::class);
    }

    /**
     * Get the user's date of birth.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dateOfBirth()
    {
        return $this->belongsTo(Date::class, 'date_of_birth_id', 'id');
    }

    /**
     * Get the user's addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get the user's billing address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingAddress()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Get the user's shipping address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shippingAddress()
    {
        return $this->belongsTo(Address::class);
    }
}
