@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Company</h3>
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

    {!! Form::model($company, ['method' => 'PATCH','action' => ['Admin\CompanyController@update', $company->id],
        'class' => 'form-horizontal']) !!}
        <div class="box-body">
            @include('admin.client.form')
        </div>
    {!! Form::close() !!}
</div>
@endsection