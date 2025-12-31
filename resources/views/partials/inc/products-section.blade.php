@can('product_management_access')
    <li class="nav-item has-treeview {{ request()->is("admin/products*") ? "menu-open" : "" }} {{ request()->is("admin/product-categories*") ? "menu-open" : "" }} {{ request()->is("admin/product-tags*") ? "menu-open" : "" }} {{ request()->is("admin/accessor*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/products*") ? "active" : "" }} {{ request()->is("admin/product-categories*") ? "active" : "" }} {{ request()->is("admin/product-tags*") ? "active" : "" }} {{ request()->is("admin/accessor*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-shopping-cart">

                            </i>
                            <p>
                                {{ trans('cruds.productManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.products.index") }}" class="nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-shopping-cart">

                                        </i>
                                        <p>
                                            {{ trans('cruds.product.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.product-categories.index") }}" class="nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.product-tags.index") }}" class="nav-link {{ request()->is("admin/product-tags") || request()->is("admin/product-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('accessory_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.accessory-types.index") }}" class="nav-link {{ request()->is("admin/accessory-types") || request()->is("admin/accessory-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-puzzle-piece">

                                        </i>
                                        <p>
                                            Accessory Types
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('accessory_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.accessories.index") }}" class="nav-link {{ request()->is("admin/accessories") || request()->is("admin/accessories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-plus-circle">

                                        </i>
                                        <p>
                                            Accessories
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
@endcan
