<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/assets/images/admin/user2-160x160.jpg") }}" class="img-circle" alt="User Image">

            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li @if ($page_title == "Companies") class="active" @endif><a href="{{ url('/admin/company') }}"><i class="fa fa-building-o"></i> <span>Companies</span></a></li>
            <li @if ($page_title == "Providers") class="active" @endif><a href="{{ url('/admin/provider') }}"><i class="fa fa-group"></i> <span>Providers</span></a></li>
            <li @if ($page_title == "Clients") class="active" @endif><a href="{{ url('/admin/client') }}"><i class="fa fa-building"></i> <span>Clients</span></a></li>
            <li @if ($page_title == "Faxes") class="active" @endif><a href="{{ url('/admin/fax') }}"><i class="fa fa-fax"></i> <span>Faxes</span></a></li>
            <li @if ($page_title == "Users") class="active" @endif><a href="{{ url('/admin/user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
