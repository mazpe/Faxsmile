@extends('admin.admin_template')

@section('content')

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Active</span>
                    <span class="info-box-number">90<small>%</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>


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
                               aria-describedby="users_info">
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
                                    aria-label="Name: activate to sort column ascending" style="width: 195px;">Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="users" rowspan="1" colspan="1"
                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">Active
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
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->active }}</td>
                                    <td>
                                        {{ link_to_action('Admin\UserController@show', $title = 'Show',
                                            $parameters = array($user->id),
                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}
                                        {{ link_to_action('Admin\UserController@edit', $title = 'Edit',
                                            $parameters = array($user->id),
                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}
                                        {!! Form::open(['method' => 'DELETE','action' => ['Admin\UserController@destroy', $user->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Client</th>
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
            <a class="btn btn-large btn-info pull-right" href="/admin/user/create"> <i class="fa fa-plus"></i> Create
                User</a>
        </div>
    </div>

    <script>


    </script>

@endsection
