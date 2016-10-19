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
            @can('index', \App\Provider::class)
                <li @if ($page_title == "Providers") class="active" @endif><a href="{{ url('/admin/provider') }}"><i class="fa fa-group"></i> <span>Providers</span></a></li>
            @endcan

            @can('index', \App\Company::class)
                <li @if ($page_title == "Companies") class="active" @endif><a href="{{ url('/admin/company') }}"><i class="fa fa-building-o"></i> <span>Companies</span></a></li>
            @endcan
            @if( (isset($company)) && (Auth::user()->isCompanyAdmin() && Auth::user()->can('view', $company)))
                <li @if ($page_title == "Companies") class="active" @endif><a href="{{ url('/admin/company/' . $company->id) }}"><i class="fa fa-building"></i> <span>Company</span></a></li>
            @endif

            @can('index', \App\Client::class)
                <li @if ($page_title == "Clients") class="active" @endif><a href="{{ url('/admin/client') }}"><i class="fa fa-building"></i> <span>Clients</span></a></li>
            @endcan
            @if( (isset($client)) && (Auth::user()->isClientAdmin() && Auth::user()->can('view', $client)))
                <li @if ($page_title == "Clients") class="active" @endif><a href="{{ url('/admin/client/' . $client->id) }}"><i class="fa fa-building"></i> <span>Client</span></a></li>
            @endif

            @can('index', \App\Fax::class)
                <li @if ($page_title == "Faxes") class="active" @endif><a href="{{ url('/admin/fax') }}"><i class="fa fa-fax"></i> <span>Faxes</span></a></li>
            @endcan

            @can('index', \App\User::class)
                <li @if ($page_title == "Users") class="active" @endif><a href="{{ url('/admin/user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
            @endcan
            @if( isset($user) && (Auth::user()->isUser() && Auth::user()->can('view', $user)) )
                <li @if ($page_title == "Users  ") class="active" @endif><a href="{{ url('/admin/user/' . $user->id) }}"><i class="fa fa-building"></i> <span>User</span></a></li>
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
