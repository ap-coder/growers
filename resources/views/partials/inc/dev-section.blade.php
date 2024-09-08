@can('developer_access')
    <li class="c-sidebar-nav-dropdown {{ request()->is("admin/clients*") ? "c-show" : "" }} {{ request()->is("admin/client-prices*") ? "c-show" : "" }} {{ request()->is("admin/order-items*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.developer.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('client_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.clients.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.client.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('client_price_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.client-prices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/client-prices") || request()->is("admin/client-prices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.clientPrice.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('order_item_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.order-items.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/order-items") || request()->is("admin/order-items/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sitemap c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.orderItem.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
@endcan
