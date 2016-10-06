@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Show User</h3>
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

                    <h3 class="profile-username text-center">{{ $user->full_name }}</h3>
                    @if($user->fax)
                    <p class="text-muted text-center">{{ $user->fax->number }}</p>
                    @endif
                    <p class="text-muted text-center">{{ $user->entity->name }}</p>


                    <div class="box">
                        <div class="box-header"><strong>Contact Information</strong></div>
                        <div class="box-body">
                            <p class="text-muted text-left">
                                <strong>First Name:</strong> {{ $user->first_name }}<br/>
                                <strong>Last Name:</strong> {{ $user->last_name }}<br/>
                                <strong>T:</strong> {{ $user->phone }}<br />
                                <strong>E:</strong> {{ $user->email }}
                            </p>
                        </div>
                    </div>
                </div>

                {{ link_to_action('Admin\UserController@edit', $title = 'Edit',
                $parameters = array($user->id),
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
                    <li><a href="#stats" data-toggle="tab">Stats</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="info">
                        <!-- user info -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div><strong>Name:</strong> {{ $user->full_name }}</div>
                                    <div><strong>Entity:</strong> {{ $user->entity->name }}</div>
                                    <div><strong>Entity Type:</strong> {{ ucfirst($user->entity->type) }}</div>
                                    <div><strong>Email:</strong> {{ $user->email }}</div>
                                    @if ($user->fax)
                                        <div><strong>Fax:</strong> {{ $user->fax->number }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Note</strong>
                                    <p>{{ $user->note }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.user info -->

                        <!-- user-as-recipient-tab-pane -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-header">
                                        <strong>Recipients</strong>
                                    </div>
                                    <!-- box-body -->
                                    <div class="box-body">
                                        <div id="fax_recipients_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table id="fax_recipients" class="table table-bordered table-striped hover dataTable" role="grid"
                                                           aria-describedby="fax_recipients_info">
                                                        <thead>
                                                        <tr role="row">
                                                            <th class="sorting_asc" tabindex="0" aria-controls="fax_recipients" rowspan="1" colspan="1"
                                                                aria-sort="ascending" aria-label="ID: activate to sort column descending"
                                                                style="width: 5px;">ID
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="fax_recipients" rowspan="1" colspan="1"
                                                                aria-label="Number: activate to sort column ascending" style="width: 250px;">Number
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($recipient->faxes as $fax)
                                                            <tr role="row" class="odd"  data-href="{{URL::to('/admin/client/' . $fax->id)}}">
                                                                <td class="sorting_1">{{ $fax->id }}</td>
                                                                <td>{{ $fax->number }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th rowspan="1" colspan="1">ID</th>
                                                            <th rowspan="1" colspan="1">Name</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>
                        <!-- /. user-as-recipient-tab-pane -->

                    </div>
                    <!-- /.tab-pane -->

                    <!-- stats tab-pane -->
                    <div class="tab-pane" id="stats">
                    </div>
                    <!-- /.stats tab-pane -->

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