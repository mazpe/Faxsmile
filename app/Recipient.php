<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;
//use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Recipient extends Model
{
    // TODO: support Soft Delete
    //use SoftDeletes;
//    use SoftCascadeTrait;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entity_id', 'fax_id', 'first_name', 'last_name', 'password', 'email', 'note'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     *  Set hashed password
     *
     * @param $value
     */
    public function setPasswordAttribute($value) {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        } else {
            $this->attributes['password'] = Hash::make('ChangeMe1!');
        }
    }

    /**
     *  Return the full concatenated name for the Recipient
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return trim($this->attributes['first_name'] .' '. $this->attributes['last_name']);
    }

    /**
     * Get the faxes for the recipient
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function faxes() {
        return $this->belongsToMany('App\Fax','fax_recipients');
    }
}
