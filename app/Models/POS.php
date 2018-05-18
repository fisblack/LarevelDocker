<?php

namespace SenseBook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SenseBook\Models\Date;
use SenseBook\Traits\SearchableTrait as Searchable;

class POS extends Model
{
    use SoftDeletes, Searchable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fact_points';

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
        'date_id',
        'member_id',
        'staff_id',
        'points'
    ];

    /**
     * Get points's date.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dates()
    {
        return $this->belongsTo(Date::class);
    }

    /**
     * Get points's member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get points's staff.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(User::class);
    }
}
