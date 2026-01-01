@can('setting_access')
    <li class="nav-item has-treeview {{ request()->is("admin/settings*") ? "menu-open" : "" }} {{ request()->is("admin/menu-builder*") ? "menu-open" : "" }}">
        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/settings*") ? "active" : "" }} {{ request()->is("admin/menu-builder*") ? "active" : "" }}" href="#">
            <i class="fa-fw nav-icon fas fa-cogs"></i>
            <p>
                {{ trans('cruds.setting.title') }}
                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#setupWizardModal">
                    <i class="fa-fw nav-icon fas fa-magic text-primary"></i>
                    <p>Setup Wizard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.settings.index") }}" class="nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "active" : "" }}">
                    <i class="fa-fw nav-icon fas fa-sliders-h"></i>
                    <p>Site Settings</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/menu-builder') }}" class="nav-link {{ request()->is("admin/menu-builder*") ? "active" : "" }}">
                    <i class="fa-fw nav-icon fas fa-bars"></i>
                    <p>Menu Builder</p>
                </a>
            </li>
        </ul>
    </li>
@endcan
