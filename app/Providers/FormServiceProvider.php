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
        Form::component('bsText', 'components.form.text', ['name', 'title' => null, 'value' => null, 'attributes' => [], 'class']);
        Form::component('bsPassword', 'components.form.password', ['name', 'title' => null, 'class']);
        Form::component('bsEmail', 'components.form.email', ['name', 'title' => null, 'value' => null, 'attributes' => [], 'class']);
        Form::component('bsSelect', 'components.form.select', ['name', 'title' => null, 'value' => null, 'attributes' => [], 'class']);
        Form::component('bsSubmit', 'components.form.submit', ['name', 'title' => null, 'value' => null, 'class']);
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
