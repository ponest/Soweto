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

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Purchase Request</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('purchase-request.approve-view')}}">Incoming</a></li>
        <li><a href="{{route('purchase-request.approved')}}">Approved</a></li>
        <li><a href="{{route('purchase-request.rejected')}}">Rejected</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-target"></i>
        <span class="nav-label">Discount Request</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('discount-req.approve-view')}}">Incoming</a></li>
        <li><a href="{{route('discount-req.approved')}}">Approved</a></li>
        <li><a href="{{route('discount-req.rejected')}}">Rejected</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-target"></i>
        <span class="nav-label">Checkout Request</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('checkout-req.approve-view')}}">Incoming</a></li>
        <li><a href="{{route('checkout-req.approved')}}">Approved</a></li>
        <li><a href="{{route('checkout-req.rejected')}}">Rejected</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Disposal Request</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('disposal-request.approve-view')}}">Incoming</a></li>
        <li><a href="{{route('disposal-request.approved')}}">Approved</a></li>
        <li><a href="{{route('disposal-request.rejected')}}">Rejected</a></li>
    </ul>
</li>
