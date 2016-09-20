<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fax extends Model
{
    public $fillable = [
        'client_id', 'number'
    ];

    /**
     * Get the client that owns the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client() {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the users attached to the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\User');
    }
}
