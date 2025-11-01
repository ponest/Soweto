<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>@yield('title')</title>
    @include('layouts.header_links')
    @yield('styles')
</head>

<body class="fixed-navbar">
<div class="page-wrapper">
    <!-- START HEADER-->
    @include('layouts.top_bar')
    <!-- END HEADER-->

    <!-- START SIDEBAR-->
     @include('layouts.menu')
    <!-- END SIDEBAR-->

    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            @yield('content')
        </div>
        <!-- END PAGE CONTENT-->
        <footer class="page-footer">
            <div class="font-13">{{date('Y')}} © <b>Soweto Village Hotel</b></div>
            <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
        </footer>
    </div>

</div>

<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->

@include('layouts.footer_links')
</body>
</html>
