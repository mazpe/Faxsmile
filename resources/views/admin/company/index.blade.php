@extends('admin.admin_template')

@section('content')

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Active</span>
                    <span class="info-box-number">90<small>%</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Companies</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="companies_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="companies" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="companies_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="companies" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="Type: activate to sort column descending"
                                    style="width: 80px;">Type
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1"
                                    aria-label="Name: activate to sort column ascending" style="width: 195px;">Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1"
                                    aria-label="Notes: activate to sort column ascending" style="width: 200px;">Notes
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1"
                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">Active
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{ $company->type }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->notes }}</td>
                                    <td>{{ $company->active }}</td>
                                    <td>
                                        {{ link_to_action('Admin\CompanyController@show', $title = 'Edit',
                                            $parameters = array($company->id),
                                            $attributes = array('class' => 'btn btn-xs btn-default')) }}
                                        -
                                        delete</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Type</th>
                                <th rowspan="1" colspan="1">Name</th>
                                <th rowspan="1" colspan="1">Notes</th>
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
            <a class="btn btn-large btn-info pull-right" href="/admin/company/create"> <i class="fa fa-plus"></i> Create
                Company</a>
        </div>
    </div>

    <script>


    </script>

@endsection
