<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Setting;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $clientId = $user->client_id;

        $query = Product::where('published', 1)
            ->where('product_type', 'standard');

        // Filter by client access
        if ($clientId) {
            $query->whereHas('clients', function ($q) use ($clientId) {
                $q->where('client_id', $clientId);
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('product_category_id', $request->category);
            });
        }

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->get('sort', 'name');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('base_price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('base_price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('name', 'asc');
        }

        $products = $query->paginate(12);
        $categories = ProductCategory::orderBy('name')->get();

        // Get shop layout from settings
        $layout = Setting::get('shop_layout', 'standard');

        return view("site.shop.{$layout}", compact('products', 'categories', 'clientId'));
    }

    public function show(Product $product)
    {
        $user = auth()->user();
        $clientId = $user->client_id;

        // Check if product is published and user has access
        if (!$product->published) {
            abort(404);
        }

        if ($clientId && !$product->clients->contains('id', $clientId)) {
            abort(403, 'You do not have access to this product.');
        }

        // Get product layout (use product-specific or default from settings)
        $layout = $product->layout ?: Setting::get('default_product_layout', 'default');

        // Get related products
        $relatedProducts = Product::where('published', 1)
            ->where('id', '!=', $product->id)
            ->where('product_type', 'standard')
            ->whereHas('categories', function ($q) use ($product) {
                $q->whereIn('product_category_id', $product->categories->pluck('id'));
            })
            ->limit(4)
            ->get();

        return view("site.shop.product.{$layout}", compact('product', 'relatedProducts', 'clientId'));
    }
}
