<li>
    <a href="{{route('dashboard')}}"><i class="sidebar-item-icon ti-dashboard"></i>
        <span class="nav-label">Dashboard</span>
    </a>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Inventory</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('item-stock-in.index')}}">Item Stock In</a></li>
        <li><a href="{{route('stock-balance')}}">Stock Balance</a></li>
        <li><a href="{{route('stock-requisition.index')}}">Stock Requisition</a></li>
        <li><a href="{{route('stock-issue.index')}}">Stock Receive</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-target"></i>
        <span class="nav-label">Bills</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('bills.index')}}">Unpaid Bills</a></li>
        <li><a href="{{route('bills.paid')}}">Paid Bills</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Sales</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('sales.index','kitchen')}}">Sale Point</a></li>
{{--        <li><a href="{{route('bills.index')}}">Bills</a></li>--}}
        <li><a href="{{route('sales-history')}}">Sales History</a></li>
        <li><a href="{{route('menu-price.index')}}">Menu Price</a></li>
        <li><a href="{{route('menu-price-approval.index')}}">Menu Price Request</a></li>
    </ul>
</li>
