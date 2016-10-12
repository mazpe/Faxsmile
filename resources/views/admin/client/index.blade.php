@extends('admin.admin_template')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Clients</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="clients_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="clients" class="table table-bordered table-striped hover dataTable" role="grid"
                               aria-describedby="clients_info" data-form="deleteForm">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="clients" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="ID: activate to sort column ascending" style="width: 10px;">ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="clients" rowspan="1" colspan="1"
                                    aria-label="Name: activate to sort column ascending" style="width: 195px;">Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="clients" rowspan="1" colspan="1"
                                    aria-label="Contact: activate to sort column ascending" style="width: 30px;">Contact
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="clients" rowspan="1" colspan="1"
                                    aria-label="Faxes: activate to sort column ascending" style="width: 30px;">Faxes
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="clients" rowspan="1" colspan="1"
                                    aria-label="Users: activate to sort column ascending" style="width: 30px;">Users
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="clients" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/client/' . $client->id)}}">
                                    <td class="sorting_1">{{ $client->id }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->contact_first_name }} {{ $client->contact_last_name }}</td>
                                    <td>{{ $client->faxes_count }}</td>
                                    <td>{{ $client->users_count }}</td>
                                    <td>
                                        {{ link_to_action('Admin\ClientController@show', $title = 'Show',
                                            $parameters = array($client->id),
                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}
                                        {{ link_to_action('Admin\ClientController@edit', $title = 'Edit',
                                            $parameters = array($client->id),
                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}
                                        {!! Form::open(['method' => 'DELETE','action' => ['Admin\ClientController@destroy', $client->id],'class' => 'form-delete','style'=>'display:inline']) !!}
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
        <div class="box-footer clearfix no-border">
            <a class="btn btn-large btn-info pull-right" href="/admin/client/create"> <i class="fa fa-plus"></i> Create
                Client</a>
        </div>
    </div>

    <script>


    </script>

@endsection
