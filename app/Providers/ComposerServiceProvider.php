<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using Closure based composers...
        view()->composer('admin.company.*', function ($view) {
            $company_types = [
                'White Label' => "White Label",
                'Reseller' => "Reseller",
            ];

            $states = [
                'FL' => "Florida"
            ];

            $view->with('page_title', 'Companies')
                ->with('company_types', $company_types)
                ->with('states', $states);
        });

        view()->composer('admin.client.*', function ($view) {
            $states = [
                'FL' => "Florida"
            ];

            $view->with('page_title', 'Clients')
                ->with('states', $states);
        });

        view()->composer('admin.fax.*', function ($view) {
            $states = [
                'FL' => "Florida"
            ];

            $view->with('page_title', 'Faxes')
                ->with('states', $states);
        });

        view()->composer('admin.user.*', function ($view) {
            $states = [
                'FL' => "Florida"
            ];

            $view->with('page_title', 'Users')
                ->with('states', $states);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}