<div class="box-body">
    {{ Form::bsSelect('client_id', null,$clients,'col-sm-2 control-label') }}
    {{ Form::bsSelect('fax_id', null,$faxes,'col-sm-2 control-label') }}
    {{ Form::bsText('name',null,[],'col-sm-2 control-label') }}
    {{ Form::bsEmail('email',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('note',null,[],'col-sm-2 control-label') }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>