<div class="box-body">
    <!-- name, title, value, label attributes, input attributes -->

    @if( Auth::user()->isSuperAdmin() )
        @if (Route::currentRouteName() == 'user.create')
            {{ Form::bsSelect('entity_id', 'Entity',
                isset($user) ? $user->entity_id : null, $entities, // selected
                ['class' => 'col-sm-2 control-label'], ['id' => 'user-entities', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
        @else
            @if ($user->entity->type == 'provider')
                {{ Form::bsSelect('entity_id', 'Provider',
                    isset($user) ? $user->entity_id : null, $providers, // selected
                    ['class' => 'col-sm-2 control-label'], ['id' => 'user-providers', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
            @elseif ($user->entity->type == 'company')
                {{ Form::bsSelect('entity_id', 'Company',
                    isset($user) ? $user->entity_id : null, $companies, // selected
                    ['class' => 'col-sm-2 control-label'], ['id' => 'user-companies', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
            @elseif ($user->entity->type == 'client')
                {{ Form::bsSelect('entity_id', 'Client',
                    isset($user) ? $user->entity_id : null, $clients, // selected
                    ['class' => 'col-sm-2 control-label'], ['id' => 'user-clients', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
            @endif
        @endif
    @elseif( Auth::user()->isCompanyAdmin() )
        @if ($user->entity->type == 'company')
            {{ Form::bsHidden('entity_id', $user->entity_id) }}
        @elseif ($user->entity->type == 'client')
            {{ Form::bsSelect('entity_id', 'Client',
                isset($user) ? $user->entity_id : null, $clients, // selected
                ['class' => 'col-sm-2 control-label'], ['id' => 'user-companies', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
        @endif
    @elseif(Auth::user()->isClientAdmin())
        @if ($user->entity->type == 'client')
            {{ Form::bsSelect('entity_id', 'Client',
                isset($user) ? $user->entity_id : null, $clients, // selected
                ['class' => 'col-sm-2 control-label'], ['id' => 'user-companies', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
        @endif
    @endif

    @if ( isset($user) && isset($user->entity) && $user->entity->type == 'client' && (Auth::user()->isCompanyAdmin() || Auth::user()->isClientAdmin()) )
        {{ Form::bsSelect('fax_id', 'Fax',
            isset($user) ? $user->fax_id : null, // selected
            isset($user) && isset($user->client) ? $user->client->faxes->pluck('number', 'id') : $faxes, // options
            ['class' => 'col-sm-2 control-label'], ['id' => 'user-faxes', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
    @endif


    {{ Form::bsText('first_name', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('last_name', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsEmail('email',null,null,['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('note', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>
