<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Dashboards</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('front-office-dashboard')}}">Front Office</a></li>
        <li><a href="{{route('accounts-dashboard')}}">Accounts</a></li>
    </ul>s
</li>


<li class="heading">APPROVALS</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Stock Requisition</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('stock-requisition.approved')}}">Approved</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Item Price Request</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('item-price-approval.approved')}}">Approved</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Menu Price Request</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('menu-price-approval.approved')}}">Approved</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Client Wallet Req</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
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
    <a href="javascript:;"><i class="sidebar-item-icon ti-target"></i>
        <span class="nav-label">Stock Backlog Request</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('stock-backlog.approve-view')}}">Incoming</a></li>
        <li><a href="{{route('stock-backlog.approved')}}">Approved</a></li>
        <li><a href="{{route('stock-backlog.rejected')}}">Rejected</a></li>
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

<li class="heading">REPORTS</li>


<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Sales</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
{{--        <li><a href="{{route('bills.index')}}">Bills</a></li>--}}
        <li><a href="{{route('daily-stock-index')}}">Daily Stock Sheet</a></li>
        <li><a href="{{route('sales-history')}}">Sales History</a></li>
        <li><a href="{{route('payment-history')}}">Payment History</a></li>
    </ul>
</li>
