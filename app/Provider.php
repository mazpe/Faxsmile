<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Provider extends Entity
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected static $singleTableType = 'provider';
    protected $softCascade = ['faxes'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();

        /**
         * Listen to the Provider created event.
         * - once a Provider entity has been created also create the provider's admin user account
         *
         * @param  $provider
         * @return void
         */
        static::created(function(Provider $provider)
        {
            if ($provider->contact_email) {
                $user = $provider->users()->create([
                    'first_name' => $provider->contact_first_name,
                    'last_name' => $provider->contact_last_name,
                    'email' => $provider->contact_email,
                    'password' => str_random(10),
                    'remember_token' => str_random(10),
                    'note' => 'Provider Administrator',
                    'active' => 1
                ]);

                $user->roles()->attach(2);
            }

            return true;
        });
    }

    /**
     * Get the provider config for the provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providerConfig() {
        return $this->hasOne('App\ProviderConfig');
    }

    /**
     * Get the faxes that belong to the provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faxes() {
        return $this->hasMany('App\Fax');
    }

    /**
     * Get the users that belong to the provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\User','entity_id');
    }

}
