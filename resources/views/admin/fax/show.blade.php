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
                                    <div><strong>Provider:</strong> {{ $fax->provider->name }}</div>
                                    <div><strong>Fax Number:</strong> {{ $fax->number }}</div>
                                    @if ($fax->client)
                                    <div><strong>Client:</strong> {{ $fax->client->name }}</div>
                                    @endif
                                    <div><strong>Description:</strong> {{ $fax->description }}</div>
                                    @if ($fax->sender)
                                    <div><strong>Sender:</strong> {{ $fax->sender->full_name }}</div>
                                    @endif
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

                        <!-- fax-senders-tab-pane -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-header">
                                        <strong>Senders</strong>
                                    </div>
                                    <!-- box-body -->
                                    <div class="box-body">
                                        <div id="fax_senders_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table id="fax_senders" class="table table-bordered table-striped hover dataTable" role="grid"
                                                           aria-describedby="fax_senders_info">
                                                        <thead>
                                                        <tr role="row">
                                                            <th class="sorting_asc" tabindex="0" aria-controls="fax_senders" rowspan="1" colspan="1"
                                                                aria-sort="ascending" aria-label="ID: activate to sort column descending"
                                                                style="width: 5px;">ID
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="fax_senders" rowspan="1" colspan="1"
                                                                aria-label="Name: activate to sort column ascending" style="width: 250px;">Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="fax_senders" rowspan="1" colspan="1"
                                                                aria-label="Email: activate to sort column ascending" style="width: 30px;">Email
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($fax->senders as $sender)
                                                            <tr role="row" class="odd"  data-href="{{URL::to('/admin/client/' . $sender->id)}}">
                                                                <td class="sorting_1">{{ $sender->id }}</td>
                                                                <td>{{ $sender->full_name }}</td>
                                                                <td>{{ $sender->email }}</td>
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
                            </div>
                        </div>
                        <!-- /. fax-senders-tab-pane -->

                        <!-- fax-recipients-tab-pane -->
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
                                                                aria-label="Name: activate to sort column ascending" style="width: 250px;">Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="fax_recipients" rowspan="1" colspan="1"
                                                                aria-label="Email: activate to sort column ascending" style="width: 30px;">Email
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($fax->recipients as $recipient)
                                                            <tr role="row" class="odd"  data-href="{{URL::to('/admin/client/' . $recipient->id)}}">
                                                                <td class="sorting_1">{{ $recipient->id }}</td>
                                                                <td>{{ $recipient->full_name }}</td>
                                                                <td>{{ $recipient->email }}</td>
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
                            </div>
                        </div>
                        <!-- /. fax-recipients-tab-pane -->

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
