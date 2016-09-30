<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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
     *  Set hashed password
     *
     * @param $value
     */
    public function setFaxIdAttribute($value) {
        if ($value) {
            $this->attributes['fax_id'] = $value;
        } else {
            $this->attributes['fax_id'] = null;
        }
    }

    public function fullName() {
        $fullName = $this->first_name . ' ' . $this->last_name;

        return trim($fullName);
    }

    /**
     * Get the entity that owns the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entity() {
        return $this->belongsTo('App\Entity','entity_id');
    }

    /**
     * Get the client that owns the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client() {
        return $this->belongsTo('App\Client','entity_id');
    }

    /**
     * Get the fax that is attached to the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fax() {
        return $this->belongsTo('App\Fax');
    }
}
