@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Show Provider</h3>
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

                    <h3 class="profile-username text-center">{{ $provider->name }}</h3>

                    <div class="box">
                        <div class="box-header"><strong>Contact Information</strong></div>
                        <div class="box-body">
                            <p class="text-muted text-left">
                                <strong>First Name:</strong> {{ $provider->contact_first_name }}<br/>
                                <strong>Last Name:</strong> {{ $provider->contact_last_name }}<br/>
                                <strong>T:</strong> {{ $provider->contact_phone }}<br />
                                <strong>E:</strong> {{ $provider->contact_email }}
                            </p>
                        </div>
                    </div>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Faxes</b> <a class="pull-right">{{ $provider->faxes->count() }}</a>
                        </li>
                    </ul>
                </div>

                {{ link_to_action('Admin\ProviderController@edit', $title = 'Edit',
                $parameters = array($provider->id),
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
                    <li><a href="#provider-faxes-pane" data-toggle="tab">Faxes</a></li>
                    <li><a href="#provider-users-pane" data-toggle="tab">Users</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="info">
                        <!-- provider info -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <div><strong>Name:</strong> {{ $provider->name }}</div>
                                    <div><strong>Type:</strong> {{ $provider->type }}</div>
                                    <div><strong>Address 1:</strong> {{ $provider->address_1 }}</div>
                                    <div><strong>Address 2:</strong> {{ $provider->address_2 }}</div>
                                    <div><strong>City:</strong> {{ $provider->city }}</div>
                                    <div><strong>State:</strong> {{ $provider->state }}</div>
                                    <div><strong>Zip:</strong> {{ $provider->zip }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box">
                                    <div><strong>Contact:</strong> {{ $provider->contact }}</div>
                                    <div><strong>Contact Phone:</strong> {{ $provider->contact_phone }}</div>
                                    <div><strong>Phone:</strong> {{ $provider->phone }}</div>
                                    <div><strong>Fax:</strong> {{ $provider->fax }}</div>
                                    <div><strong>Web Site:</strong> {{ $provider->website }}</div>
                                    <div><strong>Time Zone:</strong> {{ $provider->time_zone }}</div>
                                    <div><strong>External Account:</strong> {{ $provider->external_account }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Note</strong>
                                    <p>{{ $provider->note }}.</p>
                                </div>
                            </div>
                        </div>

                        <!-- /.provider info -->
                    </div>
                    <!-- /.tab-pane -->

                    <!-- provider-faxes-pane -->
                    <div class="tab-pane" id="provider-faxes-pane">
                        <!-- provider faxes -->

                        <!-- box -->
                        <div class="box-body">
                            <div id="provider_faxes_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="provider_faxes" class="table table-bordered table-striped hover dataTable" role="grid"
                                               aria-describedby="provider_faxes_info" data-form="deleteForm">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="provider_faxes" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Fax Number
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="provider_faxes" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Client
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="provider_faxes" rowspan="1" colspan="1"
                                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">Active
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="provider_faxes" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($provider_faxes as $fax)
                                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/fax/' . $fax->id)}}">
                                                    <td>{{ $fax->number }}</td>
                                                    <td>{{ $fax->client ? $fax->client->name : '' }}</td>
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

                        <!-- /.provider faxes -->
                    </div>
                    <!-- /.tab-pane -->

                    <!-- provider-users-tab-pane -->
                    <div class="tab-pane" id="provider-users-pane">
                        <!-- provider clients -->

                        <!-- box -->
                        <div class="box-body">
                            <div id="provider_users_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="provider_users" class="table table-bordered table-striped hover dataTable" role="grid"
                                               aria-describedby="provider_users_info" data-form="deleteForm">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="provider_users" rowspan="1" colspan="1"
                                                    aria-sort="ascending" aria-label="ID: activate to sort column descending"
                                                    style="width: 5px;">ID
                                                <th class="sorting" tabindex="0" aria-controls="provider_users" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="provider_users" rowspan="1" colspan="1"
                                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">Active
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="provider_users" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($provider_users as $user)
                                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/user/' . $user->id)}}">
                                                    <td class="sorting_1">{{ $user->id }}</td>
                                                    <td>{{ $user->full_name }}</td>
                                                    <td>{{ $user->active }}</td>
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <!-- /.provider users -->
                    </div>
                    <!-- /.tab-pane -->

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
