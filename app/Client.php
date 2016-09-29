<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;


class Client extends Entity
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected static $singleTableType = 'client';
    protected $softCascade = ['users'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the company that owns the client
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company() {
        return $this->belongsTo('App\Company');
    }

    /**
     * Get the faxes owned by the client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faxes() {
        return $this->hasMany('App\Fax');
    }

    /**
     * Get the users owned by the client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\User');
    }
}
