<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li class="user-pro">
                <a href="{{ url('profile') }}" class="waves-effect">
                    <img src="/plugins/images/users/d1.jpg" alt="user-img" class="img-circle">
                    <span class="hide-menu">{{ ucwords(Auth::user()->name) }}</span>
                </a>
            </li>
            <li class="nav-small-cap m-t-10">--- Main Menu</li>
            <li class="{{ active_class(if_uri_pattern(['dashboard*']), 'active', '') }}">
                <a href="{{ url('dashboard') }}" class="waves-effect">
                    <i class="fa-dashcube fa"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="{{ active_class(if_uri_pattern(['rumah*']), 'active', '') }}">
                <a href="javascript:void(0)" class="waves-effect">
                    <i class="ti-files fa-fw"></i>
                    <span class="hide-menu">Master Data<span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li class="{{ active_class(if_uri_pattern(['rumah*']), 'active', '') }}">
                        <a href="{{ url('pegawai') }}">Pegawai</a>
                    </li>
                    <li class="{{ active_class(if_uri_pattern(['rumah*']), 'active', '') }}">
                        <a href="{{ url('pangkat') }}">Pangkat</a>
                    </li>
                    <li class="{{ active_class(if_uri_pattern(['rumah*', 'pegawai*', 'tipe_rumah*', 'pangkat*']), 'active', '') }}">
                        <a href="{{ url('rumah') }}">Rumah</a>
                    </li>
                    <li class="{{ active_class(if_uri_pattern(['rumah*']), 'active', '') }}">
                        <a href="{{ url('tipe_rumah') }}">Tipe Rumah</a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->