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
        Form::component('bsText', 'components.form.text',[
            'name', 'title', 'value' => null, 'labelAttributes' => [], 'inputAttributes' => []
        ]);
        Form::component('bsTextArea', 'components.form.textarea',[
            'name', 'title', 'value' => null, 'labelAttributes' => [], 'inputAttributes' => []
        ]);
        Form::component('bsHidden', 'components.form.hidden',[
            'name', 'value' => null
        ]);
        Form::component('bsEmail', 'components.form.email', [
            'name', 'title', 'value' => null, 'labelAttributes' => [], 'inputAttributes' => []
        ]);
        Form::component('bsPassword', 'components.form.password', [
            'name', 'title', 'value' => null, 'labelAttributes' => [], 'inputAttributes' => []
        ]);
        Form::component('bsSelect', 'components.form.select', [
            'name', 'title' => null, 'value' => null, 'options' => null, 'labelAttributes' => [], 'inputAttributes' => []
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
