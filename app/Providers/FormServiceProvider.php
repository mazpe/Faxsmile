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
        Form::component('bsText', 'components.form.text', [
            'name', 'title' => null, 'value' => null, 'attributes' => [], 'class', 'id'
        ]);
        Form::component('bsPassword', 'components.form.password', [
            'name', 'title' => null, 'class', 'id'
        ]);
        Form::component('bsEmail', 'components.form.email', [
            'name', 'title' => null, 'value' => null, 'attributes' => [], 'class', 'id'
            ]
        );
        Form::component('bsSelect', 'components.form.select', [
            'name', 'title' => null, 'value' => null, 'attributes' => [], 'class', 'id'
        ]);
        Form::component('bsSubmit', 'components.form.submit', [
            'name', 'title' => null, 'value' => null, 'class', 'id'
        ]);
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
