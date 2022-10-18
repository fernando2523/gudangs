<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-header">Navigation</div>
            <div class="menu-item {{ Request::is('dashboard/dashboards') ? 'active' : '' }}">
                <a href="/dashboard/dashboards" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cpu text-theme"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>

            <div class="menu-header">Data Master</div>
            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-person-rolodex text-theme"></i>
                    </span>
                    <span class="menu-text">Account</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::is('employee/employees') ? 'active' : '' }}">
                        <a href="/employee/employees" class="menu-link">
                            <span class="menu-text">Employee</span>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::is('supplier/suppliers') ? 'active' : '' }}">
                        <a href="/supplier/suppliers" class="menu-link">
                            <span class="menu-text">Supplier</span>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::is('reseller/resellers') ? 'active' : '' }}">
                        <a href="/reseller/resellers" class="menu-link">
                            <span class="menu-text">Reseller</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-shop text-theme"></i>
                    </span>
                    <span class="menu-text">Warehouse / Store</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::is('warehouse/warehouses') ? 'active' : '' }}">
                        <a href="/warehouse/warehouses" class="menu-link">
                            <span class="menu-text">Warehouse</span>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::is('store/stores') ? 'active' : '' }}">
                        <a href="/store/stores" class="menu-link">
                            <span class="menu-text">Store</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-clipboard2-data-fill text-theme"></i>
                    </span>
                    <span class="menu-text">Management Stock</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="email_compose.html" class="menu-link">
                            <span class="menu-text">Repeat Order</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="email_compose.html" class="menu-link">
                            <span class="menu-text">Data Purchase Order</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="email_inbox.html" class="menu-link">
                            <span class="menu-text">Product Exchange</span>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::is('brand/brands') ? 'active' : '' }}">
                        <a href="/brand/brands" class="menu-link">
                            <span class="menu-text">Brand</span>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::is('category/categories') ? 'active' : '' }}">
                        <a href="/category/categories" class="menu-link">
                            <span class="menu-text">Category</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-header">Products</div>
            <div class="menu-item {{ Request::is('product/products') ? 'active' : '' }}">
                <a href="/product/products" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-search text-theme"></i></span>
                    <span class="menu-text">Search Products</span>
                </a>
            </div>
            <div class="menu-item {{ Request::is('employee/employees') ? 'active' : '' }}">
                <a href="/employee/employees" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-upc-scan text-theme"></i></span>
                    <span class="menu-text">Barcode</span>
                </a>
            </div>

            <div class="menu-header">Sales</div>
            <div class="menu-item {{ Request::is('employee/employees') ? 'active' : '' }}">
                <a href="/employee/employees" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cart-check text-theme"></i></span>
                    <span class="menu-text">Sales</span>
                </a>
            </div>
            <div class="menu-item {{ Request::is('store_expense/store_expenses') ? 'active' : '' }}">
                <a href="/store_expense/store_expenses" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cash-coin text-theme"></i></span>
                    <span class="menu-text">Store Expenditure</span>
                </a>
            </div>

            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-inboxes-fill text-theme"></i>
                    </span>
                    <span class="menu-text">Orders</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="email_compose.html" class="menu-link">
                            <span class="menu-text">Store Retail</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="email_compose.html" class="menu-link">
                            <span class="menu-text">Reseller Paid</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="email_inbox.html" class="menu-link">
                            <span class="menu-text">Reseller Pending</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-clock-history text-theme"></i>
                    </span>
                    <span class="menu-text">Histories</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="email_compose.html" class="menu-link">
                            <span class="menu-text">Cancel</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="email_compose.html" class="menu-link">
                            <span class="menu-text">Return</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="email_inbox.html" class="menu-link">
                            <span class="menu-text">Refund</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-header">Report</div>
            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-graph-up-arrow text-theme"></i>
                    </span>
                    <span class="menu-text">Report</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="email_compose.html" class="menu-link">
                            <span class="menu-text">Cancel</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="email_compose.html" class="menu-link">
                            <span class="menu-text">Return</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="email_inbox.html" class="menu-link">
                            <span class="menu-text">Refund</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-divider"></div>
            <div class="menu-header">Settings</div>
            <div class="menu-item {{ Request::is('setting/setting') ? 'active' : '' }}">
                <a href="/setting/setting" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear text-theme"></i></span>
                    <span class="menu-text">Settings</span>
                </a>
            </div>
        </div>
    </div>
</div>
