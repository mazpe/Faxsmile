@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Fax</h3>
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

    {!! Form::model($fax, ['method' => 'PATCH','action' => ['Admin\FaxController@update', $fax->id],
        'class' => 'form-horizontal']) !!}
        <div class="box-body">
            @include('admin.fax.form')
        </div>
    {!! Form::close() !!}

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
                                       aria-describedby="fax_senders_info" data-form="deleteForm">
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
                                        <th class="sorting" tabindex="0" aria-controls="fax_senders" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending" style="width: 30px;">Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fax->senders as $sender)
                                        <tr role="row" class="odd"  data-href="{{URL::to('/admin/client/' . $sender->id)}}">
                                            <td class="sorting_1">{{ $sender->id }}</td>
                                            <td>{{ $sender->full_name }}</td>
                                            <td>{{ $sender->email }}</td>
                                            <td>
                                            {!! Form::open(['method' => 'DELETE','action' => ['Admin\Fax\SenderController@destroy', $fax->id, $sender->id],'class' => 'form-delete','style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                                            {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">ID</th>
                                        <th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1">Email</th>
                                        <th rowspan="1" colspan="1">Action</th>
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
                                        <th class="sorting" tabindex="0" aria-controls="fax_senders" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending" style="width: 30px;">Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fax->recipients as $recipient)
                                        <tr role="row" class="odd"  data-href="{{URL::to('/admin/client/' . $recipient->id)}}">
                                            <td class="sorting_1">{{ $recipient->id }}</td>
                                            <td>{{ $recipient->full_name }}</td>
                                            <td>{{ $recipient->email }}</td>
                                            <td>
                                                {!! Form::open(['method' => 'DELETE','action' => ['Admin\Fax\RecipientController@destroy', $fax->id, $recipient->id],'class' => 'form-delete','style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">ID</th>
                                        <th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1">Email</th>
                                        <th rowspan="1" colspan="1">Action</th>
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
    <!-- /. fax-recipients-tab-pane -->


</div>
@endsection