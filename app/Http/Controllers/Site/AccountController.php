<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ContentPage;
use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

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
    
    public function orderHistory()
    {
        $user = auth()->user();
        $clientId = $user->client_id ?? null;
        
        $orders = Order::where('client_id', $clientId)
            ->with('orderItems')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('site.account.order-history', compact('orders'));
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
    
    public function downloadInvoice($id)
    {
        $user = auth()->user();
        $clientId = $user->client_id ?? null;
        
        $order = Order::where('client_id', $clientId)
            ->with(['orderItems', 'orderItems.product', 'client'])
            ->findOrFail($id);
        
        $pdf = Pdf::loadView('site.invoices.invoice', compact('order'));
        
        return $pdf->download('invoice-' . $order->number . '.pdf');
    }
    
    public function howToOrder()
    {
        $user = auth()->user();
        $client = $user->client ?? null;
        $content = null;
        $contentSource = 'default';
        
        // Priority 1: Client-specific how_to_order_content field
        if ($client && !empty($client->how_to_order_content)) {
            $content = $client->how_to_order_content;
            $contentSource = 'client';
        }
        
        // Priority 2: Client-specific ContentPage
        if (!$content && $client) {
            $page = ContentPage::where('client_id', $client->id)
                ->where('page_type', 'how_to_order')
                ->where('published', true)
                ->first();
            if ($page) {
                $content = $page->page_text;
                $contentSource = 'client_page';
            }
        }
        
        // Priority 3: General ContentPage (no client_id)
        if (!$content) {
            $page = ContentPage::whereNull('client_id')
                ->where('page_type', 'how_to_order')
                ->where('published', true)
                ->first();
            if ($page) {
                $content = $page->page_text;
                $contentSource = 'general_page';
            }
        }
        
        // Priority 4: Default setting
        if (!$content) {
            $content = Setting::get('how_to_order_default', '');
            $contentSource = 'setting';
        }
        
        return view('site.pages.how-to-order', compact('content', 'contentSource', 'client'));
    }
    
    // Company Info
    public function company()
    {
        $user = auth()->user();
        $client = $user->client;
        
        if (!$client) {
            return redirect()->route('site.account.dashboard')
                ->with('error', 'No company associated with your account.');
        }
        
        return view('site.account.company', compact('client'));
    }
    
    public function updateCompany(Request $request)
    {
        $user = auth()->user();
        $client = $user->client;
        
        if (!$client) {
            return redirect()->route('site.account.dashboard')
                ->with('error', 'No company associated with your account.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'store_number' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $client->update($request->only([
            'name', 'store_number', 'address', 'contact_name', 'contact_phone', 'contact_email'
        ]));
        
        if ($request->hasFile('logo')) {
            $client->clearMediaCollection('logo');
            $client->addMediaFromRequest('logo')->toMediaCollection('logo');
        }
        
        return back()->with('success', 'Company information updated successfully.');
    }
    
    // Addresses
    public function addresses()
    {
        $user = auth()->user();
        $client = $user->client;
        
        if (!$client) {
            return redirect()->route('site.account.dashboard')
                ->with('error', 'No company associated with your account.');
        }
        
        $addresses = $client->addresses()->orderBy('address_type')->orderBy('is_primary', 'desc')->get();
        
        return view('site.account.addresses.index', compact('client', 'addresses'));
    }
    
    public function createAddress()
    {
        $user = auth()->user();
        $client = $user->client;
        
        if (!$client) {
            return redirect()->route('site.account.dashboard')
                ->with('error', 'No company associated with your account.');
        }
        
        $addressTypes = ClientAddress::TYPE_SELECT;
        
        return view('site.account.addresses.create', compact('client', 'addressTypes'));
    }
    
    public function storeAddress(Request $request)
    {
        $user = auth()->user();
        $client = $user->client;
        
        if (!$client) {
            return redirect()->route('site.account.dashboard')
                ->with('error', 'No company associated with your account.');
        }
        
        $request->validate([
            'address_type' => 'required|in:' . implode(',', array_keys(ClientAddress::TYPE_SELECT)),
            'label' => 'nullable|string|max:100',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:50',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:50',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'delivery_notes' => 'nullable|string|max:500',
            'is_primary' => 'nullable|boolean',
        ]);
        
        $data = $request->all();
        $data['client_id'] = $client->id;
        $data['country'] = $data['country'] ?? 'USA';
        $data['is_primary'] = $request->boolean('is_primary');
        
        // If setting as primary, unset other primaries of same type
        if ($data['is_primary']) {
            $client->addresses()
                ->where('address_type', $data['address_type'])
                ->update(['is_primary' => false]);
        }
        
        ClientAddress::create($data);
        
        return redirect()->route('site.account.addresses')
            ->with('success', 'Address added successfully.');
    }
    
    public function editAddress(ClientAddress $address)
    {
        $user = auth()->user();
        $client = $user->client;
        
        if (!$client || $address->client_id !== $client->id) {
            return redirect()->route('site.account.addresses')
                ->with('error', 'Address not found.');
        }
        
        $addressTypes = ClientAddress::TYPE_SELECT;
        
        return view('site.account.addresses.edit', compact('client', 'address', 'addressTypes'));
    }
    
    public function updateAddress(Request $request, ClientAddress $address)
    {
        $user = auth()->user();
        $client = $user->client;
        
        if (!$client || $address->client_id !== $client->id) {
            return redirect()->route('site.account.addresses')
                ->with('error', 'Address not found.');
        }
        
        $request->validate([
            'address_type' => 'required|in:' . implode(',', array_keys(ClientAddress::TYPE_SELECT)),
            'label' => 'nullable|string|max:100',
            'nickname' => 'nullable|string|max:100',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:50',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:50',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'delivery_notes' => 'nullable|string|max:500',
            'google_map_link' => 'nullable|url|max:500',
            'is_primary' => 'nullable|boolean',
        ]);
        
        $data = $request->all();
        $data['is_primary'] = $request->boolean('is_primary');
        
        // If setting as primary, unset other primaries of same type
        if ($data['is_primary'] && !$address->is_primary) {
            $client->addresses()
                ->where('address_type', $data['address_type'])
                ->where('id', '!=', $address->id)
                ->update(['is_primary' => false]);
        }
        
        $address->update($data);
        
        return redirect()->route('site.account.addresses')
            ->with('success', 'Address updated successfully.');
    }
    
    public function deleteAddress(ClientAddress $address)
    {
        $user = auth()->user();
        $client = $user->client;
        
        if (!$client || $address->client_id !== $client->id) {
            return redirect()->route('site.account.addresses')
                ->with('error', 'Address not found.');
        }
        
        $address->delete();
        
        return redirect()->route('site.account.addresses')
            ->with('success', 'Address deleted successfully.');
    }
    
    public function setPrimaryAddress(ClientAddress $address)
    {
        $user = auth()->user();
        $client = $user->client;
        
        if (!$client || $address->client_id !== $client->id) {
            return redirect()->route('site.account.addresses')
                ->with('error', 'Address not found.');
        }
        
        // Unset other primaries of same type
        $client->addresses()
            ->where('address_type', $address->address_type)
            ->update(['is_primary' => false]);
        
        $address->update(['is_primary' => true]);
        
        return redirect()->route('site.account.addresses')
            ->with('success', 'Primary address updated.');
    }
}
