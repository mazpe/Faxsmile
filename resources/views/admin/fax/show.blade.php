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
                    <li><a href="#stats-pane" data-toggle="tab">Stats</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="info">
                        <!-- fax info -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div><strong>Number:</strong> {{ $fax->number }}</div>
                                    <div><strong>Provider:</strong> {{ $fax->provider->name }}</div>
                                    @if ($fax->user->cleint)
                                    <div><strong>Client:</strong> {{ $fax->user->client->name }}</div>
                                    @endif
                                    <div><strong>User:</strong> {{ $fax->user->fullName() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Note</strong>
                                    <p>{{ $fax->note }}.</p>
                                </div>
                            </div>
                        </div>

                        <!-- /.fax info -->
                    </div>
                    <!-- /.tab-pane -->

                    <!-- stats tab-pane -->
                    <div class="tab-pane" id="stats-pane">
                        <!-- box -->

                        <!-- /.box-body -->

                        <!-- /.fax faxs -->
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