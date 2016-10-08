<?php

namespace App\Providers;

use App\Company;
use App\Provider;
use App\Client;
use App\Fax;
use App\Policies\CompanyPolicy;
use App\Policies\ProviderPolicy;
use App\Policies\ClientPolicy;
use App\Policies\FaxPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Company::class => CompanyPolicy::class,
        Provider::class => ProviderPolicy::class,
        Client::class => ClientPolicy::class,
        Fax::class => FaxPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
