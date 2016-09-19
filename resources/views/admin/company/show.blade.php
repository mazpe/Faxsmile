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
                    <img class="profile-user-img img-responsive img-circle" src="/public/assets/images/admin/user4-128x128.jpg" alt="User profile picture">

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

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                    <p>{{ $company->notes }}.</p>
                </div>
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
                                    <dl class="row">
                                        @if ($company->name)
                                            <dt class="col-sm-3">Name:</dt>
                                            <dd class="col-sm-9">{{ $company->name }}</dd>
                                        @endif
                                        @if ($company->type)
                                            <dt class="col-sm-3">Type:</dt>
                                            <dd class="col-sm-9">{{ $company->type }}</dd>
                                        @endif
                                        @if ($company->address_1)
                                            <dt class="col-sm-3">Address 1:</dt>
                                            <dd class="col-sm-9">{{ $company->address_1 }}</dd>
                                        @endif
                                        @if ($company->address_2)
                                            <dt class="col-sm-3">Address 2:</dt>
                                            <dd class="col-sm-9">{{ $company->address_2 }}</dd>
                                        @endif
                                        @if ($company->city)
                                            <dt class="col-sm-3">City:</dt>
                                            <dd class="col-sm-9">{{ $company->city }}</dd>
                                        @endif
                                        @if ($company->state)
                                            <dt class="col-sm-3">State:</dt>
                                            <dd class="col-sm-9">{{ $company->state }}</dd>
                                        @endif
                                        @if ($company->zip)
                                            <dt class="col-sm-3">Zip:</dt>
                                            <dd class="col-sm-9">{{ $company->zip }}</dd>
                                        @endif
                                    </dl>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box">
                                    <dl class="row">
                                        @if ($company->phone)
                                            <dt class="col-sm-4">Phone:</dt>
                                            <dd class="col-sm-8">{{ $company->phone }}</dd>
                                        @endif
                                        @if ($company->fax)
                                            <dt class="col-sm-4">Fax:</dt>
                                            <dd class="col-sm-8">{{ $company->fax }}</dd>
                                        @endif
                                        @if ($company->website)
                                            <dt class="col-sm-4">Web Site:</dt>
                                            <dd class="col-sm-8">{{ $company->website }}</dd>
                                        @endif
                                        @if ($company->fax_domain)
                                            <dt class="col-sm-4">Fax Domain:</dt>
                                            <dd class="col-sm-8">{{ $company->fax_domain }}</dd>
                                        @endif
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- /.company info -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="company-clients">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs">Read more</a>
                                        <a class="btn btn-danger btn-xs">Delete</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-user bg-aqua"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                    </h3>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-comments bg-yellow"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                    <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-camera bg-purple"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                    <div class="timeline-body">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
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