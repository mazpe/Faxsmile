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
    protected $softCascade = ['clients', 'users', 'settings', 'emailTemplates'];

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
            if (!Auth::user()) {
                return;
            }

            if (Auth::user()->isCompanyAdmin())
            {
                $builder->where('id', '=', Auth::user()->entity->id);
            }
            else if (Auth::user()->isClientAdmin())
            {
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
                $user = \App\User::create([
                    'first_name' => $company->contact_first_name,
                    'last_name' => $company->contact_last_name,
                    'entity_id' => $company->id,
                    'email' => $company->contact_email,
                    'password' => str_random(10),
                    'remember_token' => str_random(10),
                    'note' => 'Company Administrator',
                    'active' => 1
                ]);

                $role = Role::where('name', 'Company Admin')->first();
                $user->roles()->attach($role->id);

                $fax_incoming = "Fax ID: {{ \$fax_id }} <br>";
                $fax_incoming .= "Fax Job: {{ \$fax_job }} <br>";
                $fax_incoming .= "You received a fax message from {{ \$fax_from }} at {{ \$sendtime }} <br><br>";
                $fax_incoming .= "Your Fax Number Is: {{ \$fax_to }}";

                $fax_outgoing = "Your fax has been queued for delivery.<br><br>";
                $fax_outgoing .= "To: {{ \$fax_to }} <br>";
                $fax_outgoing .= "From: {{ \$fax_from }} <br>";
                $fax_outgoing .= "Source Email: {{ \$email_from }} <br>";
                $fax_outgoing .= "When: {{ \$sendtime }} <br><br>";
                $fax_outgoing .= "A preview of the sent document is attached to this email.";

                $fax_status = "Your fax job status update: {{ \$fax_status }} .<br><br>";
                $fax_status .= "To: {{ \$fax_to }} <br>";
                $fax_status .= "From: {{ \$fax_from }} <br>";
                $fax_status .= "Source Email: {{ \$email_from }} <br>";
                $fax_status .= "When: {{ \$sendtime }} <br><br>";
                $fax_status .= "@if(\$fax_status == 'success')";
                $fax_status .= "Completed: {{ \$completetime }} <br><br>";
                $fax_status .= "@endif";
                $fax_status .= "A preview of the sent document is attached to this email.";

                $unauthorized_access = "Not authorized to use this fax number";

                $setting = \App\Setting::create([
                    'entity_id'                     => $company->id,
                    'from_email'                    => $company->contact_email,
                    'fax_incoming_subject'          => 'You have recieved a fax',
                    'fax_incoming'                  => $fax_incoming,
                    'fax_outgoing_subject'          => 'Sent fax confirmation',
                    'fax_outgoing'                  => $fax_outgoing,
                    'fax_status_subject'            => 'Fax status change',
                    'fax_status'                    => $fax_status,
                    'unauthorized_access_subject'   => 'Unauthorized Access',
                    'unauthorized_access'           => $unauthorized_access,
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
    public function clientUsers() {
        return $this->hasManyThrough('App\User','App\Client','parent_id','entity_id');
    }

    /**
     * Get the users that belong to the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\User', 'entity_id');
    }

    /**
     * Get the company's setting
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function setting() {
        return $this->hasOne('App\Setting', 'entity_id');
    }

    ### CUSTOM FUNCTION
    public function makeCompanyUserAdmin($user) {
        $role = Role::where('name', 'Company Admin');
        $user->roles()->attach($role->id);
        return;
    }
}
