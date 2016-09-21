<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'type','name','address_1','address_2','city','state','zip','phone','fax','website','contact',
        'contact_phone','note'
    ];

    /**
     * Get the faxes attached to the provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faxes() {
        return $this->hasMany('App\Fax');
    }
}
