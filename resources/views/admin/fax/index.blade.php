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
                                @if(Auth::user()->isSuperAdmin())
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Provider: activate to sort column descending"
                                    style="width: 140px;">Provider
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Provider: activate to sort column descending"
                                    style="width: 140px;">Company
                                </th>
                                @endif
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Number: activate to sort column ascending" style="width: 10px;">Fax Number
                                </th>
                                @if(Auth::user()->isSuperAdmin() || Auth::user()->isCompanyAdmin())
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Number: activate to sort column ascending" style="width: 10px;">Client
                                </th>
                                @endif
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Description: activate to sort column ascending" style="width: 20px;">Description
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Sender: activate to sort column descending"
                                    style="width: 10px;">Senders
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="faxes" rowspan="1" colspan="1"
                                    aria-label="Sender: activate to sort column descending"
                                    style="width: 10px;">Recipients
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
                                    @if(Auth::user()->isSuperAdmin())
                                    <td>{{ $fax->provider->name }}</td>
                                    <td>{{ $fax->client->company->name }}</td>
                                    @endif
                                    <td>{{ $fax->number }}</td>
                                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isCompanyAdmin())
                                    <td>{{ $fax->client->name }}</td>
                                    @endif
                                    <td>{{ $fax->description }}</td>
                                    <td>{{ $fax->senders->count() }}</td>
                                    <td>{{ $fax->recipients->count() }}</td>
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
        <div class="box-footer clearfix no-border">
            @can('store', \App\Fax::class)
            <a class="btn btn-large btn-info pull-right" href="/admin/fax/create"> <i class="fa fa-plus"></i> Create
                Fax</a>
                @endcan
        </div>
    </div>

    <script>


    </script>

@endsection
