<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('CompanyAdmin', function(Builder $builder) {
            if (!Auth::user()) {
                return;
            }

            if (Auth::user()->isCompanyAdmin())
            {
                $builder->where('parent_id', '=', Auth::user()->company->id);
            }
            else if (Auth::user()->isClientAdmin())
            {
                $builder->where('id', '=', Auth::user()->entity_id);
            }
            else if (Auth::user()->isUser())
            {
                $builder->where('id', '=', Auth::user()->entity_id);
            }
        });

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
                $user = $client->users()->create([
                    'first_name' => $client->contact_first_name,
                    'last_name' => $client->contact_last_name,
                    'email' => $client->contact_email,
                    'password' => str_random(10),
                    'remember_token' => str_random(10),
                    'note' => 'Client Administrator',
                    'active' => 1
                ]);


                $role = Role::where('name', 'Client Admin')->first();
                $user->roles()->attach($role->id);
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
     * Get the users owned by the client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\User', 'entity_id');
    }

    /**
     * Get all of the faxes for the client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function faxes() {
        return $this->hasMany('App\Fax');
    }
}
