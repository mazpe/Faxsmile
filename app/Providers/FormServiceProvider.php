<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;


class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the form components
        Form::component('bsText', 'components.form.text', ['name', 'value' => null, 'attributes' => [], 'class']);
        Form::component('bsSelect', 'components.form.select', ['name', 'value' => null, 'attributes' => [], 'class']);
        Form::component('bsSubmit', 'components.form.submit', ['name', 'value' => null, 'class']);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
