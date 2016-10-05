<div class="box-body">

    <!-- name, title, value, label attributes, input attributes -->
    {{ Form::bsSelect('provider_id', 'Provider',
        isset($fax) ? $fax->provider->id : null, $providers,
        ['class' => 'col-sm-2 control-label'], ['id' => 'fax-providers', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
    {{ Form::bsSelect('client_id', 'Client',
        isset($fax) ? $fax->client_id : null, $clients,
        ['class' => 'col-sm-2 control-label'], ['id' => 'fax-clients', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
    {{ Form::bsText('senders', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('recipients', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('number', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('description', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('notes', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}

    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>