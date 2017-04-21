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
            <li>
                <a href="{{ url('dashboard') }}" class="waves-effect">
                    <i class="fa-dashcube fa"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="waves-effect">
                    <i class="ti-files fa-fw"></i>
                    <span class="hide-menu">Master Data<span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('houses') }}">Rumah</a></li>
                    <li><a href="javascript:void(0)">Lainnya</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->