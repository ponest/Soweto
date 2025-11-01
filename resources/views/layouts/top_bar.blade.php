<header class="header">
    <div class="page-brand">
        <a href="{{route('dashboard')}}">
            @if (app()->environment('production'))
                <span class="brand">SOWETO</span>
            @else
                <span class="brand">MY APP</span>
            @endif
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
                @if (app()->environment('production'))
                    <span>SOWETO VILLAGE HOTEL</span>
                @else
                    <span class="brand">MY APP</span>
                @endif
            </li>
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->

        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">

            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <span>{{auth()->user()->full_name}}</span>
                    <img src="{{asset('assets/img/users/admin-image.png')}}" alt="image"/>
                </a>
                <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu">
                    <div class="dropdown-arrow"></div>
                    <div class="dropdown-header">
                        <div class="admin-avatar">
                            <img src="{{asset('assets/img/users/admin-image.png')}}" alt="image"/>
                        </div>
                        <div>
                            <h5 class="font-strong text-white">Welcome!</h5>
                            <div>
                                <span class="admin-badge text-white"><i class="ti-user"></i> {{auth()->user()->full_name}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="admin-menu-features">
                        <a class="admin-features-item" href="javascript:;"><i class="ti-user"></i>
                            <span>PROFILE</span>
                        </a>
                        <a class="admin-features-item" href="{{route('logout')}}"><i class="ti-shift-left"></i>
                            <span>LOGOUT</span>
                        </a>
                    </div>

                </div>
            </li>

        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
