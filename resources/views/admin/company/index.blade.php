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
        <div id="companies_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="companies_length"><label>Show <select name="companies_length" aria-controls="companies" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12">
            <table id="companies" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="companies_info">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="companies" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 80px;">Type</th>
                    <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 195px;">Name</th>
                    <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 200px;">Notes</th>
                    <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 30px;">Active</th>
                    <th class="sorting" tabindex="0" aria-controls="companies" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">Action</th></tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                <tr role="row" class="odd">
                    <td class="sorting_1">{{ $company->type }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->notes }}</td>
                    <td>{{ $company->active }}</td>
                    <td>edit - delete</td>
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
        </div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="companies_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="companies_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="companies_previous"><a href="#" aria-controls="companies" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="companies" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="companies" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="companies" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="companies" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="companies" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="companies" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="companies_next"><a href="#" aria-controls="companies" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix no-border">
        <a class="btn btn-large btn-info pull-right" href="/admin/company/create"> <i class="fa fa-plus"></i> Create Company</a>
    </div>
</div>

<script>
    $(function () {
        $("#companies").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>

@endsection
