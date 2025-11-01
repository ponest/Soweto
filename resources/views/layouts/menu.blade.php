<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <ul class="side-menu metismenu">
            @can('Admin')
                @include('menus.admin_menu')
            @endcan
            @can('StoreOfficer')
                @include('menus.store_menu')
            @endcan
            @can('Bar')
                @include('menus.bar_menu')
            @endcan
            @can('Approver')
                @include('menus.approver_menu')
            @endcan
            @can('FrontOfficer')
                @include('menus.front_office_menu')
            @endcan
            @can('Kitchen')
                @include('menus.kitchen_menu')
            @endcan
        </ul>
        <div class="sidebar-footer">
            <a href="javascript:;"><i class="ti-announcement"></i></a>
            <a href="calendar.html"><i class="ti-calendar"></i></a>
            <a href="javascript:;"><i class="ti-comments"></i></a>
            <a href="{{route('logout')}}"><i class="ti-power-off"></i></a>
        </div>
    </div>
</nav>




