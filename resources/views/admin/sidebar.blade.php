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
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li @if ($page_title == "Companies") class="active" @endif><a href="/admin/company"><i class="fa fa-link"></i> <span>Companies</span></a></li>
            <li @if ($page_title == "Clients") class="active" @endif><a href="/admin/client"><i class="fa fa-link"></i> <span>Clients</span></a></li>
            <li @if ($page_title == "Faxes") class="active" @endif><a href="/admin/fax"><i class="fa fa-link"></i> <span>Faxes</span></a></li>
            <li @if ($page_title == "Users") class="active" @endif><a href="/admin/user"><i class="fa fa-link"></i> <span>Users</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
