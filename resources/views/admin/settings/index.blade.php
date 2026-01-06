@extends('layouts.admin')
@section('content')

@can('setting_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.settings.create') }}">
                <i class="fas fa-plus"></i> Add New Setting
            </a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createClientModal">
                <i class="fas fa-building"></i> Quick Create Client
            </button>
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
                                            @if($setting->image)
                                                <img src="{{ $setting->image->preview }}" alt="{{ $setting->label }}" style="max-height: 50px;">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        @elseif($setting->type === 'boolean')
                                            @if($setting->value == '1')
                                                <span class="badge badge-success">Enabled</span>
                                            @else
                                                <span class="badge badge-secondary">Disabled</span>
                                            @endif
                                        @elseif($setting->type === 'html')
                                            @if($setting->value)
                                                <span class="badge badge-success">Default Is In Place</span>
                                            @else
                                                <span class="text-muted">Not Set</span>
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

{{-- Admin Debug Tools --}}
<div class="card card-outline card-secondary mb-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-tools mr-2"></i>
            Admin Tools
        </h5>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <div class="row">
            <div class="col-md-3">
                <form action="{{ route('admin.settings.clearCache') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-block">
                        <i class="fas fa-sync"></i> Clear All Caches
                    </button>
                </form>
                <small class="text-muted">Clears config, cache, and view caches</small>
            </div>
            <div class="col-md-3">
                <form action="{{ route('admin.settings.checkMedia') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-info btn-block">
                        <i class="fas fa-images"></i> Check Media Status
                    </button>
                </form>
                <small class="text-muted">Shows media info for image settings</small>
            </div>
            <div class="col-md-3">
                <form action="{{ route('admin.settings.viewLogs') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-file-alt"></i> View Upload Logs
                    </button>
                </form>
                <small class="text-muted">Shows recent upload activity logs</small>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-secondary btn-block" onclick="window.location.reload()">
                    <i class="fas fa-redo"></i> Refresh Page
                </button>
                <small class="text-muted">Reload the page to see changes</small>
            </div>
        </div>

        @if(session('media_info'))
            <hr class="my-3">
            <h6 class="mb-3"><i class="fas fa-info-circle mr-2"></i>Media Status Report</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Setting</th>
                            <th>Media Count</th>
                            <th>Has Image</th>
                            <th>File Name</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('media_info') as $info)
                            <tr>
                                <td><strong>{{ $info['label'] }}</strong><br><small class="text-muted">{{ $info['key'] }}</small></td>
                                <td>{{ $info['media_count'] }}</td>
                                <td>
                                    @if($info['has_image'] === 'Yes')
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </td>
                                <td><small>{{ $info['file_name'] }}</small></td>
                                <td><small class="text-break">{{ Str::limit($info['url'], 60) }}</small></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if(session('upload_logs'))
            <hr class="my-3">
            <h6 class="mb-3"><i class="fas fa-file-alt mr-2"></i>Recent Upload Logs</h6>
            <div class="alert alert-info">
                <small><strong>Tip:</strong> Upload an image, then click "View Upload Logs" to see what happened during the upload process.</small>
            </div>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 4px; max-height: 400px; overflow-y: auto;">
                @if(count(session('upload_logs')) > 0)
                    @foreach(session('upload_logs') as $log)
                        <div style="font-family: monospace; font-size: 11px; margin-bottom: 5px; word-break: break-all;">
                            {{ $log }}
                        </div>
                    @endforeach
                @else
                    <p class="text-muted mb-0">No upload-related logs found. Try uploading an image first.</p>
                @endif
            </div>
        @endif
    </div>
</div>

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
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-outline card-warning h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-database mr-2"></i> Dummy Data Counts</h6>
                            </div>
                            <div class="card-body">
                                @php
                                    $dummyProducts = \App\Models\Product::where('is_fake', true)->count();
                                    $dummyVariations = \App\Models\ProductVariation::where('is_fake', true)->count();
                                    $dummyPriceTiers = \App\Models\ProductPriceTier::where('is_fake', true)->count();
                                    $dummyCategories = \App\Models\ProductCategory::where('is_fake', true)->count();
                                    $dummyTags = \App\Models\ProductTag::where('is_fake', true)->count();
                                    $dummyCollections = \App\Models\ProductCollection::where('is_fake', true)->count();
                                    $dummyClients = \App\Models\Client::where('is_fake', true)->count();
                                    $dummyAddresses = \App\Models\ClientAddress::where('is_fake', true)->count();
                                    $dummyFaqCats = \App\Models\FaqCategory::where('is_fake', true)->count();
                                    $dummyFaqs = \App\Models\FaqQuestion::where('is_fake', true)->count();
                                    $dummyPages = \App\Models\ContentPage::where('is_fake', true)->count();
                                    $totalDummy = $dummyProducts + $dummyVariations + $dummyPriceTiers + $dummyCategories + $dummyTags + $dummyCollections + $dummyClients + $dummyAddresses + $dummyFaqCats + $dummyFaqs + $dummyPages;
                                @endphp
                                <div class="row">
                                    <div class="col-6">
                                        <table class="table table-sm table-borderless mb-0 small">
                                            <tr>
                                                <td class="text-muted">Products:</td>
                                                <td class="text-right"><strong>{{ $dummyProducts }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Variations:</td>
                                                <td class="text-right"><strong>{{ $dummyVariations }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Price Tiers:</td>
                                                <td class="text-right"><strong>{{ $dummyPriceTiers }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Categories:</td>
                                                <td class="text-right"><strong>{{ $dummyCategories }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Tags:</td>
                                                <td class="text-right"><strong>{{ $dummyTags }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Collections:</td>
                                                <td class="text-right"><strong>{{ $dummyCollections }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <table class="table table-sm table-borderless mb-0 small">
                                            <tr>
                                                <td class="text-muted">Clients:</td>
                                                <td class="text-right"><strong>{{ $dummyClients }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Addresses:</td>
                                                <td class="text-right"><strong>{{ $dummyAddresses }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">FAQ Cats:</td>
                                                <td class="text-right"><strong>{{ $dummyFaqCats }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">FAQs:</td>
                                                <td class="text-right"><strong>{{ $dummyFaqs }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Pages:</td>
                                                <td class="text-right"><strong>{{ $dummyPages }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="border-top pt-2 mt-2">
                                    <table class="table table-sm table-borderless mb-0 small">
                                        <tr>
                                            <td><strong>Total Dummy:</strong></td>
                                            <td class="text-right"><strong>{{ $totalDummy }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-outline card-info h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-box mr-2"></i> Dummy Products</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small mb-2">Add products incrementally. Categories/tags created once.</p>
                                <form action="{{ route('admin.settings.seedAllDummyProducts') }}" method="POST" class="dummy-add-form mb-2" data-type="all products" data-details="Generate complete product catalog: 30 products, 5 accessories, 1 bundle, with variations and price tiers">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fas fa-magic mr-1"></i> Generate All Products</button>
                                </form>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-6">
                                        <form action="{{ route('admin.settings.seedDummyProducts') }}" method="POST" class="dummy-add-form mb-1" data-type="products">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-block"><i class="fas fa-plus mr-1"></i> Products</button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{ route('admin.settings.seedDummyAccessories') }}" method="POST" class="dummy-add-form mb-1" data-type="accessories">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-block"><i class="fas fa-plus mr-1"></i> Accessories</button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{ route('admin.settings.seedDummyBundles') }}" method="POST" class="dummy-add-form mb-1" data-type="bundles">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-block"><i class="fas fa-plus mr-1"></i> Bundle</button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{ route('admin.settings.seedDummyVariations') }}" method="POST" class="dummy-add-form mb-1" data-type="variations">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-info btn-sm btn-block"><i class="fas fa-layer-group mr-1"></i> Variations</button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{ route('admin.settings.seedDummyPriceTiers') }}" method="POST" class="dummy-add-form mb-1" data-type="price tiers">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-info btn-sm btn-block"><i class="fas fa-dollar-sign mr-1"></i> Price Tiers</button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{ route('admin.settings.seedDummyCart') }}" method="POST" class="dummy-add-form mb-1" data-type="cart items">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-warning btn-sm btn-block"><i class="fas fa-shopping-cart mr-1"></i> Add Cart</button>
                                        </form>
                                    </div>
                                    <div class="col-12">
                                        <form action="{{ route('admin.settings.seedDummyOrders') }}" method="POST" class="dummy-add-form mb-2" data-type="orders">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-secondary btn-sm btn-block"><i class="fas fa-receipt mr-1"></i> Create Orders</button>
                                        </form>
                                    </div>
                                </div>
                                <a href="{{ route('admin.products.index') }}" target="_blank" class="btn btn-outline-primary btn-sm btn-block mb-1"><i class="fas fa-eye mr-1"></i> View</a>
                                <form action="{{ route('admin.settings.removeDummyProducts') }}" method="POST" class="dummy-remove-form" data-type="all products">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block"><i class="fas fa-trash mr-1"></i> Remove All</button>
                                </form>
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
                                    Create sample clients with addresses.
                                </p>
                                <ul class="small text-muted mb-2">
                                    <li>5 clients (grocery stores, florists)</li>
                                    <li>2-3 addresses per client</li>
                                    <li>Corporate, shipping, billing types</li>
                                    <li>Contact info, phone, notes</li>
                                </ul>
                                <div class="d-grid gap-2 d-md-block mt-3">
                                    <form action="{{ route('admin.settings.seedDummyClients') }}" method="POST" class="d-inline dummy-add-form" data-type="clients" data-details="5 clients (Smith's, Harmon's, Associated Foods, Local Florist, Garden Center) with 2-3 addresses each including corporate, shipping, and billing addresses">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-plus mr-1"></i> Add</button>
                                    </form>
                                    <a href="{{ route('admin.clients.index') }}" target="_blank" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye mr-1"></i> View</a>
                                    <form action="{{ route('admin.settings.removeDummyClients') }}" method="POST" class="d-inline dummy-remove-form" data-type="clients">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash mr-1"></i> Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-outline card-info h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-question-circle mr-2"></i> Dummy FAQs</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small">
                                    Create sample FAQ categories and questions.
                                </p>
                                <ul class="small text-muted mb-2">
                                    <li>3 FAQ categories</li>
                                    <li>4-5 questions per category</li>
                                    <li>Ordering, shipping, returns</li>
                                </ul>
                                <div class="d-grid gap-2 d-md-block mt-3">
                                    <form action="{{ route('admin.settings.seedDummyFaqs') }}" method="POST" class="d-inline dummy-add-form" data-type="FAQs" data-details="3 FAQ categories (Ordering, Shipping & Delivery, Returns & Policies) with 4-5 questions and answers each">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-plus mr-1"></i> Add</button>
                                    </form>
                                    <a href="{{ route('admin.faq-categories.index') }}" target="_blank" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye mr-1"></i> View</a>
                                    <form action="{{ route('admin.settings.removeDummyFaqs') }}" method="POST" class="d-inline dummy-remove-form" data-type="FAQs">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash mr-1"></i> Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="card card-outline card-info h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-file-alt mr-2"></i> Dummy Pages</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small">
                                    Create sample content pages.
                                </p>
                                <ul class="small text-muted mb-2">
                                    <li>About Us page</li>
                                    <li>How to Order guide</li>
                                    <li>Delivery Information</li>
                                    <li>Contact page</li>
                                </ul>
                                <div class="d-grid gap-2 d-md-block mt-3">
                                    <form action="{{ route('admin.settings.seedDummyPages') }}" method="POST" class="d-inline dummy-add-form" data-type="pages" data-details="4 content pages: About Us, How to Order, Delivery Information, and Contact Us with sample content">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-plus mr-1"></i> Add</button>
                                    </form>
                                    <a href="{{ route('admin.content-pages.index') }}" target="_blank" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye mr-1"></i> View</a>
                                    <form action="{{ route('admin.settings.removeDummyPages') }}" method="POST" class="d-inline dummy-remove-form" data-type="pages">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash mr-1"></i> Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-outline card-info h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-th-large mr-2"></i> Dummy Collections</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small">
                                    Create sample product collections.
                                </p>
                                <ul class="small text-muted mb-2">
                                    <li>One of each layout type</li>
                                    <li>4-8 products per collection</li>
                                    <li>Grid, Carousel, Masonry, etc.</li>
                                </ul>
                                <div class="d-grid gap-2 d-md-block mt-3">
                                    <form action="{{ route('admin.settings.seedDummyCollections') }}" method="POST" class="d-inline dummy-add-form" data-type="collections" data-details="11 product collections (one for each layout type: Grid, Masonry, Carousel, Tiles, Cobble 1&2, Collage 1&2, Film Strip, Split Slider, Thumbs Slider) with 4-8 products each">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-plus mr-1"></i> Add</button>
                                    </form>
                                    <a href="{{ route('admin.product-collections.index') }}" target="_blank" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye mr-1"></i> View</a>
                                    <form action="{{ route('admin.settings.removeDummyCollections') }}" method="POST" class="d-inline dummy-remove-form" data-type="collections">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash mr-1"></i> Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="card card-outline card-info h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-sliders-h mr-2"></i> Export Settings</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small">
                                    Generate seeder files from current settings and media:
                                </p>
                                <ul class="small text-muted mb-2">
                                    <li>Settings table → SettingsTableSeeder</li>
                                    <li>Media table → MediaTableSeeder</li>
                                </ul>
                                <form action="{{ route('admin.settings.seedSettings') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm btn-block" onclick="return confirm('This will generate seeder files from current settings and media tables. Continue?')">
                                        <i class="fas fa-file-export mr-1"></i> Export Settings
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-outline card-info h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-bars mr-2"></i> Export Menus</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small">
                                    Generate seeder files from current menus:
                                </p>
                                <ul class="small text-muted mb-2">
                                    <li>Menus table → MenusTableSeeder</li>
                                    <li>Menu Items → MenuItemsTableSeeder</li>
                                </ul>
                                <form action="{{ route('admin.settings.seedMenus') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm btn-block" onclick="return confirm('This will generate seeder files from current menus and menu_items tables. Continue?')">
                                        <i class="fas fa-file-export mr-1"></i> Export Menus
                                    </button>
                                </form>
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
                                        <td><strong>{{ \App\Models\Product::where('is_fake', false)->orWhereNull('is_fake')->count() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Clients:</td>
                                        <td><strong>{{ \App\Models\Client::where('is_fake', false)->orWhereNull('is_fake')->count() }}</strong></td>
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

{{-- WCL Developer Tools --}}
@if(Auth::user()->isWclDeveloper)
<div class="card mt-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><i class="fas fa-code mr-2"></i> WCL Developer Tools</h5>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- Migration Tools --}}
            <div class="col-md-3">
                <div class="card card-outline card-dark h-100">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-database mr-2"></i> Migrations</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Squash all migrations into a single file:</p>
                        <form action="{{ route('admin.settings.squashMigrations') }}" method="POST" class="wcl-ajax-form">
                            @csrf
                            <button type="submit" class="btn btn-dark btn-sm btn-block">
                                <i class="fas fa-compress-alt mr-1"></i> Squash Migrations
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Media Regenerate All --}}
            <div class="col-md-3">
                <div class="card card-outline card-dark h-100">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-images mr-2"></i> Media - Full Regen</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Regenerate ALL media with responsive images:</p>
                        <form action="{{ route('admin.settings.regenerateMedia') }}" method="POST" class="wcl-ajax-form">
                            @csrf
                            <input type="hidden" name="mode" value="all">
                            <button type="submit" class="btn btn-dark btn-sm btn-block">
                                <i class="fas fa-sync mr-1"></i> Regenerate All
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Media Regenerate Missing --}}
            <div class="col-md-3">
                <div class="card card-outline card-dark h-100">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-image mr-2"></i> Media - Missing Only</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Regenerate only missing media conversions:</p>
                        <form action="{{ route('admin.settings.regenerateMedia') }}" method="POST" class="wcl-ajax-form">
                            @csrf
                            <input type="hidden" name="mode" value="missing">
                            <button type="submit" class="btn btn-dark btn-sm btn-block">
                                <i class="fas fa-sync mr-1"></i> Regen Missing
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Telescope --}}
            <div class="col-md-3">
                <div class="card card-outline card-dark h-100">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-satellite-dish mr-2"></i> Telescope</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Debug and monitor application (auto-clears daily):</p>
                        <a href="{{ url('telescope') }}" target="_blank" class="btn btn-dark btn-sm btn-block mb-2">
                            <i class="fas fa-external-link-alt mr-1"></i> Open Telescope
                        </a>
                        <form action="{{ route('admin.settings.clearTelescope') }}" method="POST" class="wcl-ajax-form">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark btn-sm btn-block">
                                <i class="fas fa-trash mr-1"></i> Clear Logs
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            {{-- Media Regen by Model --}}
            <div class="col-md-3">
                <div class="card card-outline card-secondary h-100">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-file-alt mr-2"></i> Pages Media</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Regenerate media for content pages:</p>
                        <form action="{{ route('admin.settings.regenerateModelMedia') }}" method="POST" class="wcl-ajax-form">
                            @csrf
                            <input type="hidden" name="model" value="ContentPage">
                            <button type="submit" class="btn btn-secondary btn-sm btn-block">
                                <i class="fas fa-sync mr-1"></i> Regen Pages
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-outline card-secondary h-100">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-box mr-2"></i> Products Media</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Regenerate media for products:</p>
                        <form action="{{ route('admin.settings.regenerateModelMedia') }}" method="POST" class="wcl-ajax-form">
                            @csrf
                            <input type="hidden" name="model" value="Product">
                            <button type="submit" class="btn btn-secondary btn-sm btn-block">
                                <i class="fas fa-sync mr-1"></i> Regen Products
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-outline card-secondary h-100">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-users mr-2"></i> Clients Media</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Regenerate media for clients:</p>
                        <form action="{{ route('admin.settings.regenerateModelMedia') }}" method="POST" class="wcl-ajax-form">
                            @csrf
                            <input type="hidden" name="model" value="Client">
                            <button type="submit" class="btn btn-secondary btn-sm btn-block">
                                <i class="fas fa-sync mr-1"></i> Regen Clients
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-outline card-secondary h-100">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-cog mr-2"></i> Settings Media</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Regenerate media for settings (logo, etc):</p>
                        <form action="{{ route('admin.settings.regenerateModelMedia') }}" method="POST" class="wcl-ajax-form">
                            @csrf
                            <input type="hidden" name="model" value="Setting">
                            <button type="submit" class="btn btn-secondary btn-sm btn-block">
                                <i class="fas fa-sync mr-1"></i> Regen Settings
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
@parent
<script>
$(document).ready(function() {
    // Handle ADD dummy data forms - submit directly without confirmation
    $('.dummy-add-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var button = form.find('button[type="submit"]');
        var originalText = button.html();
        var dataType = form.data('type') || 'data';
        var details = form.data('details') || 'Sample data for testing';

        Swal.fire({
            title: 'Create Dummy ' + dataType.charAt(0).toUpperCase() + dataType.slice(1) + '?',
            html: '<p class="mb-2">This will generate:</p><p class="text-muted small text-left">' + details + '</p>',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-plus mr-1"></i> Create'
        }).then((result) => {
            if (result.isConfirmed) {
                button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Creating...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    timeout: 300000, // 5 minutes timeout for long-running operations
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        button.prop('disabled', false).html(originalText);
                        Swal.fire({
                            title: '<i class="fas fa-check-circle text-success"></i> Complete!',
                            html: '<div class="alert alert-success mb-0"><strong>' + (response.message || 'Dummy ' + dataType + ' created successfully!') + '</strong></div>',
                            icon: null,
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            allowOutsideClick: false
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errorMsg = xhr.responseJSON?.message || xhr.responseJSON?.error || 'An error occurred';
                        if (xhr.statusText === 'timeout') {
                            errorMsg = 'Request timed out. The operation may still be running in the background. Please refresh the page to check if the data was created.';
                        }
                        Swal.fire({
                            title: '<i class="fas fa-times-circle text-danger"></i> Error!',
                            html: '<div class="alert alert-danger mb-0">' + errorMsg + '</div>',
                            icon: null,
                            showConfirmButton: true
                        });
                        button.prop('disabled', false).html(originalText);
                    }
                });
            }
        });
    });

    // Handle WCL Developer Tools AJAX forms
    $('.wcl-ajax-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var button = form.find('button[type="submit"]');
        var originalText = button.html();

        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Processing...');

        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success === false) {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'An error occurred',
                        icon: 'error',
                        timer: 10000,
                        timerProgressBar: true,
                        showConfirmButton: true
                    });
                } else {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message || 'Operation completed successfully!',
                        icon: 'success',
                        timer: 10000,
                        timerProgressBar: true,
                        showConfirmButton: true
                    });
                }
                button.prop('disabled', false).html(originalText);
            },
            error: function(xhr) {
                var errorMsg = xhr.responseJSON?.message || 'An error occurred';
                Swal.fire({
                    title: 'Error!',
                    text: errorMsg,
                    icon: 'error',
                    timer: 10000,
                    timerProgressBar: true,
                    showConfirmButton: true
                });
                button.prop('disabled', false).html(originalText);
            }
        });
    });

    // Handle REMOVE dummy data forms - require confirmation
    $('.dummy-remove-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var button = form.find('button[type="submit"]');
        var originalText = button.html();
        var dataType = form.data('type') || 'data';

        Swal.fire({
            title: 'Remove Dummy ' + dataType.charAt(0).toUpperCase() + dataType.slice(1) + '?',
            html: '<p class="text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> This will permanently delete all dummy ' + dataType + '.</p><p class="small text-muted">This action cannot be undone.</p>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash mr-1"></i> Yes, delete'
        }).then((result) => {
            if (result.isConfirmed) {
                button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Removing...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: '<i class="fas fa-check-circle text-success"></i> Removed!',
                            html: '<div class="alert alert-success mb-0"><strong>' + (response.message || 'Dummy ' + dataType + ' removed successfully!') + '</strong></div>',
                            icon: null,
                            showConfirmButton: true,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errorMsg = xhr.responseJSON?.message || xhr.responseJSON?.error || 'An error occurred';
                        Swal.fire({
                            title: '<i class="fas fa-times-circle text-danger"></i> Error!',
                            html: '<div class="alert alert-danger mb-0">' + errorMsg + '</div>',
                            icon: null,
                            showConfirmButton: true
                        });
                        button.prop('disabled', false).html(originalText);
                    }
                });
            }
        });
    });
});
</script>

{{-- Quick Create Client Modal --}}
<div class="modal fade" id="createClientModal" tabindex="-1" role="dialog" aria-labelledby="createClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createClientModalLabel">
                    <i class="fas fa-building mr-2"></i> Quick Create Client
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createClientForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_name">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="client_name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="store_number">Store Number</label>
                                <input type="text" class="form-control" id="store_number" name="store_number">
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                    <h6 class="mb-3">Contact Information</h6>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_name">Contact Name</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name" value="{{ auth()->user()->name }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_phone">Contact Phone</label>
                                <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ auth()->user()->phone }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_email">Contact Email</label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ auth()->user()->email }}">
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                    <h6 class="mb-3">Address</h6>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address_line_1">Address Line 1</label>
                                <input type="text" class="form-control" id="address_line_1" name="address_line_1">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address_line_2">Address Line 2</label>
                                <input type="text" class="form-control" id="address_line_2" name="address_line_2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postal_code">ZIP Code</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code">
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                    <h6 class="mb-3">Options</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">Assign to User (Optional)</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    <option value="">-- Select User --</option>
                                    @foreach(\App\Models\User::orderBy('name')->get() as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == auth()->id() ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Optionally assign this client to a user account</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mt-4">
                                    <input type="checkbox" class="custom-control-input" id="requires_upc" name="requires_upc" value="1">
                                    <label class="custom-control-label" for="requires_upc">Requires UPC Codes</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="published" name="published" value="1" checked>
                                    <label class="custom-control-label" for="published">Published (Active)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Client
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#createClientForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalText = submitBtn.html();

        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creating...');

        $.ajax({
            url: '{{ route("admin.setup-wizard.create-client") }}',
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: true
                    }).then(() => {
                        $('#createClientModal').modal('hide');
                        form[0].reset();
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error'
                    });
                    submitBtn.prop('disabled', false).html(originalText);
                }
            },
            error: function(xhr) {
                let errorMsg = 'An error occurred while creating the client.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                }

                Swal.fire({
                    title: 'Error',
                    html: '<div class="alert alert-danger mb-0">' + errorMsg + '</div>',
                    icon: 'error'
                });
                submitBtn.prop('disabled', false).html(originalText);
            }
        });
    });
});
</script>
@endsection
