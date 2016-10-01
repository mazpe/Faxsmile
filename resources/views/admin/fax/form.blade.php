<div class="box-body">
    {{ Form::bsSelect('provider_id','Provider',isset($fax) ? $fax->provider->id : null,$providers,'col-sm-2 control-label') }}
    {{ Form::bsSelect('user_id','Recipient',isset($user) ? $user->id : null,$users,'col-sm-2 control-label') }}
    {{ Form::bsText('Fax Number',null, null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('description',null,null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('note',null,null,[],'col-sm-2 control-label') }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>