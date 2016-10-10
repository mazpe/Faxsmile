<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon;
use Illuminate\Support\Facades\Auth;

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

        view()->composer('admin.provider.*', function ($view) {
            $provider_types = [
                'Fax Service' => "Fax Service"
            ];

            $states = [
                'FL' => "Florida"
            ];
            $page_title = 'Providers';

            $view->with('page_title', $page_title)
                ->with('provider_types', $provider_types)
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

            $client = Auth::user()->client;

            $view->with('page_title', 'Faxes')
                ->with('states', $states)
//                ->with('client', $client)
                ;
        });

        view()->composer('admin.user.*', function ($view) {
            $states = [
                'FL' => "Florida"
            ];

            $view->with('page_title', 'Users')
                ->with('states', $states);
        });

        view()->composer('admin.*', function ($view) {

            $user = Auth::user();
            $client = Auth::user()->client;
            $company = Auth::user()->company;

//            dd($company);

//            $view->with('client', $client)
//                ->with('user', $user)
//            ;

            $with = array_merge([
                'company' => $company,
                'client' => $client,
                'user' => $user
            ], $view->getData());

            $view->with($with);
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