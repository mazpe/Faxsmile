<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class Company extends Entity
{
    use SoftDeletes;
    use SoftCascadeTrait;
    use SingleTableInheritanceTrait;

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
        return $this->hasMany('App\Client');
    }

    /**
     * Get the email config owned by the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailConfig() {
        return $this->hasOne('App\EmailConfig');
    }
}
