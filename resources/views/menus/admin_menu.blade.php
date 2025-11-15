<li>
    <a href="mailbox.html"><i class="sidebar-item-icon ti-dashboard"></i>
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
    <a href="javascript:;"><i class="sidebar-item-icon ti-target"></i>
        <span class="nav-label">Conference</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('conference-rooms.index')}}">Conference Rooms</a></li>
        <li><a href="{{route('clients.index')}}">Clients</a></li>
    </ul>
</li>


<li>
    <a href="{{route('staffs.index')}}"><i class="sidebar-item-icon ti-user"></i>
        <span class="nav-label">Staffs</span>
    </a>
</li>


<li>
    <a href="{{route('logs.index')}}"><i class="sidebar-item-icon ti-view-list-alt"></i>
        <span class="nav-label">Logs</span>
    </a>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Inventory</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('stores.index')}}">Stores</a></li>
        <li><a href="{{route('stock-items.index')}}">Stock Items</a></li>
        <li><a href="{{route('suppliers.index')}}">Suppliers</a></li>
        <li><a href="{{route('unit-conversion.index')}}">Item Unit Conversion</a></li>
        <li><a href="{{route('item-stock-in.index')}}">Item Stock In</a></li>
        <li><a href="{{route('stock-requisition.index')}}">Stock Requisition</a></li>
        <li><a href="{{route('stock-issue.requests')}}">Stock Issue</a></li>
        <li><a href="{{route('stock-issue.index')}}">Stock Receive</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
        <span class="nav-label">Approvals</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('stock-requisition.approve-view')}}">Stock Requisition</a></li>
    </ul>
</li>


<li class="heading">SETUPS</li>
<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-user"></i>
        <span class="nav-label">User Management</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('users.index')}}">Users</a></li>
        <li><a href="{{route('roles.index')}}">Roles</a></li>
    </ul>
</li>
<li>
    <a href="javascript:;"><i class="sidebar-item-icon ti-settings"></i>
        <span class="nav-label">General</span><i class="fa fa-angle-left arrow"></i></a>
    <ul class="nav-2-level collapse">
        <li><a href="{{route('identity-types.index')}}">Identity Types</a></li>
        <li><a href="{{route('departments.index')}}">Departments</a></li>
        <li><a href="{{route('staff-roles.index')}}">Staff Roles</a></li>
        <li><a href="{{route('units.index')}}">Units</a></li>
        <li><a href="{{route('item-categories.index')}}">Item Categories</a></li>
        <li><a href="{{route('institutions.index')}}">Institution</a></li>
        <li><a href="{{route('food-menu.index')}}">Food Menus</a></li>
        <li><a href="{{route('payment-methods.index')}}">Payment Methods</a></li>
    </ul>
</li>


