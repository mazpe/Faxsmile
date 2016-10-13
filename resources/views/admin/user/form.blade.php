<div class="box-body">
    <!-- name, title, value, label attributes, input attributes -->
    @if ( isset($user) && isset($user->entity) && $user->entity->type == 'client' && Auth::user()->isCompanyAdmin() )
    {{ Form::bsSelect('entity_id', 'Client',
        isset($user) && isset($user->entity) ? $user->entity->id : null, $clients, // selected
        ['class' => 'col-sm-2 control-label'], ['id' => 'user-clients', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
    @elseif(isset($user) && Auth::user()->isClientAdmin())
        {{ Form::bsHidden('entity_id', $user->entity_id) }}
    @endif

    @if ( isset($user) && isset($user->entity) && $user->entity->type == 'client' && (Auth::user()->isCompanyAdmin() || Auth::user()->isClientAdmin()) )
    {{ Form::bsSelect('fax_id', 'Fax',
        isset($user) ? $user->fax_id : null, // selected
        isset($user) && isset($user->client) ? $user->client->faxes->pluck('number', 'id') : $faxes, // options
        ['class' => 'col-sm-2 control-label'], ['id' => 'user-faxes', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
    @endif

    @if (isset($user) && isset($user->entity) && $user->entity->type == 'company')
        {{ Form::bsSelect('entity_id', 'Company',
            isset($user) && isset($user->entity)? $user->entity->id : null, $companies, // selected
            ['class' => 'col-sm-2 control-label'], ['id' => 'user-companies', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
    @endif
    {{ Form::bsText('first_name', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('last_name', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsEmail('email',null,null,['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('note', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>
