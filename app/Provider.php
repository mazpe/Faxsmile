<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Provider extends Entity
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected static $singleTableType = 'provider';
    protected $softCascade = ['provider_configs', 'faxes'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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

}
