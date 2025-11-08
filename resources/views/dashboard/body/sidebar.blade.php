<div class="iq-sidebar sidebar-default">
    <!-- Logo -->
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="header-logo d-flex align-items-center">
            <img src="{{ asset('assets/images/logo-one.jpg') }}" class="img-fluid rounded-normal light-logo" alt="logo">
            <h5 class="logo-title light-logo ml-3">{{ __('sidebar.logo-title') }}</h5>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>

    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">

                <!-- Dashboard -->
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="svg-icon">
                        <i class="fa-solid fa-chart-line"></i>
                        <span class="ml-4">{{ __('sidebar.dashboard') }}</span>
                    </a>
                </li>

                <!-- POS -->
                @if(auth()->user()->can('pos.menu'))
                <li class="{{ Request::is('pos*') ? 'active' : '' }}">
                    <a href="{{ route('pos.index') }}" class="svg-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="ml-3">{{ __('sidebar.pos') }}</span>
                    </a>
                </li>
                @endif

                <hr>

                <!-- Orders -->
                @if(auth()->user()->can('orders.menu'))
                <li>
                    <a href="#orders" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-basket-shopping"></i>
                        <span class="ml-3">{{ __('sidebar.orders') }}</span>
                        <i class="fa-solid fa-chevron-down iq-arrow-right arrow-active"></i>
                    </a>
                    <ul id="orders" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ Request::is('orders/pending*') ? 'active' : '' }}">
                            <a href="{{ route('order.pendingOrders') }}">
                                <i class="fa-solid fa-arrow-right"></i>
                                <span>{{ __('sidebar.pending_orders') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('orders/complete*') ? 'active' : '' }}">
                            <a href="{{ route('order.completeOrders') }}">
                                <i class="fa-solid fa-arrow-right"></i>
                                <span>{{ __('sidebar.complete_orders') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('pending/due*') ? 'active' : '' }}">
                            <a href="{{ route('order.pendingDue') }}">
                                <i class="fa-solid fa-arrow-right"></i>
                                <span>{{ __('sidebar.pending_due') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('stock*') ? 'active' : '' }}">
                            <a href="{{ route('order.stockManage') }}">
                                <i class="fa-solid fa-arrow-right"></i>
                                <span>{{ __('sidebar.stock_management') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Products -->
                @if(auth()->user()->can('product.menu'))
                <li>
                    <a href="#products" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span class="ml-3">{{ __('sidebar.products') }}</span>
                        <i class="fa-solid fa-chevron-down iq-arrow-right arrow-active"></i>
                    </a>
                    <ul id="products" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ Request::is('products') ? 'active' : '' }}">
                            <a href="{{ route('products.index') }}">
                                <i class="fa-solid fa-arrow-right"></i>
                                <span>{{ __('sidebar.products') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('products/create') ? 'active' : '' }}">
                            <a href="{{ route('products.create') }}">
                                <i class="fa-solid fa-arrow-right"></i>
                                <span>{{ __('sidebar.add_product') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('categories*') ? 'active' : '' }}">
                            <a href="{{ route('categories.index') }}">
                                <i class="fa-solid fa-arrow-right"></i>
                                <span>{{ __('sidebar.categories') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <hr>

                <!-- Employees -->
                @if(auth()->user()->can('employee.menu'))
                <li class="{{ Request::is('employees*') ? 'active' : '' }}">
                    <a href="{{ route('employees.index') }}" class="svg-icon">
                        <i class="fa-solid fa-users"></i>
                        <span class="ml-3">{{ __('sidebar.employees') }}</span>
                    </a>
                </li>
                @endif

                <!-- Customers -->
                @if(auth()->user()->can('customer.menu'))
                <li class="{{ Request::is('customers*') ? 'active' : '' }}">
                    <a href="{{ route('customers.index') }}" class="svg-icon">
                        <i class="fa-solid fa-users"></i>
                        <span class="ml-3">{{ __('sidebar.customers') }}</span>
                    </a>
                </li>
                @endif

                <!-- Suppliers -->
                @if(auth()->user()->can('supplier.menu'))
                <li class="{{ Request::is('suppliers*') ? 'active' : '' }}">
                    <a href="{{ route('suppliers.index') }}" class="svg-icon">
                        <i class="fa-solid fa-truck"></i>
                        <span class="ml-3">{{ __('sidebar.suppliers') }}</span>
                    </a>
                </li>
                @endif
@if(auth()->user()->can('branches.menu'))
                <!-- Branches -->
                <li>
                    <a href="#branches" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-code-branch"></i>
                        <span class="ml-3">الفروع</span>
                        <i class="fa-solid fa-chevron-down iq-arrow-right arrow-active"></i>
                    </a>
                    <ul id="branches" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ Request::is('branches') ? 'active' : '' }}">
                            <a href="{{ route('branches.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>كل الفروع</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('branches/create') ? 'active' : '' }}">
                            <a href="{{ route('branches.create') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>إضافة فرع</span>
                            </a>
                        </li>
                    </ul>
                </li>
@endif

@if(auth()->user()->can('transfers.menu'))
                <!-- Stock Transfers -->
                <li>
                    <a href="#transfers" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-right-left"></i>
                        <span class="ml-3">تحويلات المخزون</span>
                        <i class="fa-solid fa-chevron-down iq-arrow-right arrow-active"></i>
                    </a>
                    <ul id="transfers" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ Request::is('transfers') ? 'active' : '' }}">
                            <a href="{{ route('transfers.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>كل التحويلات</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('transfers/create') ? 'active' : '' }}">
                            <a href="{{ route('transfers.create') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>إنشاء تحويل جديد</span>
                            </a>
                        </li>
                    </ul>
                </li>
@endif
                <hr>

                <!-- Roles & Permissions -->
                @if(auth()->user()->can('roles.menu'))
                <li>
                    <a href="#permission" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-key"></i>
                        <span class="ml-3">{{ __('sidebar.roles_permissions') }}</span>
                        <i class="fa-solid fa-chevron-down iq-arrow-right arrow-active"></i>
                    </a>
                    <ul id="permission" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ Request::is('permission*') ? 'active' : '' }}">
                            <a href="{{ route('permission.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.permissions') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('role*') ? 'active' : '' }}">
                            <a href="{{ route('role.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.roles') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('role/permission*') ? 'active' : '' }}">
                            <a href="{{ route('rolePermission.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.role_in_permissions') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Users -->
                @if(auth()->user()->can('user.menu'))
                <li class="{{ Request::is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="svg-icon">
                        <i class="fa-solid fa-users"></i>
                        <span class="ml-3">{{ __('sidebar.users') }}</span>
                    </a>
                </li>
                @endif

                <!-- Database Backup -->
                @if(auth()->user()->can('database.menu'))
                <li class="{{ Request::is('database/backup*') ? 'active' : '' }}">
                    <a href="{{ route('backup.index') }}" class="svg-icon">
                        <i class="fa-solid fa-database"></i>
                        <span class="ml-3">{{ __('sidebar.backup') }}</span>
                    </a>
                </li>
                @endif

            </ul>

            <div class="p-3"></div>
        </nav>
    </div>
</div>
