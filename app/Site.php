<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url'
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
     * Returns a collection of organization models that belong to this site.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizations() {
        return $this->hasMany('App\Organization');
    }
}
