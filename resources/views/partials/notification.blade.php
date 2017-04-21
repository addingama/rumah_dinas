@if (Session::has('success'))
    <div id="alertbottomright" class="myadmin-alert alert-info myadmin-alert-bottom-right">
        <a href="#" class="closed">&times;</a>
        <h4>Error!</h4> {{ Session::get('success') }}.
    </div>
@endif

@if (Session::has('error'))
    <div id="alertbottomright" class="myadmin-alert alert-danger myadmin-alert-bottom-right">
        <a href="#" class="closed">&times;</a>
        <h4>Error!</h4> {{ Session::get('error') }}.
    </div>
@endif


@if (Session::has('success') || Session::has('error'))
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

        $('#alertbottomright').fadeToggle(350);
    </script>
@endif