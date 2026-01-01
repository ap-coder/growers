<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::active()->orderBy('created_at', 'desc')->get();
        
        return view('admin.reminders.index', compact('reminders'));
    }

    public function dismiss(Reminder $reminder)
    {
        $reminder->dismiss();
        
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        
        return back()->with('message', 'Reminder dismissed.');
    }

    public function dismissAll()
    {
        Reminder::active()->update([
            'dismissed' => true,
            'dismissed_by' => auth()->id(),
            'dismissed_at' => now(),
        ]);
        
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        
        return back()->with('message', 'All reminders dismissed.');
    }

    public function getActive()
    {
        $reminders = Reminder::active()
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($reminder) {
                return [
                    'id' => $reminder->id,
                    'title' => $reminder->title,
                    'message' => $reminder->message,
                    'type' => $reminder->type,
                    'link' => $reminder->link,
                    'link_text' => $reminder->link_text ?? 'View',
                ];
            });
        
        return response()->json($reminders);
    }
}
