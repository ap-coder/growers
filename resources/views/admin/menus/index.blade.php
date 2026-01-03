@extends('layouts.admin')
@section('content')
@php
$currentUrl = url()->current();
@endphp

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-bars mr-2"></i>Menu Builder</h5>
    </div>
    <div class="card-body">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="{{ asset('vendor/wecodelaravel-menu/style.css') }}" rel="stylesheet">
        <style>
            .accordion-section:not(.open) .accordion-section-content { display: none; }
            .accordion-section.open .accordion-section-content { display: block; }
            
            /* Override menu builder styles for AdminLTE form elements */
            #side-sortables .form-group { margin-bottom: 1rem; }
            #side-sortables .form-group label { display: block; margin-bottom: .5rem; font-weight: normal; }
            #side-sortables .form-control { 
                display: block; 
                width: 100%; 
                height: calc(2.25rem + 2px); 
                padding: .375rem .75rem; 
                font-size: 1rem; 
                line-height: 1.5; 
                color: #495057; 
                background-color: #fff; 
                background-clip: padding-box; 
                border: 1px solid #ced4da; 
                border-radius: .25rem; 
                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            }
            #side-sortables .form-control:focus {
                color: #495057;
                background-color: #fff;
                border-color: #80bdff;
                outline: 0;
                box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
            }
            #side-sortables select.form-control { height: calc(2.25rem + 2px); }
            #side-sortables .btn-primary { 
                color: #fff; 
                background-color: #007bff; 
                border-color: #007bff; 
            }
            #side-sortables .btn-sm {
                padding: .25rem .5rem;
                font-size: .875rem;
                line-height: 1.5;
                border-radius: .2rem;
            }
            #side-sortables .form-text { display: block; margin-top: .25rem; }
            
            /* Style accordion headers like AdminLTE card headers - high specificity */
            #menu-builder-wrap #side-sortables .control-section.accordion-section h3.accordion-section-title,
            #menu-builder-wrap .js .control-section.accordion-section h3.accordion-section-title,
            #menu-builder-wrap .js .control-section.accordion-section h3.accordion-section-title:hover,
            #menu-builder-wrap .js .control-section.accordion-section h3.accordion-section-title:focus {
                background-color: #6c757d !important;
                background: #6c757d !important;
                color: #fff !important;
                padding: 12px 40px 12px 15px !important;
                margin: 0 !important;
                font-size: 14px !important;
                font-weight: 600 !important;
                border: none !important;
                border-radius: 4px 4px 0 0 !important;
                display: block !important;
                line-height: 1.4 !important;
                position: relative !important;
                cursor: pointer;
            }
            #menu-builder-wrap #side-sortables .control-section.accordion-section h3.accordion-section-title:after {
                color: #fff !important;
                position: absolute !important;
                right: 15px !important;
                top: 50% !important;
                transform: translateY(-50%) !important;
                float: none !important;
            }
            #menu-builder-wrap #side-sortables .control-section.accordion-section {
                border: 1px solid #dee2e6 !important;
                border-radius: 4px !important;
                margin-bottom: 8px !important;
                background: #fff !important;
            }
            #side-sortables .accordion-section-content {
                padding: 15px;
                background: #fff;
                border-radius: 0 0 4px 4px;
            }
            #side-sortables .accordion-section .inside {
                padding: 0;
            }
            
            /* Main content full height */
            #menu-builder-wrap {
                min-height: calc(100vh - 200px);
            }
            #menu-builder-wrap #nav-menus-frame {
                min-height: calc(100vh - 300px);
            }
            #menu-builder-wrap #menu-management {
                min-height: calc(100vh - 350px);
                background: #fff;
            }
            #menu-builder-wrap #post-body {
                min-height: calc(100vh - 400px);
            }
        </style>
        
        <div id="menu-builder-wrap">
            <div class="menu-builder-admin menu-builder-ui menu-max-depth-0 nav-menus-php">
                <div id="menu-wrapper">
                    <div id="menu-content">
                        <div id="menu-body">
                            <div id="menu-body-content">
                                <div class="menu-wrap">
                                    <div class="manage-menus">
                                        <form method="get" action="{{ $currentUrl }}">
                                            <label for="menu" class="selected-menu">Select the menu you want to edit:</label>
                                            {!! \App\Menu\Facades\Menu::select('menu', $menulist) !!}
                                            <span class="submit-btn">
                                                <input type="submit" class="button-secondary" value="Choose">
                                            </span>
                                            <span class="add-new-menu-action"> or <a href="{{ $currentUrl }}?action=edit&menu=0">Create new menu</a>. </span>
                                        </form>
                                    </div>
                                    
                                    <div id="nav-menus-frame">
                                        @if(request()->has('menu') && !empty(request()->input("menu")))
                                        <div id="menu-settings-column" class="metabox-holder">
                                            <div class="clear"></div>
                                            <form id="nav-menu-meta" action="" class="nav-menu-meta" method="post" enctype="multipart/form-data">
                                                <div id="side-sortables" class="accordion-container">
                                                    <ul class="outer-border">
                                                        
                                                        <!-- Product Categories -->
                                                        <li class="control-section accordion-section add-page" id="add-product-categories">
                                                            <h3 class="accordion-section-title hndle" tabindex="0">Product Categories</h3>
                                                            <div class="accordion-section-content">
                                                                <div class="inside">
                                                                    <div class="categorydiv">
                                                                        <div class="form-group">
                                                                            <label for="category-select">Select Category</label>
                                                                            <select id="category-select" class="form-control">
                                                                                <option value="">-- Select --</option>
                                                                                @foreach($productCategories as $cat)
                                                                                <option value="/shop?category={{ $cat->id }}" data-label="{{ $cat->name }}">{{ $cat->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="category-label">Label</label>
                                                                            <input id="category-label" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="category-icon">Icon (optional)</label>
                                                                            <input id="category-icon" type="text" class="form-control" placeholder="fas fa-folder">
                                                                        </div>
                                                                        @if(!empty($roles))
                                                                        <div class="form-group">
                                                                            <label for="category-role">Restrict to Role (optional)</label>
                                                                            <select id="category-role" class="form-control">
                                                                                <option value="0">-- All Users --</option>
                                                                                @foreach($roles as $role)
                                                                                    <option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <button type="button" onclick="addFromSelect('category-select', 'category-label', 'category-icon', 'category-role')" class="btn btn-primary btn-sm">Add to Menu</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                        <!-- Products -->
                                                        <li class="control-section accordion-section add-page" id="add-products">
                                                            <h3 class="accordion-section-title hndle" tabindex="0">Products</h3>
                                                            <div class="accordion-section-content">
                                                                <div class="inside">
                                                                    <div class="productdiv">
                                                                        <div class="form-group">
                                                                            <label for="product-select">Select Product</label>
                                                                            <select id="product-select" class="form-control">
                                                                                <option value="">-- Select --</option>
                                                                                @foreach($products as $product)
                                                                                <option value="/shop/{{ $product->slug }}" data-label="{{ $product->name }}">{{ $product->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="product-label">Label</label>
                                                                            <input id="product-label" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="product-icon">Icon (optional)</label>
                                                                            <input id="product-icon" type="text" class="form-control" placeholder="fas fa-leaf">
                                                                        </div>
                                                                        @if(!empty($roles))
                                                                        <div class="form-group">
                                                                            <label for="product-role">Restrict to Role (optional)</label>
                                                                            <select id="product-role" class="form-control">
                                                                                <option value="0">-- All Users --</option>
                                                                                @foreach($roles as $role)
                                                                                    <option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <button type="button" onclick="addFromSelect('product-select', 'product-label', 'product-icon', 'product-role')" class="btn btn-primary btn-sm">Add to Menu</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                        <!-- Content Pages -->
                                                        <li class="control-section accordion-section add-page" id="add-pages">
                                                            <h3 class="accordion-section-title hndle" tabindex="0">Pages</h3>
                                                            <div class="accordion-section-content">
                                                                <div class="inside">
                                                                    <div class="pagediv">
                                                                        <div class="form-group">
                                                                            <label for="page-select">Select Page</label>
                                                                            <select id="page-select" class="form-control">
                                                                                <option value="">-- Select --</option>
                                                                                @foreach($contentPages as $page)
                                                                                <option value="/{{ $page->slug }}" data-label="{{ $page->title }}">{{ $page->title }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="page-label">Label</label>
                                                                            <input id="page-label" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="page-icon">Icon (optional)</label>
                                                                            <input id="page-icon" type="text" class="form-control" placeholder="fas fa-file">
                                                                        </div>
                                                                        @if(!empty($roles))
                                                                        <div class="form-group">
                                                                            <label for="page-role">Restrict to Role (optional)</label>
                                                                            <select id="page-role" class="form-control">
                                                                                <option value="0">-- All Users --</option>
                                                                                @foreach($roles as $role)
                                                                                    <option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <button type="button" onclick="addFromSelect('page-select', 'page-label', 'page-icon', 'page-role')" class="btn btn-primary btn-sm">Add to Menu</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                        <!-- FAQ Categories -->
                                                        <li class="control-section accordion-section add-page" id="add-faqs">
                                                            <h3 class="accordion-section-title hndle" tabindex="0">FAQ Categories</h3>
                                                            <div class="accordion-section-content">
                                                                <div class="inside">
                                                                    <div class="faqdiv">
                                                                        <div class="form-group">
                                                                            <label for="faq-select">Select FAQ Category</label>
                                                                            <select id="faq-select" class="form-control">
                                                                                <option value="">-- Select --</option>
                                                                                @foreach($faqCategories as $faq)
                                                                                <option value="/faq#{{ Str::slug($faq->category) }}" data-label="{{ $faq->category }}">{{ $faq->category }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="faq-label">Label</label>
                                                                            <input id="faq-label" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="faq-icon">Icon (optional)</label>
                                                                            <input id="faq-icon" type="text" class="form-control" placeholder="fas fa-question-circle">
                                                                        </div>
                                                                        @if(!empty($roles))
                                                                        <div class="form-group">
                                                                            <label for="faq-role">Restrict to Role (optional)</label>
                                                                            <select id="faq-role" class="form-control">
                                                                                <option value="0">-- All Users --</option>
                                                                                @foreach($roles as $role)
                                                                                    <option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <button type="button" onclick="addFromSelect('faq-select', 'faq-label', 'faq-icon', 'faq-role')" class="btn btn-primary btn-sm">Add to Menu</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                        <!-- FAQ Questions -->
                                                        <li class="control-section accordion-section add-page" id="add-faq-questions">
                                                            <h3 class="accordion-section-title hndle" tabindex="0">FAQ Questions</h3>
                                                            <div class="accordion-section-content">
                                                                <div class="inside">
                                                                    <div class="faqquestiondiv">
                                                                        <div class="form-group">
                                                                            <label for="faq-question-select">Select FAQ Question</label>
                                                                            <select id="faq-question-select" class="form-control">
                                                                                <option value="">-- Select --</option>
                                                                                @foreach($faqQuestions as $question)
                                                                                <option value="/faq#question-{{ $question->id }}" data-label="{{ Str::limit($question->question, 50) }}">{{ Str::limit($question->question, 60) }} ({{ $question->category->category ?? 'No Category' }})</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="faq-question-label">Label</label>
                                                                            <input id="faq-question-label" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="faq-question-icon">Icon (optional)</label>
                                                                            <input id="faq-question-icon" type="text" class="form-control" placeholder="fas fa-question">
                                                                        </div>
                                                                        @if(!empty($roles))
                                                                        <div class="form-group">
                                                                            <label for="faq-question-role">Restrict to Role (optional)</label>
                                                                            <select id="faq-question-role" class="form-control">
                                                                                <option value="0">-- All Users --</option>
                                                                                @foreach($roles as $role)
                                                                                    <option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <button type="button" onclick="addFromSelect('faq-question-select', 'faq-question-label', 'faq-question-icon', 'faq-question-role')" class="btn btn-primary btn-sm">Add to Menu</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                        <!-- Product Collections -->
                                                        <li class="control-section accordion-section add-page" id="add-collections">
                                                            <h3 class="accordion-section-title hndle" tabindex="0">Product Collections</h3>
                                                            <div class="accordion-section-content">
                                                                <div class="inside">
                                                                    <div class="collectiondiv">
                                                                        <div class="form-group">
                                                                            <label for="collection-select">Select Collection</label>
                                                                            <select id="collection-select" class="form-control">
                                                                                <option value="">-- Select --</option>
                                                                                @foreach($productCollections as $collection)
                                                                                <option value="/collections/{{ $collection->slug }}" data-label="{{ $collection->name }}">{{ $collection->name }} ({{ $collection->layout_name }})</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="collection-label">Label</label>
                                                                            <input id="collection-label" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="collection-icon">Icon (optional)</label>
                                                                            <input id="collection-icon" type="text" class="form-control" placeholder="fas fa-th-large">
                                                                        </div>
                                                                        @if(!empty($roles))
                                                                        <div class="form-group">
                                                                            <label for="collection-role">Restrict to Role (optional)</label>
                                                                            <select id="collection-role" class="form-control">
                                                                                <option value="0">-- All Users --</option>
                                                                                @foreach($roles as $role)
                                                                                    <option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <button type="button" onclick="addFromSelect('collection-select', 'collection-label', 'collection-icon', 'collection-role')" class="btn btn-primary btn-sm">Add to Menu</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                        <!-- Custom Link -->
                                                        <li class="control-section accordion-section add-page" id="add-page">
                                                            <h3 class="accordion-section-title hndle" tabindex="0">Custom Link</h3>
                                                            <div class="accordion-section-content">
                                                                <div class="inside">
                                                                    <div class="customlinkdiv" id="customlinkdiv">
                                                                        <div class="form-group">
                                                                            <label for="custom-menu-item-url">URL</label>
                                                                            <input id="custom-menu-item-url" name="url" type="text" class="form-control" placeholder="/shop">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="custom-menu-item-name">Label</label>
                                                                            <input id="custom-menu-item-name" name="label" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="custom-menu-item-icon">Icon (optional)</label>
                                                                            <input id="custom-menu-item-icon" name="icon" type="text" class="form-control" placeholder="fas fa-home">
                                                                            <small class="form-text text-muted">FontAwesome class (e.g., fas fa-leaf)</small>
                                                                        </div>
                                                                        @if(!empty($roles))
                                                                        <div class="form-group">
                                                                            <label for="custom-menu-item-role">Restrict to Role (optional)</label>
                                                                            <select id="custom-menu-item-role" name="role" class="form-control">
                                                                                <option value="0">-- All Users --</option>
                                                                                @foreach($roles as $role)
                                                                                    <option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <small class="form-text text-muted">Only show to users with this role</small>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <button type="button" onclick="addcustommenu()" class="btn btn-primary btn-sm">Add to Menu</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                        <!-- Separator / Divider -->
                                                        <li class="control-section accordion-section add-page" id="add-separator">
                                                            <h3 class="accordion-section-title hndle" tabindex="0">Separator / Divider</h3>
                                                            <div class="accordion-section-content">
                                                                <div class="inside">
                                                                    <div class="separatordiv">
                                                                        <div class="form-group">
                                                                            <label for="separator-type">Type</label>
                                                                            <select id="separator-type" class="form-control">
                                                                                <option value="separator">Separator (labeled section header)</option>
                                                                                <option value="divider-h">Divider | (horizontal menus)</option>
                                                                                <option value="divider-v">Divider ─ (vertical menus)</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group" id="separator-label-group">
                                                                            <label for="separator-label">Label (optional)</label>
                                                                            <input id="separator-label" name="separator_label" type="text" class="form-control" placeholder="e.g., ACCOUNT SETTINGS">
                                                                            <small class="form-text text-muted">Leave blank for unlabeled separator</small>
                                                                        </div>
                                                                        @if(!empty($roles))
                                                                        <div class="form-group">
                                                                            <label for="separator-role">Restrict to Role (optional)</label>
                                                                            <select id="separator-role" class="form-control">
                                                                                <option value="0">-- All Users --</option>
                                                                                @foreach($roles as $role)
                                                                                    <option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <small class="form-text text-muted">Only show to users with this role</small>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <button type="button" onclick="addSeparator()" class="btn btn-primary btn-sm">Add to Menu</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                            </form>
                                        </div>
                                        @endif
                                        
                                        <div id="menu-management-liquid">
                                            <div id="menu-management">
                                                <form id="update-nav-menu" action="" method="post" enctype="multipart/form-data">
                                                    <div class="menu-edit">
                                                        <div id="nav-menu-header">
                                                            <div class="major-publishing-actions">
                                                                <label class="menu-name-label howto open-label" for="menu-name">
                                                                    <span>Name</span>
                                                                    <input name="menu-name" id="menu-name" type="text" class="menu-name regular-text menu-item-textbox" title="Enter menu name" value="@if(isset($indmenu)){{ $indmenu->name }}@endif">
                                                                    <input type="hidden" id="idmenu" value="@if(isset($indmenu)){{ $indmenu->id }}@endif" />
                                                                </label>
                                                                @if(request()->has('action'))
                                                                <div class="publishing-action">
                                                                    <a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
                                                                </div>
                                                                @elseif(request()->has("menu"))
                                                                <div class="publishing-action">
                                                                    <a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Save menu</a>
                                                                    <span class="spinner" id="spincustomu2"></span>
                                                                </div>
                                                                @else
                                                                <div class="publishing-action">
                                                                    <a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div id="post-body">
                                                            <div id="post-body-content">
                                                                @if(request()->has("menu"))
                                                                <h3>Menu Structure</h3>
                                                                <div class="drag-instructions post-body-plain">
                                                                    <p>Drag items to reorder. Click the arrow to expand item settings.</p>
                                                                </div>
                                                                @else
                                                                <h3>Menu Creation</h3>
                                                                <div class="drag-instructions post-body-plain">
                                                                    <p>Enter a name and click "Create menu"</p>
                                                                </div>
                                                                @endif
                                                                
                                                                <ul class="menu ui-sortable" id="menu-to-edit">
                                                                    @if(isset($menus))
                                                                    @foreach($menus as $m)
                                                                    <li id="menu-item-{{ $m->id }}" class="menu-item menu-item-depth-{{ $m->depth }} menu-item-page menu-item-edit-inactive pending" style="display: list-item;">
                                                                        <dl class="menu-item-bar">
                                                                            <dt class="menu-item-handle">
                                                                                <span class="item-title">
                                                                                    <span class="menu-item-title">
                                                                                        @if($m->menu_icon_class)<i class="{{ $m->menu_icon_class }} mr-1"></i>@endif
                                                                                        <span id="menutitletemp_{{ $m->id }}">{{ $m->label }}</span>
                                                                                        <span style="color: transparent;">|{{ $m->id }}|</span>
                                                                                    </span>
                                                                                    <span class="is-submenu" style="@if($m->depth==0)display: none;@endif">Sub-item</span>
                                                                                </span>
                                                                                <span class="item-controls">
                                                                                    <span class="item-type">Link</span>
                                                                                    <a class="item-edit" id="edit-{{ $m->id }}" title="Edit" href="{{ $currentUrl }}?edit-menu-item={{ $m->id }}#menu-item-settings-{{ $m->id }}"></a>
                                                                                </span>
                                                                            </dt>
                                                                        </dl>
                                                                        <div class="menu-item-settings" id="menu-item-settings-{{ $m->id }}">
                                                                            <input type="hidden" class="edit-menu-item-id" name="menuid_{{ $m->id }}" value="{{ $m->id }}" />
                                                                            <p class="description description-thin">
                                                                                <label for="edit-menu-item-title-{{ $m->id }}">Label<br>
                                                                                    <input type="text" id="idlabelmenu_{{ $m->id }}" class="widefat edit-menu-item-title" name="idlabelmenu_{{ $m->id }}" value="{{ $m->label }}">
                                                                                </label>
                                                                            </p>
                                                                            <p class="field-css-classes description description-thin">
                                                                                <label for="edit-menu-item-classes-{{ $m->id }}">CSS Class (optional)<br>
                                                                                    <input type="text" id="clases_menu_{{ $m->id }}" class="widefat code edit-menu-item-classes" name="clases_menu_{{ $m->id }}" value="{{ $m->class }}">
                                                                                </label>
                                                                            </p>
                                                                            <p class="field-css-url description description-wide">
                                                                                <label for="edit-menu-item-url-{{ $m->id }}">URL<br>
                                                                                    <input type="text" id="url_menu_{{ $m->id }}" class="widefat code edit-menu-item-url" value="{{ $m->link }}">
                                                                                </label>
                                                                            </p>
                                                                            <p class="field-icon description description-wide">
                                                                                <label for="edit-menu-item-icon-{{ $m->id }}">Icon (FontAwesome)<br>
                                                                                    <input type="text" id="icon_menu_{{ $m->id }}" class="widefat code edit-menu-item-icon" name="icon_menu_{{ $m->id }}" value="{{ $m->menu_icon_class }}" placeholder="fas fa-home">
                                                                                </label>
                                                                            </p>
                                                                            <p class="field-icon-only description description-wide">
                                                                                <label for="edit-menu-item-icon-only-{{ $m->id }}">
                                                                                    <input type="checkbox" id="icon_only_{{ $m->id }}" class="edit-menu-item-icon-only" name="icon_only_{{ $m->id }}" value="1" {{ $m->icon_only_menu ? 'checked' : '' }}>
                                                                                    Icon Only (hide label)
                                                                                </label>
                                                                            </p>
                                                                            @if(!empty($roles))
                                                                            <p class="field-role description description-wide">
                                                                                <label for="edit-menu-item-role-{{ $m->id }}">Restrict to Role<br>
                                                                                    <select id="role_menu_{{ $m->id }}" class="widefat code edit-menu-item-role" name="role_menu_{{ $m->id }}">
                                                                                        <option value="0">-- All Users --</option>
                                                                                        @foreach($roles as $role)
                                                                                            <option value="{{ $role->$role_pk }}" {{ ($m->role_id ?? 0) == $role->$role_pk ? 'selected' : '' }}>{{ ucfirst($role->$role_title_field) }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </label>
                                                                            </p>
                                                                            @endif
                                                                            <div class="menu-item-actions description-wide submitbox">
                                                                                <a class="item-delete submitdelete deletion" id="delete-{{ $m->id }}" href="{{ $currentUrl }}?action=delete-menu-item&menu-item={{ $m->id }}">Delete</a>
                                                                                <span class="meta-sep hide-if-no-js"> | </span>
                                                                                <a class="item-cancel submitcancel hide-if-no-js button-secondary" id="cancel-{{ $m->id }}" href="{{ $currentUrl }}?edit-menu-item={{ $m->id }}&cancel=1#menu-item-settings-{{ $m->id }}">Cancel</a>
                                                                                <span class="meta-sep hide-if-no-js"> | </span>
                                                                                <a onclick="getmenus()" class="button button-primary updatemenu" id="update-{{ $m->id }}" href="javascript:void(0)">Save</a>
                                                                            </div>
                                                                        </div>
                                                                        <ul class="menu-item-transport"></ul>
                                                                    </li>
                                                                    @endforeach
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div id="nav-menu-footer">
                                                            <div class="major-publishing-actions">
                                                                @if(request()->has('action'))
                                                                <div class="publishing-action">
                                                                    <a onclick="createnewmenu()" name="save_menu" class="button button-primary menu-save">Create menu</a>
                                                                </div>
                                                                @elseif(request()->has("menu"))
                                                                <span class="delete-action">
                                                                    <a class="submitdelete deletion menu-delete" onclick="deletemenu()" href="javascript:void(0)">Delete menu</a>
                                                                </span>
                                                                <div class="publishing-action">
                                                                    <a onclick="getmenus()" name="save_menu" class="button button-primary menu-save">Save menu</a>
                                                                </div>
                                                                @else
                                                                <div class="publishing-action">
                                                                    <a onclick="createnewmenu()" name="save_menu" class="button button-primary menu-save">Create menu</a>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    var menus = {
        "oneThemeLocationNoMenus" : "",
        "moveUp" : "Move up",
        "moveDown" : "Move down",
        "moveToTop" : "Move top",
        "moveUnder" : "Move under of %s",
        "moveOutFrom" : "Out from under %s",
        "under" : "Under %s",
        "outFrom" : "Out from %s",
        "menuFocus" : "%1$s. Element menu %2$d of %3$d.",
        "subMenuFocus" : "%1$s. Menu of subelement %2$d of %3$s."
    };
    var arraydata = [];
    var addcustommenur = '{{ route("haddcustommenu") }}';
    var updateitemr = '{{ route("hupdateitem") }}';
    var generatemenucontrolr = '{{ route("hgeneratemenucontrol") }}';
    var deleteitemmenur = '{{ route("hdeleteitemmenu") }}';
    var deletemenugr = '{{ route("hdeletemenug") }}';
    var createnewmenur = '{{ route("hcreatenewmenu") }}';
    var csrftoken = "{{ csrf_token() }}";
    var menuwr = "{{ url()->current() }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrftoken
        }
    });
</script>
<script src="{{ asset('vendor/wecodelaravel-menu/scripts.js') }}"></script>
<script src="{{ asset('vendor/wecodelaravel-menu/scripts2.js') }}"></script>
<script src="{{ asset('vendor/wecodelaravel-menu/menu.js') }}"></script>
<script>
$(document).ready(function() {
    // Handle select change to auto-fill label
    $('#category-select, #product-select, #page-select, #faq-select, #collection-select').on('change', function() {
        var label = $(this).find(':selected').data('label') || '';
        var labelInputId = $(this).attr('id').replace('-select', '-label');
        $('#' + labelInputId).val(label);
    });
    
    // Toggle accordion sections - bind directly to the h3 elements
    $('#side-sortables .accordion-section-title').each(function() {
        $(this).off('click').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $section = $(this).parent('.accordion-section');
            $section.toggleClass('open');
            
            return false;
        });
    });
    
    // Reopen the section that was used to add an item
    var openSection = localStorage.getItem('menuBuilderOpenSection');
    if (openSection) {
        $('#' + openSection).addClass('open');
        localStorage.removeItem('menuBuilderOpenSection');
    }
    
    // Show/hide label field based on separator type
    $('#separator-type').on('change', function() {
        var type = $(this).val();
        if (type === 'separator') {
            $('#separator-label-group').show();
        } else {
            $('#separator-label-group').hide();
            $('#separator-label').val('');
        }
    });
});

// Add selected items from checkboxes
function addSelectedItems(type) {
    var section = $('#add-' + type);
    var checkboxes = section.find('.menu-item-checkbox:checked');
    
    if (checkboxes.length === 0) {
        alert('Please select at least one item');
        return;
    }
    
    var itemsToAdd = [];
    checkboxes.each(function() {
        itemsToAdd.push({
            label: $(this).data('label'),
            url: $(this).data('url')
        });
    });
    
    // Add items sequentially via AJAX, then reload once at the end
    var index = 0;
    function addNextItem() {
        if (index < itemsToAdd.length) {
            var item = itemsToAdd[index];
            $.ajax({
                data: {
                    labelmenu: item.label,
                    linkmenu: item.url,
                    iconmenu: '',
                    rolemenu: '',
                    idmenu: $('#idmenu').val()
                },
                url: addcustommenur,
                type: 'POST',
                success: function() {
                    index++;
                    addNextItem();
                },
                error: function() {
                    alert('Error adding item: ' + item.label);
                    index++;
                    addNextItem();
                }
            });
        } else {
            // All items added, reload page
            window.location.reload();
        }
    }
    addNextItem();
}

// Add separator/divider to menu
function addSeparator() {
    var type = $('#separator-type').val();
    var label = $('#separator-label').val() || '';
    var role = $('#separator-role').length ? $('#separator-role').val() : 0;
    var url, displayLabel;
    
    if (type === 'divider-h') {
        // Horizontal divider (pipe character for horizontal menus)
        url = '#divider-h';
        displayLabel = '|';
    } else if (type === 'divider-v') {
        // Vertical divider (hr line for vertical menus)
        url = '#divider-v';
        displayLabel = '───';
    } else {
        // Separator (labeled section header)
        url = '#separator';
        displayLabel = label || '---';
    }
    
    // Store which section was used
    localStorage.setItem('menuBuilderOpenSection', 'add-separator');
    
    $.ajax({
        data: {
            labelmenu: displayLabel,
            linkmenu: url,
            iconmenu: '',
            rolemenu: role,
            idmenu: $('#idmenu').val()
        },
        url: addcustommenur,
        type: 'POST',
        success: function() {
            window.location.reload();
        },
        error: function(xhr, status, error) {
            alert('Error adding separator: ' + error);
        }
    });
    
    // Reset form
    $('#separator-label').val('');
    $('#separator-type').val('separator');
    if ($('#separator-role').length) $('#separator-role').val('0');
}

// Update label input when select changes
function updateLabelFromSelect(selectEl, labelId) {
    var selected = $(selectEl).find(':selected');
    var label = selected.data('label') || '';
    $('#' + labelId).val(label);
}

// Add item from select dropdown
function addFromSelect(selectId, labelId, iconId, roleId) {
    var url = $('#' + selectId).val();
    var label = $('#' + labelId).val();
    var icon = $('#' + iconId).val();
    var role = roleId && $('#' + roleId).length ? $('#' + roleId).val() : 0;
    
    if (!url) {
        alert('Please select an item');
        return;
    }
    
    if (!label) {
        alert('Please enter a label');
        return;
    }
    
    // Store which section was used
    var sectionId = $('#' + selectId).closest('.accordion-section').attr('id');
    if (sectionId) {
        localStorage.setItem('menuBuilderOpenSection', sectionId);
    }
    
    $.ajax({
        data: {
            labelmenu: label,
            linkmenu: url,
            iconmenu: icon,
            rolemenu: role,
            idmenu: $('#idmenu').val()
        },
        url: addcustommenur,
        type: 'POST',
        success: function() {
            window.location.reload();
        },
        error: function(xhr, status, error) {
            alert('Error adding item: ' + error);
        }
    });
}
</script>
@endsection