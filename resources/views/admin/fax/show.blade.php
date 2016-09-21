@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Show Fax</h3>
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

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="http://www.socialagent.me/wp-content/uploads/2014/07/avatarDefault.png" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $fax->number }}</h3>

                    <p class="text-muted text-center">{{ $fax->client->name }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Users</b> <a class="pull-right">543</a>
                        </li>
                    </ul>
                </div>

                {{ link_to_action('Admin\FaxController@edit', $title = 'Edit',
                $parameters = array($fax->id),
                $attributes = array('class' => 'btn btn-primary btn-block')) }}
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
                    <li><a href="#users-pane" data-toggle="tab">Users</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="info">
                        <!-- fax info -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div><strong>Number:</strong> {{ $fax->number }}</div>
                                    <div><strong>Client:</strong> {{ $fax->client->name }}</div>
                                    <div><strong>Provider:</strong> {{ $fax->provider }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                                    <p>{{ $fax->notes }}.</p>
                                </div>
                            </div>
                        </div>

                        <!-- /.fax info -->
                    </div>
                    <!-- /.tab-pane -->

                    <!-- users tab-pane -->
                    <div class="tab-pane" id="users-pane">
                        <!-- box -->
                        <div class="box-body">
                            <div id="fax_users_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="fax_users" class="table table-bordered table-striped hover dataTable" role="grid"
                                               aria-describedby="fax_users_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="fax_users" rowspan="1" colspan="1"
                                                    aria-sort="ascending" aria-label="ID: activate to sort column ascending" style="width: 5px;">ID
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="fax_users" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="fax_users" rowspan="1" colspan="1"
                                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">Active
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="fax_users" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="width: 70px;">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($fax->users as $user)
                                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/user/' . $user->id)}}">
                                                    <td class="sorting_1">{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->active }}</td>
                                                    <td>
                                                        {{ link_to_action('Admin\FaxController@show', $title = 'Show',
                                                            $parameters = array($user->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}
                                                        {{ link_to_action('Admin\FaxController@edit', $title = 'Edit',
                                                            $parameters = array($user->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}
                                                        {!! Form::open(['method' => 'DELETE','action' => ['Admin\FaxController@destroy', $fax->id],'style'=>'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">ID</th>
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

                        <!-- /.fax faxs -->
                    </div>
                    <!-- /.users tab-pane -->

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


</div>
@endsection