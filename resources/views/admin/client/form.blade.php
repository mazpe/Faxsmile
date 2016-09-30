<div class="box-body">
    {{ Form::bsSelect('company_id',$client->company->id,$companies,'col-sm-2 control-label') }}
    {{ Form::bsText('name',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('address_1',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('address_2',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('city',null,[],'col-sm-2 control-label') }}
    {{ Form::bsSelect('state', null,$states,'col-sm-2 control-label') }}
    {{ Form::bsText('zip',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('phone',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('fax',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('website',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('contact_first_name',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('contact_last_name',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('contact_phone',null,[],'col-sm-2 control-label') }}
    {{ Form::bsEmail('contact_email',null,[],'col-sm-2 control-label') }}
    {{ Form::bsText('note',null,[],'col-sm-2 control-label') }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>