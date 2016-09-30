@extends('admin.admin_template')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Companies</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="companies_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="companies" class="table table-bordered table-striped hover dataTable" role="grid"
                               aria-describedby="companies_info" data-form="deleteForm">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="companies" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="ID: activate to sort column descending"
                                    style="width: 5px;">ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1"
                                    aria-label="Name: activate to sort column ascending" style="width: 195px;">Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1"
                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">Active
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/company/' . $company->id)}}">
                                    <td class="sorting_1">{{ $company->id }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->active }}</td>
                                    <td>
                                        {{ link_to_action('Admin\CompanyController@show', $title = 'Show',
                                            $parameters = array($company->id),
                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}
                                        {{ link_to_action('Admin\CompanyController@edit', $title = 'Edit',
                                            $parameters = array($company->id),
                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}
                                        {!! Form::open(['method' => 'DELETE','action' => ['Admin\CompanyController@destroy', $company->id],'class' => 'form-delete','style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Type</th>
                                <th rowspan="1" colspan="1">Name</th>
                                <th rowspan="1" colspan="1">Active</th>
                                <th rowspan="1" colspan="1">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            <a class="btn btn-large btn-info pull-right" href="/admin/company/create"> <i class="fa fa-plus"></i> Create
                Company</a>
        </div>
    </div>

    <script>


    </script>

@endsection
