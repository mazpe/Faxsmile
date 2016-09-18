@extends('admin.admin_template')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Create Company</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form-horizontal" method="post" action="{{ action('Admin\CompanyController@store') }}">
        <div class="box-body">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress1" class="col-sm-2 control-label">Address 1</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputAddress1" placeholder="Address 1">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress2" class="col-sm-2 control-label">Address 2</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Address 2">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCity" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCity" placeholder="City">
                </div>
            </div>
            <div class="form-group">
                <label for="inputState" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputState" placeholder="State">
                </div>
            </div>
            <div class="form-group">
                <label for="inputZipCode" class="col-sm-2 control-label">Zip Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputZipCode" placeholder="Zip Code">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPhone" placeholder="Phone">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFax" class="col-sm-2 control-label">Fax</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFax" placeholder="Fax">
                </div>
            </div>
            <div class="form-group">
                <label for="inputWebsite" class="col-sm-2 control-label">Web Site</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputWebsite" placeholder="Web Site">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFaxDomain" class="col-sm-2 control-label">Fax Domain</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFaxDomain" placeholder="Fax Domain">
                </div>
            </div>
            <div class="form-group">
                <label for="inputDomain" class="col-sm-2 control-label">Domain</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputDomain" placeholder="Domain">
                </div>
            </div>
            <div class="form-group">
                <label for="inputTimeZone" class="col-sm-2 control-label">Time Zone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTimeZone" placeholder="Time Zone">
                </div>
            </div>
            <div class="form-group">
                <label for="inputExternalAccount" class="col-sm-2 control-label">External Account</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputExternalAccount" placeholder="External Account">
                </div>
            </div>
            <div class="form-group">
                <label for="inputContact" class="col-sm-2 control-label">Contact</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputContact" placeholder="Contact">
                </div>
            </div>
            <div class="form-group">
                <label for="inputContactPhone" class="col-sm-2 control-label">Contact Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputContactPhone" placeholder="Contact Phone">
                </div>
            </div>
            <div class="form-group">
                <label for="inputNotes" class="col-sm-2 control-label">Notes</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNotes" placeholder="Notes">
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-default">Cancel</button>
            <button type="submit" class="btn btn-info pull-right">Create</button>
        </div>
        <!-- /.box-footer -->
    </form>
</div>
@endsection