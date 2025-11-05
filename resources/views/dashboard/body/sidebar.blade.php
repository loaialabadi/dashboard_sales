<div class="iq-sidebar sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="header-logo">
            <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid rounded-normal light-logo" alt="logo">
            <h5 class="logo-title light-logo ml-3">نظام إدارة المبيعات</h5>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="svg-icon">
                        <i class="fa-solid fa-chart-line"></i>
                        <span class="ml-4">{{ __('sidebar.dashboard') }}</span>
                    </a>
                </li>

                @if (auth()->user()->can('pos.menu'))
                <li class="{{ Request::is('pos*') ? 'active' : '' }}">
                    <a href="{{ route('pos.index') }}" class="svg-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="ml-3">{{ __('sidebar.pos') }}</span>
                    </a>
                </li>
                @endif

                <hr>

                @if (auth()->user()->can('orders.menu'))
                <li>
                    <a href="#orders" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-basket-shopping"></i>
                        <span class="ml-3">{{ __('sidebar.orders') }}</span>
                        <i class="fa-solid fa-chevron-down iq-arrow-right arrow-active"></i>
                    </a>
                    <ul id="orders" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ Request::is('orders/pending*') ? 'active' : '' }}">
                            <a href="{{ route('order.pendingOrders') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.pending_orders') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('orders/complete*') ? 'active' : '' }}">
                            <a href="{{ route('order.completeOrders') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.complete_orders') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('pending/due*') ? 'active' : '' }}">
                            <a href="{{ route('order.pendingDue') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.pending_due') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is(['stock*']) ? 'active' : '' }}">
                            <a href="{{ route('order.stockManage') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.stock_management') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (auth()->user()->can('product.menu'))
                <li>
                    <a href="#products" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span class="ml-3">{{ __('sidebar.products') }}</span>
                        <i class="fa-solid fa-chevron-down iq-arrow-right arrow-active"></i>
                    </a>
                    <ul id="products" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ Request::is(['products']) ? 'active' : '' }}">
                            <a href="{{ route('products.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.products') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is(['products/create']) ? 'active' : '' }}">
                            <a href="{{ route('products.create') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.add_product') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is(['categories*']) ? 'active' : '' }}">
                            <a href="{{ route('categories.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.categories') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <hr>

                @if (auth()->user()->can('employee.menu'))
                <li class="{{ Request::is('employees*') ? 'active' : '' }}">
                    <a href="{{ route('employees.index') }}" class="svg-icon">
                        <i class="fa-solid fa-users"></i>
                        <span class="ml-3">{{ __('sidebar.employees') }}</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can('customer.menu'))
                <li class="{{ Request::is('customers*') ? 'active' : '' }}">
                    <a href="{{ route('customers.index') }}" class="svg-icon">
                        <i class="fa-solid fa-users"></i>
                        <span class="ml-3">{{ __('sidebar.customers') }}</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can('supplier.menu'))
                <li class="{{ Request::is('suppliers*') ? 'active' : '' }}">
                    <a href="{{ route('suppliers.index') }}" class="svg-icon">
                        <i class="fa-solid fa-truck"></i>
                        <span class="ml-3">{{ __('sidebar.suppliers') }}</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can('salary.menu'))
                <li>
                    <a href="#advance-salary" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-cash-register"></i>
                        <span class="ml-3">{{ __('sidebar.salary') }}</span>
                        <i class="fa-solid fa-chevron-down iq-arrow-right arrow-active"></i>
                    </a>
                    <ul id="advance-salary" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ Request::is(['advance-salary', 'advance-salary/*/edit']) ? 'active' : '' }}">
                            <a href="{{ route('advance-salary.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.all_advance_salary') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('advance-salary/create*') ? 'active' : '' }}">
                            <a href="{{ route('advance-salary.create') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.create_advance_salary') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('pay-salary') ? 'active' : '' }}">
                            <a href="{{ route('pay-salary.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.pay_salary') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('pay-salary/history*') ? 'active' : '' }}">
                            <a href="{{ route('pay-salary.payHistory') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.pay_history') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (auth()->user()->can('attendence.menu'))
                <li>
                    <a href="#attendence" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span class="ml-3">{{ __('sidebar.attendance') }}</span>
                        <i class="fa-solid fa-chevron-down iq-arrow-right arrow-active"></i>
                    </a>
                    <ul id="attendence" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ Request::is(['employee/attendence']) ? 'active' : '' }}">
                            <a href="{{ route('attendence.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.all_attendance') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('employee/attendence/*') ? 'active' : '' }}">
                            <a href="{{ route('attendence.create') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.create_attendance') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <hr>

                @if (auth()->user()->can('roles.menu'))
                <li>
                    <a href="#permission" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-key"></i>
                        <span class="ml-3">{{ __('sidebar.roles_permissions') }}</span>
                        <i class="fa-solid fa-chevron-down iq-arrow-right arrow-active"></i>
                    </a>
                    <ul id="permission" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ Request::is(['permission*']) ? 'active' : '' }}">
                            <a href="{{ route('permission.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.permissions') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is(['role*']) ? 'active' : '' }}">
                            <a href="{{ route('role.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.roles') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is(['role/permission*']) ? 'active' : '' }}">
                            <a href="{{ route('rolePermission.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>{{ __('sidebar.role_in_permissions') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (auth()->user()->can('user.menu'))
                <li class="{{ Request::is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="svg-icon">
                        <i class="fa-solid fa-users"></i>
                        <span class="ml-3">{{ __('sidebar.users') }}</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can('database.menu'))
                <li class="{{ Request::is('database/backup*') ? 'active' : '' }}">
                    <a href="{{ route('backup.index') }}" class="svg-icon">
                        <i class="fa-solid fa-database"></i>
                        <span class="ml-3">{{ __('sidebar.backup') }}</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
