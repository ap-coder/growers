<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Menu\Facades\Menu;
use App\Menu\Models\Menus;
use App\Menu\Models\MenuItems;
use App\Models\ProductCategory;
use App\Models\ContentPage;
use App\Models\FaqCategory;
use App\Models\Product;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('menu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $menulist = Menus::pluck('name', 'id')->toArray();
        
        $indmenu = null;
        $menus = null;
        $roles = null;
        $role_pk = config('menu.roles_pk', 'id');
        $role_title_field = config('menu.roles_title_field', 'name');
        
        if (request()->has('menu') && request()->input('menu') != 0) {
            $indmenu = Menus::find(request()->input('menu'));
            if ($indmenu) {
                $menuitems = new MenuItems();
                $menus = $menuitems->getall(request()->input('menu'));
            }
        }
        
        if (config('menu.use_roles')) {
            $rolesTable = config('menu.roles_table', 'roles');
            $roles = \DB::table($rolesTable)->get();
        }
        
        // Get linkable items for menu builder
        $productCategories = ProductCategory::orderBy('name')->get();
        $contentPages = ContentPage::where('published', true)->orderBy('title')->get();
        $faqCategories = FaqCategory::orderBy('category')->get();
        $products = Product::where('published', true)->orderBy('name')->get();
        
        return view('admin.menus.index', compact(
            'menulist', 'indmenu', 'menus', 'roles', 'role_pk', 'role_title_field',
            'productCategories', 'contentPages', 'faqCategories', 'products'
        ));
    }
}