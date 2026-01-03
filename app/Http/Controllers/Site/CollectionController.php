<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ProductCollection;

class CollectionController extends Controller
{
    public function show($slug)
    {
        $collection = ProductCollection::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();
        
        $products = $collection->products()
            ->where('published', true)
            ->get();
        
        // Use layout-specific view if it exists, otherwise fall back to default
        $layoutView = 'site.collections.layouts.' . $collection->layout_type;
        
        if (view()->exists($layoutView)) {
            return view($layoutView, compact('collection', 'products'));
        }
        
        return view('site.collections.show', compact('collection', 'products'));
    }
    
    public function index()
    {
        $collections = ProductCollection::where('published', true)
            ->orderBy('sort_order')
            ->get();
        
        return view('site.collections.index', compact('collections'));
    }
    
    /**
     * Print-friendly catalog view for downloading/printing
     */
    public function catalog($slug)
    {
        $collection = ProductCollection::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();
        
        $products = $collection->products()
            ->where('published', true)
            ->get();
        
        return view('site.collections.catalog', compact('collection', 'products'));
    }
}
