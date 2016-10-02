<div class="box-body">
    {{ Form::bsSelect('provider_id','Provider',isset($fax) ? $fax->provider->id : null,$providers,'col-sm-2 control-label') }}
    {{ Form::bsSelect('client_id','Client',isset($client) ? $client->id : null,$clients,'col-sm-2 control-label', 'fax_client') }}
    {{ Form::bsSelect('sender_id','Sender',isset($user) ? $user->id : null,$users,'col-sm-2 control-label','fax_sender') }}
    {{ Form::bsText('recipients','Recipients', null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('number','Fax Number', null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('description',null,null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('note',null,null,[],'col-sm-2 control-label') }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>