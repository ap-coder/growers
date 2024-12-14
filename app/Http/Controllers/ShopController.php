<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the shop homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $client = auth()->user(); // or however you get the current client

        // Only get products that have a ClientPrice for this specific client
        $products = Product::whereHas('clientPrices', function($query) use ($client) {
            $query->where('client_id', $client->id);
        })->with('media')->paginate(12);

        return view('shop.index', compact('products'));
    }

    /**
     * Display the shopping cart.
     *
     * @return \Illuminate\View\View
     */
    public function cart()
    {
        return view('shop.cart');
    }

    /**
     * Display the checkout page.
     *
     * @return \Illuminate\View\View
     */
    public function checkout()
    {
        return view('shop.checkout');
    }
}
