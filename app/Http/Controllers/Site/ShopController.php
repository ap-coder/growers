<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $clientId = $user?->client_id;

        $query = Product::where('published', 1)
            ->where('product_type', 'standard');

        // Filter by client access (only if user has a client_id)
        if ($clientId) {
            $query->whereHas('clients', function ($q) use ($clientId) {
                $q->where('client_id', $clientId);
            });
        }
        // If no client_id, show products that either have no client restrictions OR are fake (for testing)
        elseif (!$clientId) {
            $query->where(function($q) {
                $q->whereDoesntHave('clients')
                  ->orWhere('is_fake', true);
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

        // Get featured products for sidebar
        $featuredQuery = Product::where('published', 1)
            ->where('featured', 1)
            ->where('product_type', 'standard');
        if ($clientId) {
            $featuredQuery->whereHas('clients', function ($q) use ($clientId) {
                $q->where('client_id', $clientId);
            });
        }
        $featuredProducts = $featuredQuery->limit(3)->get();

        // Get shop layout from settings
        $layout = Setting::get('shop_layout', 'standard');

        // Return JSON for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'html' => view('site.shop.partials.products-grid', compact('products', 'clientId'))->render(),
                'pagination' => $products->hasPages() ? view('site.shop.partials.pagination', compact('products'))->render() : '',
                'total' => $products->total(),
                'showing' => $products->count() > 0 ? "Showing {$products->firstItem()}–{$products->lastItem()} of {$products->total()} Results" : 'No products found',
            ]);
        }

        return view("site.shop.{$layout}", compact('products', 'categories', 'clientId', 'featuredProducts'));
    }

    public function show(Product $product)
    {
        $user = auth()->user();
        $clientId = $user?->client_id;

        // Check if product is published and user has access
        if (!$product->published) {
            abort(404);
        }

        if ($clientId && !$product->clients->contains('id', $clientId)) {
            abort(403, 'You do not have access to this product.');
        }

        // Check if product is in user's wishlist
        $inWishlist = false;
        if ($user) {
            $inWishlist = Wishlist::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->exists();
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

        return view("site.shop.product.{$layout}", compact('product', 'relatedProducts', 'clientId', 'inWishlist'));
    }
}
