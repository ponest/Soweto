<li>
    <a href="mailbox.html"><i class="sidebar-item-icon ti-dashboard"></i>
        <span class="nav-label">Dashboard</span>
    </a>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Inventory</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('stock-items.index')}}">Stock Items</a></li>
        <li><a href="{{route('suppliers.index')}}">Suppliers</a></li>
        <li><a href="{{route('unit-conversion.index')}}">Item Unit Conversion</a></li>
        <li><a href="{{route('stock-balance')}}">Stock Balance</a></li>
        <li><a href="{{route('item-stock-in.index')}}">Item Stock In</a></li>
        <li><a href="{{route('stock-requisition.index')}}">Stock Requisition</a></li>
        <li><a href="{{route('stock-issue.requests')}}">Stock Issue</a></li>
        <li><a href="{{route('stock-issue.index')}}">Stock Receive</a></li>
    </ul>
</li>

{{--<li>--}}
{{--    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>--}}
{{--        <span class="nav-label">Approvals</span><i class="fa fa-angle-left arrow"></i></a>--}}
{{--    <ul class="nav-2-level collapse">--}}
{{--        <li><a href="{{route('stock-requisition.approve-view')}}">Stock Requisition</a></li>--}}
{{--    </ul>--}}
{{--</li>--}}

