<div class="box-body">
    {{ Form::bsSelect('client_id', null,$clients,'col-sm-2 control-label') }}
    {{ Form::bsSelect('provider_id', null,$providers,'col-sm-2 control-label') }}
    {{ Form::bsText('number',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('note',null,[],'col-sm-2 control-label') }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>