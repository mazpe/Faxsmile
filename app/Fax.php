<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fax extends Model
{
    use SoftDeletes;

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
     * Get the sender for the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sender() {
        return $this->belongsTo('App\User', 'sender_id');
    }

    /**
     * Get the users for the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users() {
        return $this->hasMany('App\User');
    }
}
