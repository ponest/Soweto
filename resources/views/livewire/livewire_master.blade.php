<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Adminca bootstrap 4 &amp; angular 5 admin template, Шаблон админки | Dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/line-awesome/css/line-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/themify-icons/css/themify-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/toastr/toastr.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{asset('assets/vendors/dataTables/datatables.min.css')}}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{asset('assets/css/main.min.css')}}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    {{-- Livewire Styles --}}
    @livewireStyles
</head>

<body class="fixed-navbar">
<div class="page-wrapper">
    <!-- START HEADER-->
    <header class="header">
        <div class="page-brand">
            <a href="index.html">
                <span class="brand">AdminCa</span>
                <span class="brand-mini">AC</span>
            </a>
        </div>
        <div class="flexbox flex-1">
            <!-- START TOP-LEFT TOOLBAR-->
            <ul class="nav navbar-toolbar">
                <li>
                    <a class="nav-link sidebar-toggler js-sidebar-toggler" href="javascript:;">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                </li>
                <li>
                    <a class="nav-link search-toggler js-search-toggler"><i class="ti-search"></i>
                        <span>Search here...</span>
                    </a>
                </li>
            </ul>
            <!-- END TOP-LEFT TOOLBAR-->
            <!-- START TOP-RIGHT TOOLBAR-->
            <ul class="nav navbar-toolbar">

                <li class="dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                        <span>Super User</span>
                        <img src="./assets/img/users/admin-image.png" alt="image" />
                    </a>
                    <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu">
                        <div class="dropdown-arrow"></div>
                        <div class="dropdown-header">
                            <div class="admin-avatar">
                                <img src="./assets/img/users/admin-image.png" alt="image" />
                            </div>
                            <div>
                                <h5 class="font-strong text-white">Super User</h5>
                                <div>
                                    <span class="admin-badge mr-3"><i class="ti-alarm-clock mr-2"></i>30m.</span>
                                    <span class="admin-badge"><i class="ti-lock mr-2"></i>Safe Mode</span>
                                </div>
                            </div>
                        </div>
                        <div class="admin-menu-features">
                            <a class="admin-features-item" href="javascript:;"><i class="ti-user"></i>
                                <span>PROFILE</span>
                            </a>
                            <a class="admin-features-item" href="javascript:;"><i class="ti-support"></i>
                                <span>SUPPORT</span>
                            </a>
                            <a class="admin-features-item" href="javascript:;"><i class="ti-settings"></i>
                                <span>SETTINGS</span>
                            </a>
                        </div>
                        <div class="admin-menu-content">
                            <div class="text-muted mb-2">Your Wallet</div>
                            <div><i class="ti-wallet h1 mr-3 text-light"></i>
                                <span class="h1 text-success"><sup>$</sup>12.7k</span>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <a class="text-muted" href="javascript:;">Earnings history</a>
                                <a class="d-flex align-items-center" href="javascript:;">Logout<i class="ti-shift-right ml-2 font-20"></i></a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
            <!-- END TOP-RIGHT TOOLBAR-->
        </div>
    </header>
    <!-- END HEADER-->
    <!-- START SIDEBAR-->
    <nav class="page-sidebar" id="sidebar">
        <div id="sidebar-collapse">
            <ul class="side-menu metismenu">
                <li>
                    <a href="mailbox.html"><i class="sidebar-item-icon ti-home"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>
                <li class="heading">FEATURES</li>
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon ti-paint-roller"></i>
                        <span class="nav-label">User Management</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li><a href="{{route('users.index')}}">Users</a></li>
                        <li>
                            <a href="typography.html">Typography</a>
                        </li>
                        <li>
                            <a href="panels.html">Panels</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="javascript:;"><i class="ti-announcement"></i></a>
                <a href="calendar.html"><i class="ti-calendar"></i></a>
                <a href="javascript:;"><i class="ti-comments"></i></a>
                <a href="login.html"><i class="ti-power-off"></i></a>
            </div>
        </div>
    </nav>
    <!-- END SIDEBAR-->
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            {{ $slot }}
        </div>
        <!-- END PAGE CONTENT-->
        <footer class="page-footer">
            <div class="font-13">2018 © <b>Adminca</b> - Save your time, choose the best</div>
            <div>
                <a class="px-3 pl-4" href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589" target="_blank">Purchase</a>
                <a class="px-3" href="http://admincast.com/adminca/documentation.html" target="_blank">Docs</a>
            </div>
            <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
        </footer>
    </div>
</div>
<!-- START SEARCH PANEL-->
<form class="search-top-bar" action="search.html">
    <input class="form-control search-input" type="text" placeholder="Search...">
    <button class="reset input-search-icon"><i class="ti-search"></i></button>
    <button class="reset input-search-close" type="button"><i class="ti-close"></i></button>
</form>
<!-- END SEARCH PANEL-->
<!-- BEGIN THEME CONFIG PANEL-->
<div class="theme-config">
    <div class="theme-config-toggle"><i class="ti-settings theme-config-show"></i><i class="ti-close theme-config-close"></i></div>
    <div class="theme-config-box">
        <h5 class="text-center mb-4 mt-3">SETTINGS</h5>
        <div class="font-strong mb-3">LAYOUT OPTIONS</div>
        <div class="check-list mb-4">
            <label class="checkbox checkbox-grey checkbox-primary">
                <input id="_fixedNavbar" type="checkbox" checked>
                <span class="input-span"></span>Fixed navbar</label>
            <label class="checkbox checkbox-grey checkbox-primary mt-3">
                <input id="_fixedlayout" type="checkbox">
                <span class="input-span"></span>Fixed layout</label>
            <label class="checkbox checkbox-grey checkbox-primary mt-3">
                <input class="js-sidebar-toggler" type="checkbox">
                <span class="input-span"></span>Collapse sidebar</label>
            <label class="checkbox checkbox-grey checkbox-primary mt-3">
                <input id="_drawerSidebar" type="checkbox">
                <span class="input-span"></span>Drawer sidebar</label>
        </div>
        <div class="font-strong mb-3">LAYOUT STYLE</div>
        <div class="check-list mb-4">
            <label class="radio radio-grey radio-primary">
                <input type="radio" name="layout-style" value="" checked="">
                <span class="input-span"></span>Fluid</label>
            <label class="radio radio-grey radio-primary mt-3">
                <input type="radio" name="layout-style" value="1">
                <span class="input-span"></span>Boxed</label>
        </div>
    </div>
</div>
<!-- END THEME CONFIG PANEL-->
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- New question dialog-->
<div class="modal fade" id="session-dialog">
    <div class="modal-dialog" style="width:400px;" role="document">
        <div class="modal-content timeout-modal">
            <div class="modal-body">
                <button class="close" data-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mt-3 mb-4"><i class="ti-lock timeout-icon"></i></div>
                <div class="text-center h4 mb-3">Set Auto Logout</div>
                <p class="text-center mb-4">You are about to be signed out due to inactivity.<br>Select after how many minutes of inactivity you log out of the system.</p>
                <div id="timeout-reset-box" style="display:none;">
                    <div class="form-group text-center">
                        <button class="btn btn-danger btn-fix btn-air" id="timeout-reset">Deactivate</button>
                    </div>
                </div>
                <div id="timeout-activate-box">
                    <form id="timeout-form" action="javascript:;">
                        <div class="form-group pl-3 pr-3 mb-4">
                            <input class="form-control form-control-line" type="text" name="timeout_count" placeholder="Minutes" id="timeout-count">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-fix btn-air" id="timeout-activate">Activate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End New question dialog-->

<!-- CORE PLUGINS-->
<script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vendors/metisMenu/dist/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-idletimer/dist/idle-timer.min.js')}}"></script>
<script src="{{asset('assets/vendors/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="{{asset('assets/vendors/dataTables/datatables.min.js')}}"></script>
<!-- CORE SCRIPTS-->
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="{{asset('assets/js/scripts/toastr-demo.js')}}"></script>

{{-- Livewire Scripts --}}

{{--@if(View::hasSection('datatable'))--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            var table = $('#datatable').DataTable({--}}
{{--                pageLength: 10, // Default to 10 rows per page--}}
{{--                fixedHeader: true,--}}
{{--                responsive: true,--}}
{{--                "sDom": 'rtip',--}}
{{--                columnDefs: [{--}}
{{--                    targets: 'no-sort',--}}
{{--                    orderable: false--}}
{{--                }]--}}
{{--            });--}}

{{--            // Listen for keyup events on the search box--}}
{{--            $('#key-search').on('keyup', function() {--}}
{{--                table.search(this.value).draw();--}}
{{--            });--}}

{{--            // Listen for change event on the type-filter--}}
{{--            $('#type-filter').on('change', function() {--}}
{{--                table.column(4).search($(this).val()).draw();--}}
{{--            });--}}

{{--            // Listen for change event on rows-per-page filter--}}
{{--            $('#rows-per-page').on('change', function() {--}}
{{--                var pageLength = $(this).val();--}}
{{--                table.page.len(pageLength).draw();--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endif--}}

@if(View::hasSection('datatable'))
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#datatable').DataTable({
                pageLength: 10, // Default to 10 rows per page
                fixedHeader: true,
                responsive: true,
                "sDom": 'rtip',
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }]
            });

            // Listen for keyup events on the search box
            $('#key-search').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Listen for change event on the type-filter
            $('#type-filter').on('change', function() {
                table.column(4).search($(this).val()).draw();
            });

            // Listen for change event on rows-per-page filter
            $('#rows-per-page').on('change', function() {
                var pageLength = $(this).val();
                table.page.len(pageLength).draw();
            });

            // Listen for reinitialization event from Livewire
            Livewire.on('reinitialize-datatable', () => {
                // Destroy and reinitialize the DataTable
                table.destroy();
                table = $('#datatable').DataTable({
                    pageLength: 10,
                    fixedHeader: true,
                    responsive: true,
                    "sDom": 'rtip',
                    columnDefs: [{
                        targets: 'no-sort',
                        orderable: false
                    }]
                });
            });
        });
    </script>
@endif



<script>
    window.addEventListener('show-toast', event => {
        // Optional: Hide a modal if specified
        const modalId = event.detail[0]?.modalId;
        if (modalId) {
            $(`#${modalId}`).modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            $(`#${modalId} form`)[0].reset();
        }

        // Show toastr message
        if (event.detail[0]?.type && event.detail[0]?.message) {
            toastr[event.detail[0].type](event.detail[0].message, event.detail[0].title ?? 'Success');
        }

        // Default Toastr settings
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };
    });
</script>

@livewireScripts
@stack('scripts')
</body>

</html>
