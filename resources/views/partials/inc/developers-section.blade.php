@can('developer_access')
    <li class="nav-item has-treeview {{ request()->is("admin/clients*") ? "menu-open" : "" }} {{ request()->is("admin/client-prices*") ? "menu-open" : "" }} {{ request()->is("admin/order-items*") ? "menu-open" : "" }}">
        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/clients*") ? "active" : "" }} {{ request()->is("admin/client-prices*") ? "active" : "" }} {{ request()->is("admin/order-items*") ? "active" : "" }}" href="#">
            <i class="fa-fw nav-icon fas fa-user-tie"></i>
            <p>
                Client Manager
                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('client_access')
                <li class="nav-item">
                    <a href="{{ route("admin.clients.index") }}" class="nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon far fa-user"></i>
                        <p>{{ trans('cruds.client.title') }}</p>
                    </a>
                </li>
            @endcan
            @can('client_price_access')
                <li class="nav-item">
                    <a href="{{ route("admin.client-prices.index") }}" class="nav-link {{ request()->is("admin/client-prices") || request()->is("admin/client-prices/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-hand-holding-usd"></i>
                        <p>{{ trans('cruds.clientPrice.title') }}</p>
                    </a>
                </li>
            @endcan
            @can('order_item_access')
                <li class="nav-item">
                    <a href="{{ route("admin.order-items.index") }}" class="nav-link {{ request()->is("admin/order-items") || request()->is("admin/order-items/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-sitemap"></i>
                        <p>{{ trans('cruds.orderItem.title') }}</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan
