<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Company extends Entity
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected static $singleTableType = 'company';
    protected $softCascade = ['clients', 'emailConfig', 'emailTemplates'];

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
         * Listen to the Company created event.
         * - once a Company entity has been created also create the company's admin user account
         *
         * @param  $company
         * @return void
         */
        static::created(function(Company $company)
        {
            if ($company->contact_email) {

                User::create([
                    'entity_id' => $company->id,
                    'first_name' => $company->contact_first_name,
                    'last_name' => $company->contact_last_name,
                    'email' => $company->contact_email,
                    'password' => str_random(10),
                    'remember_token' => str_random(10),
                    'note' => 'Company Administrator',
                    'active' => 1
                ]);
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
     * Get the users that belong to the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\User','entity_id');
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
}
