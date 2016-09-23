<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'type','name','address_1','address_2','city','state','zip','phone','fax','website','fax_domain','domain',
        'time_zone','external_account','contact','contact_phone','note'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the clients owned by the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients() {
        return $this->hasMany('App\Client');
    }
}
