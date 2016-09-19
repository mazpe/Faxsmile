@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Show Company</h3>
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

                    <h3 class="profile-username text-center">{{ $company->name }}</h3>

                    <p class="text-muted text-center">{{ $company->type }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Clients</b> <a class="pull-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                            <b>Faxes</b> <a class="pull-right">543</a>
                        </li>
                    </ul>
                </div>
                <a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
                    <li><a href="#company-clients" data-toggle="tab">Clients</a></li>
                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="info">
                        <!-- company info -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <div><strong>Name:</strong> {{ $company->name }}</div>
                                    <div><strong>Type:</strong> {{ $company->type }}</div>
                                    <div><strong>Address 1:</strong> {{ $company->address_1 }}</div>
                                    <div><strong>Address 2:</strong> {{ $company->address_2 }}</div>
                                    <div><strong>City:</strong> {{ $company->city }}</div>
                                    <div><strong>State:</strong> {{ $company->state }}</div>
                                    <div><strong>Zip:</strong> {{ $company->zip }}</div>
                                    <br />
                                    <br />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box">
                                    <div><strong>Contact:</strong> {{ $company->contact }}</div>
                                    <div><strong>Contact Phone:</strong> {{ $company->contact_phone }}</div>
                                    <div><strong>Phone:</strong> {{ $company->phone }}</div>
                                    <div><strong>Fax:</strong> {{ $company->fax }}</div>
                                    <div><strong>Web Site:</strong> {{ $company->website }}</div>
                                    <div><strong>Fax Domain:</strong> {{ $company->fax_domain }}</div>
                                    <div><strong>Domain:</strong> {{ $company->domain }}</div>
                                    <div><strong>Time Zone:</strong> {{ $company->time_zone }}</div>
                                    <div><strong>External Account:</strong> {{ $company->external_account }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                                    <p>{{ $company->notes }}.</p>
                                </div>
                            </div>
                        </div>

                        <!-- /.company info -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="company-clients">
                        <!-- company clients -->

                        <!-- box -->
                        <div class="box-body">
                            <div id="company_clients_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="company_clients" class="table table-bordered table-striped hover dataTable" role="grid"
                                               aria-describedby="company_clients_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-sort="ascending" aria-label="Type: activate to sort column descending"
                                                    style="width: 80px;">Type
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending" style="width: 195px;">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-label="Active: activate to sort column ascending" style="width: 30px;">Active
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="company_clients" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="width: 50px;">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {{--@foreach($company_clients as $company)--}}
                                                {{--<tr role="row" class="odd"  data-href="{{URL::to('/admin/company/' . $company->id)}}">--}}
                                                    {{--<td class="sorting_1">{{ $company->type }}</td>--}}
                                                    {{--<td>{{ $company->name }}</td>--}}
                                                    {{--<td>{{ $company->notes }}</td>--}}
                                                    {{--<td>{{ $company->active }}</td>--}}
                                                    {{--<td>--}}
                                                        {{--{{ link_to_action('Admin\CompanyController@show', $title = 'Show',--}}
                                                            {{--$parameters = array($company->id),--}}
                                                            {{--$attributes = array('class' => 'btn btn-xs btn-success')) }}--}}
                                                        {{--{{ link_to_action('Admin\CompanyController@edit', $title = 'Edit',--}}
                                                            {{--$parameters = array($company->id),--}}
                                                            {{--$attributes = array('class' => 'btn btn-xs btn-info')) }}--}}
                                                        {{--delete</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">Type</th>
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

                        <!-- /.company clients -->
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
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