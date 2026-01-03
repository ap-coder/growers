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
        
        return view('site.collections.show', compact('collection', 'products'));
    }
}
