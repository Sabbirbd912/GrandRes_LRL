<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <!-- Dashboard -->
            <li>
                <a class="has-arrow ai-icon" href="dashboard" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false" id="dashboard">
                    <li><a href="{{ url('/') }}">Status-Board</a></li>
                    <li><a href="{{ url('reviews') }}">Review</a></li>
                </ul>
            </li>

            <!-- Menu Items -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Menu Items</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('products/create')}}">Add Menu</a></li>
                    <li><a href="{{ url('products') }}">Manage Menu</a></li>
                </ul>
            </li>

            <!-- Orders Management -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-controls-3"></i>
                    <span class="nav-text">Orders Management</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('orders/create') }}">Create Order</a></li>
                    <li><a href="{{ url('orders') }}">Manage Order</a></li>
                </ul>
            </li>

            <!-- Reservations -->
            <li>
                <a class="has-arrow ai-icon" href="Reservations" aria-expanded="false">
                    <i class="flaticon-381-internet"></i>
                    <span class="nav-text">Reservations</span>
                </a>
                <ul aria-expanded="false" id="reservations">
                    <li><a href="{{ url('reservations/create') }}">Add Reservation</a></li>
                    <li><a href="{{ url('reservations') }}">Manage Reserveation</a></li>
                </ul>
            </li>

            <!-- Table -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-network"></i>
                    <span class="nav-text">Tables</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('tables/create')}}">Create Table</a></li>
                    <li><a href="{{ url('tables') }}">Manage Table</a></li>
                </ul>
            </li>

            <!-- Payments  --- <i class="flaticon-381-heart"> -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="fas fa-money-bill-wave"></i>
                    <span class="nav-text">Payments</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('money-receipts/create') }}">Create Money Receipt</a></li>
                    <li><a href="{{ url('uc/nestable') }}">Payments Method</a></li>
                    <li><a href="{{ url('money-receipts') }}">All Money Receipt</a></li>
                </ul>
            </li>

            <!-- Customers -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="fas fa-users"></i></i>
                    <span class="nav-text">Customers</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('customers/create') }}">Create Customer</a></li>
                    <li><a href="{{ url('customers') }}">Manage Customers</a></li>
                </ul>
            </li>

            <!-- ✅ Purchases -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-box"></i>
                    <span class="nav-text">Purchases</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('purchases/create') }}">Add Purchase</a></li>
                    <li><a href="{{ url('purchases') }}">Manage Purchases</a></li>
                    <!-- <li><a href="{{ url('purchases/history') }}">Purchase History</a></li> -->
                    <!-- <li><a href="{{ url('suppliers') }}">Supplier List</a></li> -->
                </ul>
            </li>

            <!-- ✅ Inventory / Stock -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-layer-1"></i>
                    <span class="nav-text">Inventory</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('inventory/current') }}">Current Stock</a></li>
                    <li><a href="{{ url('inventory/in') }}">Stock In</a></li>
                    <li><a href="{{ url('inventory/out') }}">Stock Out</a></li>
                    <li><a href="{{ url('inventory/adjustment') }}">Stock Adjustment</a></li>
                    <li><a href="{{ url('inventory/report') }}">Inventory Report</a></li>
                </ul>
            </li>

            <!-- ✅ Suppliers -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-user-7"></i>
                    <span class="nav-text">Suppliers</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('suppliers/create') }}">Add Supplier</a></li>
                    <li><a href="{{ url('suppliers') }}">Manage Suppliers</a></li>
                    <li><a href="{{ url('suppliers/payment') }}">Supplier Payment</a></li>
                    <li><a href="{{ url('suppliers/ledger') }}">Supplier Ledger</a></li>
                </ul>
            </li>

            <!-- ✅ Reports -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Reports</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('reports/sales') }}">Sales Report</a></li>
                    <li><a href="{{ url('reports/purchases') }}">Purchase Report</a></li>
                    <li><a href="{{ url('reports/inventory') }}">Inventory Report</a></li>
                    <li><a href="{{ url('reports/reservations') }}">Reservation Report</a></li>
                    <li><a href="{{ url('reports/customers') }}">Customer Report</a></li>
                    <li><a href="{{ url('reports/profit-loss') }}">Profit/Loss Report</a></li>
                </ul>
            </li>

            <!-- ✅ Kitchen / Production -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="fas fa-concierge-bell"></i>
                    <span class="nav-text">Kitchen</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('kitchen/preparation') }}">Food Preparation</a></li>
                    <li><a href="{{ url('kitchen/ingredients') }}">Ingredients Usage</a></li>
                    <li><a href="{{ url('kitchen/stock') }}">Kitchen Stock</a></li>
                </ul>
            </li>

            <!-- Users -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('auth/register') }}">Register</a></li>
                    <li><a href="{{ url('auth/login') }}">Admin Login</a></li>
                    <li><a href="{{ url('auth/lock') }}">User Login</a></li>
                    <li>
                        <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">Error</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('errors/400') }}">Error 400</a></li>
                            <li><a href="{{ url('errors/403') }}">Error 403</a></li>
                            <li><a href="{{ url('errors/404') }}">Error 404</a></li>
                            <li><a href="{{ url('errors/500') }}">Error 500</a></li>
                            <li><a href="{{ url('errors/503') }}">Error 503</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!-- Admin -->
            <li>
                <a href="{{ url('admin#') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-settings-2 "></i>
                    <span class="nav-text">Admin</span>
                </a>
            </li>

            <!-- Settings -->
            <li>
                <a href="{{ url('settings') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
        </ul>

        <div class="add-menu-sidebar">
            <img src="{{asset('assets/images/icon1.png') }}" alt="" />
            <p>Organize your menus through the button below</p>
            <a href="javascript:void(0);" class="btn btn-primary btn-block light">+ Add Menus</a>
        </div>

        <div class="copyright">
            <p><strong>Eatio - Restaurant Admin Dashboard</strong> © 2020 All Rights Reserved</p>
        </div>
    </div>
</div>
