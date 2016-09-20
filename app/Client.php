<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $fillable = [
        'company_id','name','address_1','address_2','city','state','zip','phone','fax','website','contact',
        'contact_phone','notes'
    ];

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
