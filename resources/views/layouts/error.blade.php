<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">
    <head>
        @include('partials.head')
        @stack('styles')
    </head>


    <body>
        @include('partials.preloader')

        @yield('content')

        @include('partials.scripts')
    </body>

</html>