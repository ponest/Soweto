<li>
    <a href="{{route('dashboard')}}"><i class="sidebar-item-icon ti-dashboard"></i>
        <span class="nav-label">Dashboard</span>
    </a>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Sales</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('bills.index')}}">Bills</a></li>
        <li><a href="{{route('sales-history')}}">Sales History</a></li>
        <li><a href="{{route('item-price.index')}}">Item Price</a></li>
        <li><a href="{{route('menu-price.index')}}">Menu Price</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Reviews</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('purchase-request.approve-view')}}">Purchase Request</a></li>
{{--        <li><a href="{{route('sales-history')}}">Sales History</a></li>--}}
{{--        <li><a href="{{route('item-price.index')}}">Item Price</a></li>--}}
{{--        <li><a href="{{route('menu-price.index')}}">Menu Price</a></li>--}}
    </ul>
</li>
