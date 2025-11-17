<li>
    <a href="{{route('dashboard')}}"><i class="sidebar-item-icon ti-dashboard"></i>
        <span class="nav-label">Dashboard</span>
    </a>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-home"></i>
        <span class="nav-label">Room Management</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('room-types.index')}}">Room Types</a></li>
        <li><a href="{{route('rooms.index')}}">Rooms</a></li>
        <li><a href="{{route('house-kp-logs.index')}}">House Keeping</a></li>
        <li><a href="{{route('client-wallet.index')}}">Client Wallet</a></li>
        <li><a href="{{route('bookings.index')}}">Bookings</a></li>
        <li><a href="{{route('room-checkinout')}}">Check In/Out</a></li>
    </ul>
</li>

<li>
    <a href="{{route('clients.index')}}"><i class="sidebar-item-icon ti-dashboard"></i>
        <span class="nav-label">Guests/Clients</span>
    </a>
</li>


<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-target"></i>
        <span class="nav-label">Conference</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('conference-rooms.index')}}">Conference Rooms</a></li>
        <li><a href="{{route('conference-bookings.index')}}">Conference Bookings</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Inventory</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('item-stock-in.index')}}">Item Stock In</a></li>
        <li><a href="{{route('stock-requisition.index')}}">Stock Requisition</a></li>
        <li><a href="{{route('stock-balance')}}">Stock Balance</a></li>
        <li><a href="{{route('stock-issue.index')}}">Stock Receive</a></li>
    </ul>
</li>



