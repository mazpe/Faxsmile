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
        'entity_id', 'first_name', 'fax_id', 'last_name', 'email', 'note'
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
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // TODO: creating should touch mutators and use setPasswordAttribute mutator instead of having to specify it
        /**
         * Listen to the User creating an event.
         * - if the token or password is missing.. create them
         *
         * @param  $client
         * @return void
         */
        static::creating(function(User $user)
        {
            if (empty($user->remember_token)) {
                $user->attributes['remember_token'] = str_random(10);
            }
            if (empty($user->password)) {
                $user->attributes['password'] = Hash::make(str_random(12));
            }

            return $user;
        });


    }

    // TODO: create a listener on created() to send customer email with login information

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
        if (empty($value)) {
            $this->attributes['fax_id'] = null;
        } else {
            $this->attributes['fax_id'] = $value;
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
    public function faxes() {
        return $this->hasMany('App\Fax');
    }

    /**
     * Get the fax that is attached to the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function fax() {
        return $this->belongsTo('App\Fax');
    }

    /**
     * Get the roles for the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function roles() {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    /**
     * Get the recipients for the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function recipients() {
        return $this->belongsToMany('App\Recipient','fax_recipients', 'recipient_id')->withTimestamps();
    }


    ### CUSTOM FUNCTIONS
    public function isSuperAdmin()
    {
        $isSuperAdmin = false;
        if ($this->roles->where('name', 'Super Admin')->count() > 0) {
            $isSuperAdmin = true;
        }

        return $isSuperAdmin;
    }

    public function isCompanyAdmin()
    {
        $isCompanyAdmin = false;

        if ($this->roles->where('name', 'Company Admin')->count() > 0) {
            $isCompanyAdmin = true;
        }

        return $isCompanyAdmin;
    }

    public function isProviderAdmin()
    {
        $isProviderAdmin = false;

        if ($this->roles->where('name', 'Provider Admin')->count() > 0) {
            $isProviderAdmin = true;
        }

        return $isProviderAdmin;
    }

    public function isClientAdmin()
    {
        $isClientAdmin = false;

        if ($this->roles->where('name', 'Client Admin')->count() > 0) {
            $isClientAdmin = true;
        }

        return $isClientAdmin;
    }

    public function isUser()
    {
        $isUser = false;

        if ($this->roles->where('name', 'User')->count() > 0) {
            $isUser = true;
        }

        return $isUser;
    }

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

    public static function attachUserToRole($user,$role) {
        dd($role);
    }

}
