@can('order_management_access')
    <li class="c-sidebar-nav-dropdown {{ request()->is("admin/orders*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-credit-card c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.orderManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.order.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
@endcan
