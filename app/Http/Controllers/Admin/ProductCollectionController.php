<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\ProductCollectionItem;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ProductCollectionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $collections = ProductCollection::with('products')->orderBy('sort_order')->get();

        return view('admin.product-collections.index', compact('collections'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $layouts = ProductCollection::LAYOUT_SELECT;
        $layoutIcons = ProductCollection::LAYOUT_ICONS;
        $products = Product::where('published', true)->orderBy('name')->get();

        return view('admin.product-collections.create', compact('layouts', 'layoutIcons', 'products'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_collections,slug',
            'description' => 'nullable|string',
            'layout_type' => 'required|string',
            'published' => 'boolean',
            'show_on_homepage' => 'boolean',
            'sort_order' => 'integer',
            'background_color' => 'nullable|string|max:20',
            'text_color' => 'nullable|string|max:20',
            'columns' => 'integer|min:1|max:6',
        ]);

        $validated['published'] = $request->has('published');
        $validated['show_on_homepage'] = $request->has('show_on_homepage');
        
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $collection = ProductCollection::create($validated);

        // Handle products
        if ($request->has('products')) {
            $this->syncProducts($collection, $request->input('products'));
        }

        return redirect()->route('admin.product-collections.index')
            ->with('message', 'Collection created successfully.');
    }

    public function edit(ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $layouts = ProductCollection::LAYOUT_SELECT;
        $layoutIcons = ProductCollection::LAYOUT_ICONS;
        $products = Product::where('published', true)->orderBy('name')->get();
        $productCollection->load('items.product');

        return view('admin.product-collections.edit', compact('productCollection', 'layouts', 'layoutIcons', 'products'));
    }

    public function update(Request $request, ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_collections,slug,' . $productCollection->id,
            'description' => 'nullable|string',
            'layout_type' => 'required|string',
            'published' => 'boolean',
            'show_on_homepage' => 'boolean',
            'sort_order' => 'integer',
            'background_color' => 'nullable|string|max:20',
            'text_color' => 'nullable|string|max:20',
            'columns' => 'integer|min:1|max:6',
        ]);

        $validated['published'] = $request->has('published');
        $validated['show_on_homepage'] = $request->has('show_on_homepage');

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $productCollection->update($validated);

        // Handle products
        if ($request->has('products')) {
            $this->syncProducts($productCollection, $request->input('products'));
        } else {
            $productCollection->items()->delete();
        }

        return redirect()->route('admin.product-collections.index')
            ->with('message', 'Collection updated successfully.');
    }

    public function destroy(ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCollection->items()->delete();
        $productCollection->delete();

        return redirect()->route('admin.product-collections.index')
            ->with('message', 'Collection deleted successfully.');
    }

    private function syncProducts(ProductCollection $collection, array $productIds)
    {
        // Delete existing items
        $collection->items()->delete();

        // Create new items
        foreach ($productIds as $index => $productId) {
            if (!empty($productId)) {
                ProductCollectionItem::create([
                    'product_collection_id' => $collection->id,
                    'product_id' => $productId,
                    'sort_order' => $index,
                    'is_featured' => false,
                ]);
            }
        }
    }

    public function updateOrder(Request $request, ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = $request->input('items', []);
        
        foreach ($items as $index => $itemId) {
            ProductCollectionItem::where('id', $itemId)
                ->where('product_collection_id', $productCollection->id)
                ->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function toggleFeatured(Request $request, ProductCollectionItem $item)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $item->update(['is_featured' => !$item->is_featured]);

        return response()->json(['success' => true, 'is_featured' => $item->is_featured]);
    }
}
