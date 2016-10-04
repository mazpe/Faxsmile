<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Hash;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $softCascade = ['recipients'];

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
     *  Return the full concatenated name for the User
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return trim($this->attributes['first_name'] .' '. $this->attributes['last_name']);
    }
//
//    /**
//     *  Return the full concatenated name for the User
//     *
//     * @return string
//     */
//    public function fullName() {
//        $fullName = $this->first_name . ' ' . $this->last_name;
//
//        return trim($fullName);
//    }

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
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function fax() {
        return $this->hasOne('App\Fax');
    }



    ### CUSTOM FUNCTIONS
    /**
     *  Get a user that is not associated with a Fax
     *
     * @return mixed
     */
    public static function getUser()
    {
        $userIsASender = true;

        while($userIsASender) {
            $user = self::getRandomUser();
            $userIsASender = self::checkIfUserIsAFaxSender($user->id);
        }
        $user = self::getRandomUser();
        return $user;
    }

    /**
     * Get a random User
     *
     * @return mixed
     */
    public static function getRandomUser()
    {
        return $user = self::getClientsOnlyUsers()->inRandomOrder()->first();
    }

    /**
     * Get clients only users
     *
     * @return model
     */
    public static function getClientsOnlyUsers()
    {
        return $user = User::join('entities','entities.id','users.entity_id')
            ->where('type','client')
            ->with('client');
    }

    /**
     * Check if a User is already associated with a Fax
     *
     * @param $user_id
     * @return bool
     */
    public static function checkIfUserIsAFaxSender($user_id)
    {
        if (Fax::where('sender_id', $user_id)->count() > 0) {
            return $isAlreadyFaxSender = true;
        }
    }

}
