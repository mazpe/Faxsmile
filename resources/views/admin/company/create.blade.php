@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Create Company</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['action' => 'Admin\CompanyController@store', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
        {{ Form::bsSelect('type', '', $company_types) }}
        {{ Form::bsText('name') }}
        {{ Form::bsText('address_1') }}
        {{ Form::bsText('address_2') }}
        {{ Form::bsText('city') }}
        {{ Form::bsSelect('state', '', $states) }}
        {{ Form::bsText('zip') }}
        {{ Form::bsText('phone') }}
        {{ Form::bsText('fax') }}
        {{ Form::bsText('website') }}
        {{ Form::bsText('fax_domain') }}
        {{ Form::bsText('domain') }}
        {{ Form::bsText('time_zone') }}
        {{ Form::bsText('external_account') }}
        {{ Form::bsText('contact') }}
        {{ Form::bsText('contact_phone') }}
        {{ Form::bsText('notes') }}
        {{ Form::bsSubmit('Create Company', '','btn btn-info pull-right') }}
    </div>
    {!! Form::close() !!}
</div>
@endsection