<li>
    <a href="{{route('dashboard')}}"><i class="sidebar-item-icon ti-dashboard"></i>
        <span class="nav-label">Dashboard</span>
    </a>
</li>


<li class="heading">APPROVALS</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Stock Requisition</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('stock-requisition.approve-view')}}">Incoming</a></li>
        <li><a href="{{route('stock-requisition.approved')}}">Approved</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Item Price Request</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('item-price-approval.approve-view')}}">Incoming</a></li>
        <li><a href="{{route('item-price-approval.approved')}}">Approved</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Menu Price Request</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('menu-price-approval.approve-view')}}">Incoming</a></li>
        <li><a href="{{route('menu-price-approval.approved')}}">Approved</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Client Wallet Req</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('client-wallet.approver-view')}}">Incoming</a></li>
        <li><a href="{{route('client-wallet.approved')}}">Approved</a></li>
    </ul>
</li>

