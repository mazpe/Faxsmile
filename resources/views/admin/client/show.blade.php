@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Show Client</h3>
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

                    <h3 class="profile-username text-center">{{ $client->name }}</h3>

                    <div class="box">
                        <div class="box-header"><strong>Contact Information</strong></div>
                        <div class="box-body">
                            <p class="text-muted text-left">
                                <strong>First Name:</strong> {{ $client->contact_first_name }}<br/>
                                <strong>Last Name:</strong> {{ $client->contact_last_name }}<br/>
                                <strong>T:</strong> {{ $client->contact_phone }}<br />
                                <strong>E:</strong> {{ $client->contact_email }}
                            </p>
                        </div>
                    </div>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Faxes</b> <a class="pull-right">{{ $client->faxes->count() }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Users</b> <a class="pull-right">{{ $client->users->count() }}</a>
                        </li>
                    </ul>
                </div>
                {{ link_to_action('Admin\ClientController@edit', $title = 'Edit',
                $parameters = array($client->id),
                $attributes = array('class' => 'btn btn-primary btn-block')) }}
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#client_info_panel" data-toggle="tab">Info</a></li>
                    <li><a href="#client_faxes_panel" data-toggle="tab">Faxes</a></li>
                    <li><a href="#client_users_panel" data-toggle="tab">Users</a></li>
                    <li><a href="#client_settings_panel" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">

                    <!-- info tab-pane -->
                    <div class="active tab-pane" id="client_info_panel">
                        <!-- client info -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <div><strong>Name:</strong> {{ $client->name }}</div>
                                    <div><strong>Address 1:</strong> {{ $client->address_1 }}</div>
                                    <div><strong>Address 2:</strong> {{ $client->address_2 }}</div>
                                    <div><strong>City:</strong> {{ $client->city }}</div>
                                    <div><strong>State:</strong> {{ $client->state }}</div>
                                    <div><strong>Zip:</strong> {{ $client->zip }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box">
                                    <div><strong>Phone:</strong> {{ $client->phone }}</div>
                                    <div><strong>Fax:</strong> {{ $client->fax }}</div>
                                    <div><strong>Web Site:</strong> {{ $client->website }}</div>
                                    <div><strong>Time Zone:</strong> {{ $client->time_zone }}</div>
                                    <div><strong>External Account:</strong> {{ $client->external_account }}</div>
                                    <br/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                                    <p>{{ $client->note }}.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.client info -->
                    </div>
                    <!-- /.info tab-pane -->

                    <!-- faxes tab-pane -->
                    <div class="tab-pane" id="client_faxes_panel">
                        <!-- box -->
                        <div class="box-body">
                            <div id="client_faxes_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="client_faxes" class="table table-bordered table-striped hover dataTable" role="grid"
                                               aria-describedby="client_faxes_info" data-form="deleteForm">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="client_faxes" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 50px;">Fax Number
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="client_faxes" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 100px;">Description
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="client_faxes" rowspan="1" colspan="1"
                                                    aria-label="Active: activate to sort column ascending" style="width: 20px;">Active
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="client_faxes" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="width: 40px;">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($client->faxes as $fax)
                                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/fax/' . $fax->id)}}">
                                                    <td>{{ $fax->number }}</td>
                                                    <td>{{ $fax->description }}</td>
                                                    <td>{{ $fax->active }}</td>
                                                    <td>
                                                        {{ link_to_action('Admin\FaxController@show', $title = 'Show',
                                                            $parameters = array($fax->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}
                                                        {{ link_to_action('Admin\FaxController@edit', $title = 'Edit',
                                                            $parameters = array($fax->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}
                                                        {!! Form::open(['method' => 'DELETE','action' => ['Admin\FaxController@destroy', $fax->id],'class' => 'form-delete','style'=>'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.faxes tab-pane -->

                    <!-- users tab-pane -->
                    <div class="tab-pane" id="client_users_panel">
                        <!-- box -->
                        <div class="box-body">
                            <div id="client_users_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="client_users" class="table table-bordered table-striped hover dataTable" role="grid"
                                               aria-describedby="client_users_info" data-form="deleteForm">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="client_users" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 50px;">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="client_users" rowspan="1" colspan="1"
                                                    aria-label="Email: activate to sort column ascending" style="width: 20px;">Email
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="client_users" rowspan="1" colspan="1"
                                                    aria-label="Active: activate to sort column ascending" style="width: 20px;">Fax
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="client_users" rowspan="1" colspan="1"
                                                    aria-label="Role: activate to sort column ascending" style="width: 20px;">Role
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="client_users" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($client->users as $user)
                                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/user/' . $user->id)}}"></td>
                                                    <td>{{ $user->full_name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ isset($user->fax) ? $user->fax->number : "" }}
                                                    </td>
                                                    <td>{{ $user->roles->implode('name', ', ') }}</td>
                                                    <td>

                                                        {{ link_to_action('Admin\UserController@show', $title = 'Show',
                                                            $parameters = array($user->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}

                                                        {{ link_to_action('Admin\UserController@edit', $title = 'Edit',
                                                            $parameters = array($user->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}

                                                        {!! Form::open(['method' => 'DELETE','action' => ['Admin\UserController@destroy', $user->id],'style'=>'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <!-- /.client clients -->
                    </div>
                    <!-- /.users tab-pane -->

                    <!-- setting tab-pane -->
                    <div class="tab-pane" id="client_settings_panel">
                        <!-- box -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div><strong>From Email:</strong> {{ $emailConfig->from_email }}</div>
                                    <div><strong>From Name:</strong> {{ $emailConfig->from_name }}</div>
                                    <div><strong>Signature:</strong> {{ $emailConfig->signature }}</div>
                                    <div><strong>Note:</strong> {{ $emailConfig->note }}</div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.setting tab-pane -->

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
