@if (Session::has('success'))
    <div id="alertbottomright" class="myadmin-alert alert-success myadmin-alert-top-right">
        <a href="#" class="closed">&times;</a>
        <h4>Success!</h4> {{ Session::get('success') }}.
    </div>
@endif

@if (Session::has('error'))
    <div id="alertbottomright" class="myadmin-alert alert-danger myadmin-alert-top-right">
        <a href="#" class="closed">&times;</a>
        <h4>Error!</h4> {{ Session::get('error') }}.
    </div>
@endif

@if (Session::has('info'))
    <div id="alertbottomright" class="myadmin-alert alert-info myadmin-alert-top-right">
        <a href="#" class="closed">&times;</a>
        <h4>Info!</h4> {{ Session::get('info') }}.
    </div>
@endif


@if (Session::has('success') || Session::has('error') || Session::has('info'))
    <script>
        //Alerts
        $(".myadmin-alert .closed").click(function (event) {
            $(this).parents(".myadmin-alert").fadeToggle(350);
            return false;
        });
        /* Click to close */
        $(".myadmin-alert-click").click(function (event) {
            $(this).fadeToggle(350);
            return false;
        });

        $('#alertbottomright').fadeToggle(350).fadeToggle(5000);
    </script>
@endif