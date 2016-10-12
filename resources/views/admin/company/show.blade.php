@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Show Company</h3>
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

                    <h3 class="profile-username text-center">{{ $company->name }}</h3>

                    <div class="box">
                        <div class="box-header"><strong>Contact Information</strong></div>
                        <div class="box-body">
                            <p class="text-muted text-left">
                                <strong>First Name:</strong> {{ $company->contact_first_name }}<br/>
                                <strong>Last Name:</strong> {{ $company->contact_last_name }}<br/>
                                <strong>T:</strong> {{ $company->contact_phone }}<br />
                                <strong>E:</strong> {{ $company->contact_email }}
                            </p>
                        </div>
                    </div>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Clients</b> <a class="pull-right">{{ $company->clients->count() }}</a>
                        </li>
                    </ul>
                </div>

                {{ link_to_action('Admin\CompanyController@edit', $title = 'Edit',
                $parameters = array($company->id),
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
                    <li><a href="#company-clients" data-toggle="tab">Clients</a></li>
                    <li><a href="#company-faxes" data-toggle="tab">Faxes</a></li>
                    <li><a href="#company-users" data-toggle="tab">Users</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="info">
                        <!-- company info -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <div><strong>Name:</strong> {{ $company->name }}</div>
                                    <div><strong>Address 1:</strong> {{ $company->address_1 }}</div>
                                    <div><strong>Address 2:</strong> {{ $company->address_2 }}</div>
                                    <div><strong>City:</strong> {{ $company->city }}</div>
                                    <div><strong>State:</strong> {{ $company->state }}</div>
                                    <div><strong>Zip:</strong> {{ $company->zip }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box">
                                    <div><strong>Phone:</strong> {{ $company->phone }}</div>
                                    <div><strong>Fax:</strong> {{ $company->fax }}</div>
                                    <div><strong>Web Site:</strong> {{ $company->website }}</div>
                                    <div><strong>Domain:</strong> {{ $company->domain }}</div>
                                    <div><strong>Time Zone:</strong> {{ $company->time_zone }}</div>
                                    <div><strong>External Account:</strong> {{ $company->external_account }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Note</strong>
                                    <p>{{ $company->note }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- /.company info -->
                    </div>
                    <!-- /.tab-pane -->

                    <!-- company-clients-tab-pane -->
                    <div class="tab-pane" id="company-clients">
                        <!-- company clients -->

                        <!-- box -->
                        <div class="box-body">
                            <div id="company_clients_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="company_clients" class="table table-bordered table-striped hover dataTable" role="grid"
                                               aria-describedby="company_clients_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-sort="ascending" aria-label="ID: activate to sort column descending"
                                                    style="width: 5px;">ID
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Faxes
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Users
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">Active
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($company_clients as $client)
                                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/client/' . $client->id)}}">
                                                    <td class="sorting_1">{{ $client->id }}</td>
                                                    <td>{{ $client->name }}</td>
						    <td>{{ $client->faxes_count }}</td>
						    <td>{{ $client->users_count }}</td>
                                                    <td>{{ $client->active }}</td>
                                                    <td>
                                                        {{ link_to_action('Admin\ClientController@show', $title = 'Show',
                                                            $parameters = array($client->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}
                                                        {{ link_to_action('Admin\ClientController@edit', $title = 'Edit',
                                                            $parameters = array($client->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}
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

                        <!-- /.company clients -->
                    </div>
                    <!-- /.tab-pane -->

                    <!-- company-users-tab-pane -->
                    <div class="tab-pane" id="company-users">
                        <!-- company clients -->

                        <!-- box -->
                        <div class="box-body">
                            <div id="company_users_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="company_users" class="table table-bordered table-striped hover dataTable" role="grid"
                                               aria-describedby="company_users_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-sort="ascending" aria-label="ID: activate to sort column descending"
                                                    style="width: 5px;">ID
                                                <th class="sorting" tabindex="0" aria-controls="company_users" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_users" rowspan="1" colspan="1"
                                                    aria-label="Role: activate to sort column ascending" style="width: 100px;">Role
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_users" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($company_users as $user)
                                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/user/' . $user->id)}}">
                                                    <td class="sorting_1">{{ $user->id }}</td>
                                                    <td>{{ $user->full_name }}</td>
                                                    <td>{{ $user->roles->implode('name', ', ') }}</td>
                                                    <td>
                                                        {{ link_to_action('Admin\UserController@show', $title = 'Show',
                                                            $parameters = array($user->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}
                                                        {{ link_to_action('Admin\UserController@edit', $title = 'Edit',
                                                            $parameters = array($user->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}
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

                        <!-- /.company users -->
                    </div>
                    <!-- /.tab-pane -->

                    <!-- company-faxes-tab-pane -->
                    <div class="tab-pane" id="company-faxes">
                        <!-- company faxes -->

                        <!-- box -->
                        <div class="box-body">
                            <div id="company_faxes_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="company_faxes" class="table table-bordered table-striped hover dataTable" role="grid"
                                               aria-describedby="company_faxes_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-sort="ascending" aria-label="ID: activate to sort column descending"
                                                    style="width: 5px;">ID
                                                <th class="sorting" tabindex="0" aria-controls="company_faxes" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Fax Number
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="client_faxes" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Client
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_faxes" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 250px;">Description
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_faxes" rowspan="1" colspan="1"
                                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">Active
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_faxes" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($company->faxes as $fax)
                                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/fax/' . $fax->id)}}">
                                                    <td class="sorting_1">{{ $fax->id }}</td>
                                                    <td>{{ $fax->number }}</td>
                                                    <td>{{ $fax->name }}</td>
                                                    <td>{{ $fax->description }}</td>
                                                    <td>{{ $fax->active }}</td>
                                                    <td>
                                                        {{ link_to_action('Admin\FaxController@show', $title = 'Show',
                                                            $parameters = array($fax->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}
                                                        {{ link_to_action('Admin\FaxController@edit', $title = 'Edit',
                                                            $parameters = array($fax->id),
                                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}
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

                        <!-- /.company faxes -->
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
