<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ContentPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $clientId = $user->client_id ?? null;
        
        $totalOrders = Order::where('client_id', $clientId)->count();
        $pendingOrders = Order::where('client_id', $clientId)->where('status', 'pending')->count();
        $completedOrders = Order::where('client_id', $clientId)->where('status', 'completed')->count();
        $recentOrders = Order::where('client_id', $clientId)
            ->with('orderItems')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('site.account.dashboard', compact('totalOrders', 'pendingOrders', 'completedOrders', 'recentOrders'));
    }
    
    public function profile()
    {
        return view('site.account.profile');
    }
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
        ]);
        
        $user = auth()->user();
        $user->update($request->only(['name', 'email', 'phone']));
        
        return back()->with('success', 'Profile updated successfully.');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $user = auth()->user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        
        $user->update(['password' => Hash::make($request->password)]);
        
        return back()->with('success', 'Password changed successfully.');
    }
    
    public function orders()
    {
        $user = auth()->user();
        $clientId = $user->client_id ?? null;
        
        $orders = Order::where('client_id', $clientId)
            ->with('orderItems')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('site.account.orders', compact('orders'));
    }
    
    public function orderShow($id)
    {
        $user = auth()->user();
        $clientId = $user->client_id ?? null;
        
        $order = Order::where('client_id', $clientId)
            ->with(['orderItems', 'orderItems.product', 'client'])
            ->findOrFail($id);
        
        return view('site.account.order-details', compact('order'));
    }
    
    public function howToOrder()
    {
        $user = auth()->user();
        $clientId = $user->client_id ?? null;
        
        // Try to find client-specific "how to order" page first
        $page = null;
        if ($clientId) {
            $page = ContentPage::where('client_id', $clientId)
                ->where('page_type', 'how_to_order')
                ->where('published', true)
                ->first();
        }
        
        // Fall back to general "how to order" page
        if (!$page) {
            $page = ContentPage::whereNull('client_id')
                ->where('page_type', 'how_to_order')
                ->where('published', true)
                ->first();
        }
        
        return view('site.pages.how-to-order', compact('page'));
    }
}
