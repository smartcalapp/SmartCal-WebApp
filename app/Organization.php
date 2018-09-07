<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_site',
        'name',
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
     * Returns a collection of events that belong to this organization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events() {
        return $this->hasMany('App\Event');
    }

    public function site() {
        return $this->hasMany('App\Site', 'parent_site');
    }
}
