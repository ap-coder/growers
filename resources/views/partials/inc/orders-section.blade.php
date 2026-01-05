@can('order_management_access')
    <li class="nav-item has-treeview {{ request()->is("admin/orders*") || request()->is("admin/invoices*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/orders*") || request()->is("admin/invoices*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-credit-card">

                            </i>
                            <p>
                                {{ trans('cruds.orderManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('order_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.orders.index") }}" class="nav-link {{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-clipboard-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.order.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('order_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.invoices.index") }}" class="nav-link {{ request()->is("admin/invoices") || request()->is("admin/invoices/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-invoice">

                                        </i>
                                        <p>
                                            Invoices
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
@endcan
