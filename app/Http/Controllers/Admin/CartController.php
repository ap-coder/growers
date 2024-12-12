<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems; // Assuming the Cart is linked to the user
        return view('cart.index', compact('cartItems'));
    }

    public function addProduct(Request $request, Product $product)
    {
        $cartItem = Cart::updateOrCreate(
            ['product_id' => $product->id, 'user_id' => auth()->id()],
            ['quantity' => \DB::raw('quantity + 1')]
        );
        return redirect()->route('cart.index');
    }

    public function removeProduct(Cart $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index');
    }

    public function updateQuantity(Request $request, Cart $cartItem)
    {
        $cartItem->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cartItems = auth()->user()->cartItems;
        // Pass cart items to checkout page for order creation
        return view('checkout.index', compact('cartItems'));
    }

    public function placeOrder()
    {
        $user = auth()->user();
        $cartItems = $user->cartItems;

        // Ensure cart is not empty before placing an order
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->withErrors('Your cart is empty.');
        }

        // Create a new order
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending', // Set initial order status
            'shipping_cost' => 0, // You can add logic to calculate shipping cost
            'order_total' => $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            }),
            'total_price' => $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            })
        ]);

        // Transfer cart items to order items
        foreach ($cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'price' => $cartItem->product->price,
                'quantity' => $cartItem->quantity,
                'total_price' => $cartItem->product->price * $cartItem->quantity
            ]);
        }

        // Clear the cart after creating the order
        $user->cartItems()->delete();

        return redirect()->route('order.show', $order->id);
    }

}

