<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Fax extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;

//    protected $softCascade = ['recipients'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'provider_id', 'client_id','sender_id', 'number', 'description', 'note'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     *  Set user_id to value or null
     *
     * @param $value
     */
    public function setSenderIdAttribute($value) {
        $this->attributes['sender_id'] = ($value ? $value : null);
    }

    /**
     * Get the provider that owns the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider() {
        return $this->belongsTo('App\Provider', 'provider_id', 'id');
    }

    /**
     * Get the client for the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client() {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the senders for the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function senders() {
        return $this->hasMany('App\Sender');
    }

    /**
     * Get the users for the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users() {
        return $this->hasMany('App\User');
    }

    /**
     * Get the users for the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function recipients() {
        return $this->belongsToMany('App\Recipient','fax_recipients')->withTimestamps();
    }
}
