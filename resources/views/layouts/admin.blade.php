<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">

    @include('partials.head')

    <body class="fix-sidebar">
        @include('partials.preloader')

        <div id="wrapper">
            <!-- Top Navigation -->
            @include('partials.top_navbar')
            <!-- End Top Navigation -->
            <!-- Left navbar-header -->
            @include('partials.left_navbar')
            <!-- Left navbar-header end -->
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    @yield('content')
                    <!-- .right-sidebar -->
                    {{--@include('partials.right_navbar')--}}
                    <!-- /.right-sidebar -->
                </div>
                <!-- /.container-fluid -->
                @include('partials.footer')
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        @include('partials.scripts')
        @include('partials.notification')
    </body>

</html>