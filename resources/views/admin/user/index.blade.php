@extends('admin.admin_template')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $page_title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="users_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="users" class="table table-bordered table-striped hover dataTable" role="grid"
                               aria-describedby="users_info" data-form="deleteForm">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="users" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="ID: activate to sort column ascending" style="width: 5px;">ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="users" rowspan="1" colspan="1"
                                    aria-label="Client: activate to sort column descending"
                                    style="width: 80px;">Client
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="users" rowspan="1" colspan="1"
                                    aria-label="Full Name: activate to sort column ascending" style="width: 195px;">Full Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="users" rowspan="1" colspan="1"
                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">E-Mail
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="users" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/user/' . $user->id)}}">
                                    <td class="sorting_1">{{ $user->id }}</td>
                                    <td>{{ $user->client->name }}</td>
                                    <td>{{ $user->fullName() }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {{ link_to_action('Admin\UserController@show', $title = 'Show',
                                            $parameters = array($user->id),
                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}
                                        {{ link_to_action('Admin\UserController@edit', $title = 'Edit',
                                            $parameters = array($user->id),
                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}
                                        {!! Form::open(['method' => 'DELETE','action' => ['Admin\UserController@destroy', $user->id],'class' => 'form-delete','style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Client</th>
                                <th rowspan="1" colspan="1">Full Name</th>
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
            <a class="btn btn-large btn-info pull-right" href="/admin/user/create"> <i class="fa fa-plus"></i> Create
                User</a>
        </div>
    </div>




@endsection
