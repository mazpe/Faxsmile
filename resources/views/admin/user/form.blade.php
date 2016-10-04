<div class="box-body">
    <!-- name, title, value, label attributes, input attributes -->
    {{ Form::bsSelect('entity_id', 'Client', isset($user) ? $user->entity->id : null, $clients,
        ['class' => 'col-sm-2 control-label'], ['id' => 'user-clients', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
    {{ Form::bsSelect('fax_id', 'Fax',
        isset($user->fax) ? $user->fax->id : null, // selected
        isset($user->client) ? $user->client->faxes : $faxes, // options
        ['class' => 'col-sm-2 control-label'], ['id' => 'user-faxes', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
    {{ Form::bsText('first_name', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('last_name', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsEmail('email',null,null,['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsPassword('password',null,null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('note', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>