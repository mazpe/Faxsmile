@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Create Company</h3>
    </div>

    <!-- form start -->
    @if (count($errors) > 0)
        <div class="box-body">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {!! Form::open(['action' => 'Admin\CompanyController@store', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
        {{ Form::bsSelect('type', null, $company_types, 'col-sm-2 control-label') }}
        {{ Form::bsText('name',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('address_1',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('address_2',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('city',null,[],'col-sm-2 control-label') }}
        {{ Form::bsSelect('state', null,$states,'col-sm-2 control-label') }}
        {{ Form::bsText('zip',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('phone',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('fax',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('website',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('fax_domain',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('domain',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('time_zone',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('external_account',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('contact',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('contact_phone',null,[],'col-sm-2 control-label') }}
        {{ Form::bsText('notes',null,[],'col-sm-2 control-label') }}
        {{ Form::bsSubmit('Create Company', '','btn btn-info pull-right') }}
    </div>
    {!! Form::close() !!}
</div>
@endsection