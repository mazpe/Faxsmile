@extends('admin.admin_template')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $page_title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="providers_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="providers" class="table table-bordered table-striped hover dataTable" role="grid"
                               aria-describedby="providers_info" data-form="deleteForm">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="providers" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="Type: activate to sort column descending"
                                    style="width: 10px;">ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="providers" rowspan="1" colspan="1"
                                    aria-label="Name: activate to sort column ascending" style="width: 195px;">Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="providers" rowspan="1" colspan="1"
                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">Active
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="providers" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($providers as $provider)
                                <tr role="row" class="odd"  data-href="{{URL::to('/admin/provider/' . $provider->id)}}">
                                    <td class="sorting_1">{{ $provider->id }}</td>
                                    <td>{{ $provider->name }}</td>
                                    <td>{{ $provider->active }}</td>
                                    <td>
                                        {{ link_to_action('Admin\ProviderController@show', $title = 'Show',
                                            $parameters = array($provider->id),
                                            $attributes = array('class' => 'btn btn-xs btn-success')) }}
                                        {{ link_to_action('Admin\ProviderController@edit', $title = 'Edit',
                                            $parameters = array($provider->id),
                                            $attributes = array('class' => 'btn btn-xs btn-info')) }}
                                        {!! Form::open(['method' => 'DELETE','action' => ['Admin\ProviderController@destroy', $provider->id],'class' => 'form-delete','style'=>'display:inline']) !!}
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
            <a class="btn btn-large btn-info pull-right" href="/admin/provider/create"> <i class="fa fa-plus"></i> Create
                Provider</a>
        </div>
    </div>

    <script>


    </script>

@endsection
