<div class="box-body">
    {{ Form::bsSelect('entity_id', isset($user) ? $user->entity->id : null,$clients,'col-sm-2 control-label') }}
    {{ Form::bsSelect('fax_id', null,$faxes,'col-sm-2 control-label') }}
    {{ Form::bsText('first_name',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('last_name',null,[],'col-sm-2 control-label') }}
    {{ Form::bsEmail('email',null,[],'col-sm-2 control-label') }}
    {{ Form::bsPassword('password','col-sm-2 control-label') }}
    {{ Form::bsText('note',null,[],'col-sm-2 control-label') }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>