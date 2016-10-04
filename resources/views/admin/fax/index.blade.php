@extends('admin.admin_template')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Faxes</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="faxes_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="faxes" class="table table-bordered table-striped hover dataTable" role="grid"
                               aria-describedby="faxes_info" data-form="deleteForm">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="ID: activate to sort column ascending" style="width: 5px;">ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Provider: activate to sort column descending"
                                    style="width: 80px;">Provider
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Sender: activate to sort column descending"
                                    style="width: 80px;">Sender
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Number: activate to sort column ascending" style="width: 20px;">Number
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Description: activate to sort column ascending" style="width: 20px;">Description
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Active: activate to sort column ascending" style="width: 20px;">Active
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($faxes as $fax)
                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/fax/' . $fax->id)}}">
                                    <td class="sorting_1">{{ $fax->id }}</td>
                                    <td>{{ $fax->provider->name }}</td>
                                    <td>{{ isset($fax->sender) ? $fax->sender->full_name : '' }}</td>
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
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Provider</th>
                                <th rowspan="1" colspan="1">Sender</th>
                                <th rowspan="1" colspan="1">Number</th>
                                <th rowspan="1" colspan="1">Description</th>
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
            <a class="btn btn-large btn-info pull-right" href="/admin/fax/create"> <i class="fa fa-plus"></i> Create
                Fax</a>
        </div>
    </div>

    <script>


    </script>

@endsection
