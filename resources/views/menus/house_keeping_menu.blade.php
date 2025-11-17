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
