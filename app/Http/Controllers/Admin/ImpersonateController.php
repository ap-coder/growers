<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ImpersonateController extends Controller
{
    public function start(Request $request, User $user)
    {
        $currentUser = Auth::user();
        
        if (!$currentUser->isWclDeveloper) {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden - Only WCL Developers can impersonate users');
        }
        
        if ($user->id === $currentUser->id) {
            return redirect()->back()->with('error', 'You cannot impersonate yourself.');
        }
        
        session(['impersonate_user_id' => $user->id]);
        session(['impersonate_original_user_id' => $currentUser->id]);
        
        return redirect()->route('site.account.dashboard')
            ->with('success', "Now viewing as: {$user->name} ({$user->email})");
    }
    
    public function stop()
    {
        if (!session()->has('impersonate_user_id')) {
            return redirect()->route('admin.home');
        }
        
        session()->forget('impersonate_user_id');
        session()->forget('impersonate_original_user_id');
        
        return redirect()->route('admin.home')
            ->with('success', 'Stopped impersonating user.');
    }
    
    public function getUsersForSelect()
    {
        $currentUser = Auth::user();
        
        if (!$currentUser->isWclDeveloper && !session()->has('impersonate_original_user_id')) {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        
        $users = User::with('client')
            ->where('id', '!=', session('impersonate_original_user_id', $currentUser->id))
            ->orderBy('name')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'client_name' => $user->client?->name ?? 'No Client',
                ];
            });
        
        return response()->json($users);
    }
}
