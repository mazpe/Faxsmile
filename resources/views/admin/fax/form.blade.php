<div class="box-body">
    {{ Form::bsSelect('provider_id', isset($fax) ? $fax->provider->id : null,$providers,'col-sm-2 control-label') }}
    {{ Form::bsSelect('user_id', isset($user) ? $user->id : null,$users,'col-sm-2 control-label') }}
    {{ Form::bsText('number',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('description',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('note',null,[],'col-sm-2 control-label') }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>