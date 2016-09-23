<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Provider extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $softCascade = ['faxes'];

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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the faxes attached to the provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faxes() {
        return $this->hasMany('App\Fax');
    }
}
