<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Company extends Entity
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected static $singleTableType = 'company';
    protected $softCascade = ['clients', 'email_configs', 'email_templates'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
