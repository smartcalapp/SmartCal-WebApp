<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_organization',
        'name',
        'start_time',
        'end_time',
        'freq_interval',
        'freq_start',
        'freq_end',
        'freq_byday',
        'freq_bymonthday',
        'published',
        'description',
        'tags'
    ];

    /**
     * The attributes that can not be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'uuid'
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at','start_time','end_time'];

    /**
     * Returns a model for the organization the event belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization() {
        return $this->belongsTo('App\Organization', 'parent_organization');
    }

}
