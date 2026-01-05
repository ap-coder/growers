<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart
     */
    public function index()
    {
        $cart = $this->getCart();
        return view('site.cart.index', compact('cart'));
    }

    /**
     * Add item(s) to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variations' => 'required|array',
            'variations.*.variation_id' => 'required|exists:product_variations,id',
            'variations.*.quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $sessionId = session()->getId();

        foreach ($request->variations as $variationData) {
            if ($variationData['quantity'] > 0) {
                $variation = ProductVariation::find($variationData['variation_id']);
                
                // Get client-specific price if user is logged in
                $clientId = Auth::check() ? Auth::user()->client_id : null;
                $price = $variation->getPriceForClient($clientId);

                // Check if item already exists in cart
                $cartItem = Cart::where('product_id', $request->product_id)
                    ->where('variation_id', $variationData['variation_id'])
                    ->when($userId, fn($q) => $q->where('user_id', $userId))
                    ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
                    ->first();

                if ($cartItem) {
                    // Update quantity
                    $cartItem->quantity += $variationData['quantity'];
                    $cartItem->save();
                } else {
                    // Create new cart item
                    Cart::create([
                        'user_id' => $userId,
                        'session_id' => $sessionId,
                        'product_id' => $request->product_id,
                        'variation_id' => $variationData['variation_id'],
                        'quantity' => $variationData['quantity'],
                        'price' => $price,
                        'sku' => $variation->sku,
                        'variation_name' => $variation->name,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Items added to cart',
            'cart_count' => $this->getCartCount()
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $userId = Auth::id();
        $sessionId = session()->getId();

        $cartItem = Cart::where('id', $request->cart_id)
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->first();

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }

        if ($request->quantity == 0) {
            $cartItem->delete();
        } else {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'cart_count' => $this->getCartCount()
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove($cartId)
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        $cartItem = Cart::where('id', $cartId)
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }

    /**
     * Remove all items of a product from cart
     */
    public function removeProduct($productId)
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        Cart::where('product_id', $productId)
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart');
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        Cart::when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared');
    }

    /**
     * Get cart items
     */
    protected function getCart()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        return Cart::with(['product', 'variation'])
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->get()
            ->groupBy('product_id');
    }

    /**
     * Get cart item count
     */
    protected function getCartCount()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        return Cart::when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->sum('quantity');
    }

    /**
     * Transfer guest cart to user cart on login
     */
    public static function transferGuestCart($userId, $sessionId)
    {
        $guestCartItems = Cart::where('session_id', $sessionId)->get();

        foreach ($guestCartItems as $guestItem) {
            $existingItem = Cart::where('user_id', $userId)
                ->where('product_id', $guestItem->product_id)
                ->where('variation_id', $guestItem->variation_id)
                ->first();

            if ($existingItem) {
                $existingItem->quantity += $guestItem->quantity;
                $existingItem->save();
                $guestItem->delete();
            } else {
                $guestItem->user_id = $userId;
                $guestItem->session_id = null;
                $guestItem->save();
            }
        }
    }
}
