@extends('layouts.admin')
@section('content')

@can('setting_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.settings.create') }}">
                <i class="fas fa-plus"></i> Add New Setting
            </a>
        </div>
    </div>
@endcan

@php
    $settingsByGroup = \App\Models\Setting::orderBy('group')->orderBy('label')->get()->groupBy('group');
    $groupLabels = \App\Models\Setting::GROUP_SELECT;
    $groupIcons = [
        'branding' => 'fa-palette',
        'contact' => 'fa-address-card',
        'login' => 'fa-sign-in-alt',
        'general' => 'fa-cog',
        'shop' => 'fa-store',
    ];
@endphp

<div class="row">
    @foreach($groupLabels as $groupKey => $groupLabel)
        @if($settingsByGroup->has($groupKey))
        <div class="col-md-6">
            <div class="card card-outline card-primary mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas {{ $groupIcons[$groupKey] ?? 'fa-cog' }} mr-2"></i>
                        {{ $groupLabel }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <tbody>
                            @foreach($settingsByGroup[$groupKey] as $setting)
                                <tr>
                                    <td style="width: 40%;">
                                        <strong>{{ $setting->label ?? $setting->key }}</strong>
                                        @if($setting->description)
                                            <br><small class="text-muted">{{ $setting->description }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($setting->type === 'image')
                                            @if($setting->value)
                                                <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->label }}" style="max-height: 50px;">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        @elseif($setting->type === 'boolean')
                                            @if($setting->value == '1')
                                                <span class="badge badge-success">Enabled</span>
                                            @else
                                                <span class="badge badge-secondary">Disabled</span>
                                            @endif
                                        @elseif($setting->type === 'textarea')
                                            <span class="text-truncate d-inline-block" style="max-width: 200px;">{{ $setting->value ?: '-' }}</span>
                                        @else
                                            {{ $setting->value ?: '-' }}
                                        @endif
                                    </td>
                                    <td style="width: 80px;" class="text-right">
                                        @can('setting_edit')
                                            <a href="{{ route('admin.settings.edit', $setting->id) }}" class="btn btn-xs btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>

{{-- Show any ungrouped settings --}}
@php
    $ungrouped = \App\Models\Setting::whereNotIn('group', array_keys($groupLabels))->orWhereNull('group')->get();
@endphp

@if($ungrouped->count() > 0)
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-cogs mr-2"></i> Other Settings</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($ungrouped as $setting)
                    <tr>
                        <td>
                            <strong>{{ $setting->label ?? $setting->key }}</strong>
                            <br><code>{{ $setting->key }}</code>
                        </td>
                        <td>{{ Str::limit($setting->value, 50) ?: '-' }}</td>
                        <td class="text-right">
                            @can('setting_edit')
                                <a href="{{ route('admin.settings.edit', $setting->id) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Developer Tools Section --}}
@can('setting_edit')
<div class="row mt-4">
    <div class="col-12">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-tools mr-2"></i>
                    Developer Tools
                </h5>
            </div>
            <div class="card-body">
                @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-outline card-info h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-box mr-2"></i> Dummy Products</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small">
                                    Create sample products to test the system. Includes:
                                </p>
                                <ul class="small text-muted">
                                    <li>8 standard products</li>
                                    <li>5 accessories</li>
                                    <li>1 bundle/set</li>
                                    <li>Categories & tags</li>
                                </ul>
                                <div class="mt-3">
                                    <form action="{{ route('admin.settings.seedDummyProducts') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm btn-block mb-2" onclick="return confirm('This will create dummy products. Continue?')">
                                            <i class="fas fa-plus mr-1"></i> Add Products
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.settings.removeDummyProducts') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-block" onclick="return confirm('This will permanently delete all dummy products. Continue?')">
                                            <i class="fas fa-trash mr-1"></i> Remove Products
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-outline card-info h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-users mr-2"></i> Dummy Clients</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small">
                                    Create sample clients with addresses:
                                </p>
                                <ul class="small text-muted">
                                    <li>5 clients (grocery, florist)</li>
                                    <li>Multiple addresses each</li>
                                    <li>Corp, shipping, billing</li>
                                    <li>Contact info & notes</li>
                                </ul>
                                <div class="mt-3">
                                    <form action="{{ route('admin.settings.seedDummyClients') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm btn-block mb-2" onclick="return confirm('This will create dummy clients. Continue?')">
                                            <i class="fas fa-plus mr-1"></i> Add Clients
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.settings.removeDummyClients') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-block" onclick="return confirm('This will permanently delete all dummy clients. Continue?')">
                                            <i class="fas fa-trash mr-1"></i> Remove Clients
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-outline card-info h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-sliders-h mr-2"></i> Settings Seeder</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small">
                                    Seed default settings:
                                </p>
                                <ul class="small text-muted">
                                    <li>Company branding</li>
                                    <li>Contact information</li>
                                    <li>Login page settings</li>
                                    <li>Order settings</li>
                                </ul>
                                <div class="mt-3">
                                    <form action="{{ route('admin.settings.seedSettings') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm btn-block" onclick="return confirm('This will create/update default settings. Continue?')">
                                            <i class="fas fa-database mr-1"></i> Seed Settings
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-outline card-secondary h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-info-circle mr-2"></i> System Info</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-borderless mb-0 small">
                                    <tr>
                                        <td class="text-muted">Laravel:</td>
                                        <td><strong>{{ app()->version() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">PHP:</td>
                                        <td><strong>{{ phpversion() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Env:</td>
                                        <td><strong>{{ app()->environment() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Products:</td>
                                        <td><strong>{{ \App\Models\Product::count() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Clients:</td>
                                        <td><strong>{{ \App\Models\Client::count() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Orders:</td>
                                        <td><strong>{{ \App\Models\Order::count() }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan

@endsection