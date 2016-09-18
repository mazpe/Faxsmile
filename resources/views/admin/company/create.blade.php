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


        <div class="form-group">
            {{ Form::label('type', 'Type', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::select('type', $company_types, null,
                    ['class' => 'form-control','placeholder' => 'Pick a size...']) }}
            </div>
        </div>

        <div class="form-group">
        {{ Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
            {{ Form::text('name', '', ['class' => 'form-control']) }}
            </div>
        </div>

        {{  Form::submit('Click Me!') }}
    </div>
    {!! Form::close() !!}
</div>
@endsection