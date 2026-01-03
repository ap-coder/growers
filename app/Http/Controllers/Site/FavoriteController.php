<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Product $product)
    {
        $user = auth()->user();
        
        if ($user->hasFavorited($product)) {
            $user->favoriteProducts()->detach($product->id);
            $isFavorited = false;
        } else {
            $user->favoriteProducts()->attach($product->id);
            $isFavorited = true;
        }

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'isFavorited' => $isFavorited,
                'message' => $isFavorited ? 'Added to favorites' : 'Removed from favorites',
            ]);
        }

        return back()->with('success', $isFavorited ? 'Added to favorites' : 'Removed from favorites');
    }

    public function index()
    {
        $user = auth()->user();
        $favorites = $user->favoriteProducts()->paginate(12);
        
        return view('site.account.favorites', compact('favorites'));
    }
}
