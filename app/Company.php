<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Company extends Entity
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected static $singleTableType = 'company';
    protected $softCascade = ['clients', 'users', 'emailConfig', 'emailTemplates'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('company', function(Builder $builder) {
            if (Auth::user()->isSuperAdmin()) {

            }
            else if (Auth::user()->isCompanyAdmin()) {
                $builder->where('id', '=', Auth::user()->entity->id);
            }
            else if (Auth::user()->isClientAdmin()) {
                $builder->where('id', '=', Auth::user()->client->parent_id);
            }
        });

        /**
         * Listen to the Company created event.
         * - once a Company entity has been created also create the company's admin user account
         *
         * @param  $company
         * @return void
         */
        static::created(function(Company $company)
        {
            if ($company->contact_email) {
                $user = $company->users()->create([
                    'first_name' => $company->contact_first_name,
                    'last_name' => $company->contact_last_name,
                    'email' => $company->contact_email,
                    'password' => str_random(10),
                    'remember_token' => str_random(10),
                    'note' => 'Company Administrator',
                    'active' => 1
                ]);

                $role = Role::where('name', 'Company Admin')->first();
                $user->roles()->attach($role->id);
            }

            return true;
        });
    }

    /**
     * Get the clients owned by the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients() {
        return $this->hasMany('App\Client','parent_id');
    }

    /**
     * Get the email config owned by the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailConfig() {
        return $this->hasOne('App\EmailConfig');
    }

    /**
     * Get the email templates that belong to the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailTemplates() {
        return $this->hasMany('App\EmailTemplate');
    }

    /**
     * Get all of the faxes for the company.
     */
    public function faxes()
    {
        return $this->hasManyThrough('App\Fax', 'App\Client', 'parent_id', 'client_id');
    }

    /**
     * Get the users that belong to the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasManyThrough('App\User','App\Client','parent_id','entity_id');
    }

    ### CUSTOM FUNCTION
    public function makeCompanyUserAdmin($user) {
        $role = Role::where('name', 'Company Admin');
        $user->roles()->attach($role->id);
        return;
    }
}
