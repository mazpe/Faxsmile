<div class="box-body">
    <!-- name, title, value, label attributes, input attributes -->

    @if( Auth::user()->isSuperAdmin() )
        {{ Form::bsHidden('company_id', $company->id) }}
    @elseif( Auth::user()->isCompanyAdmin() )
        {{ Form::bsHidden('company_id', $company->id) }}
    @elseif(Auth::user()->isClientAdmin())
        {{ Form::bsHidden('company_id', $company->id) }}
    @endif

    {{ Form::bsText('from_name', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsEmail('from_email',null,null,['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('signature', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('note', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('note', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>
