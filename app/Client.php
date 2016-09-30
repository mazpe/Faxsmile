<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Client extends Entity
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected static $singleTableType = 'client';
    protected $softCascade = ['users'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'parent_id','parent_type','type','name','address_1','address_2','city','state','zip','phone','fax','website',
        'domain','time_zone','external_account','contact_first_name','contact_last_name', 'contact_phone',
        'contact_email','note'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Default values for attributes in the model
     *
     * @var array
     */
    protected $attributes = array(
        'parent_type' => 'company'
    );

    public static function boot()
    {
        parent::boot();

        /**
         * Listen to the Client created event.
         * - once a Client entity has been created also create the client admin user account
         *
         * @param  $client
         * @return void
         */
        static::created(function(Client $client)
        {
            if ($client->contact_email) {
                $client->users()->create([
                    'first_name' => $client->contact_first_name,
                    'last_name' => $client->contact_last_name,
                    'email' => $client->contact_email,
                    'password' => str_random(10),
                    'remember_token' => str_random(10),
                    'note' => 'Client Administrator',
                    'active' => 1
                ]);
            }

            return true;
        });

        /**
         * Listen to the Client deleting event.
         * - remove client_id from faxes owned by client
         *
         * @param  $client
         * @return void
         */
        static::deleting(function(Client $client)
        {
            Fax::where('client_id', $client->id)->update(['client_id' => null]);
            return true;
        });
    }

    /**
     * Get the company that owns the client
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company() {
        return $this->belongsTo('App\Company','parent_id');
    }

    /**
     * Get all of the faxes for the client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function faxes() {
        return $this->hasManyThrough('App\Fax', 'App\User', 'entity_id', 'user_id', 'id');
    }

    /**
     * Get the users owned by the client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\User', 'entity_id');
    }
}
