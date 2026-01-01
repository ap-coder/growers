<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\QaTopic;
use App\Models\QaMessage;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $topics = QaTopic::where(function ($query) {
            $query->where('creator_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
        })
        ->orderBy('created_at', 'DESC')
        ->get();

        $unreadCount = $this->getUnreadCount();

        return view('site.account.messages.index', compact('topics', 'unreadCount'));
    }

    public function create()
    {
        // Get admin users to send messages to
        $admins = User::whereHas('roles', function($q) {
            $q->where('title', 'Admin')->orWhere('title', 'WCL-Developer');
        })->get();

        return view('site.account.messages.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Find an admin to send to (first available admin)
        $admin = User::whereHas('roles', function($q) {
            $q->where('title', 'Admin');
        })->first();

        if (!$admin) {
            return back()->with('error', 'Unable to send message. Please try again later.');
        }

        $topic = QaTopic::create([
            'subject' => $request->input('subject'),
            'creator_id' => Auth::id(),
            'receiver_id' => $admin->id,
        ]);

        $topic->messages()->create([
            'sender_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('site.account.messages.index')
            ->with('success', 'Message sent successfully!');
    }

    public function show(QaTopic $topic)
    {
        $this->checkAccessRights($topic);

        // Mark messages as read
        foreach ($topic->messages as $message) {
            if ($message->sender_id !== Auth::id() && $message->read_at === null) {
                $message->read_at = Carbon::now();
                $message->save();
            }
        }

        return view('site.account.messages.show', compact('topic'));
    }

    public function reply(Request $request, QaTopic $topic)
    {
        $this->checkAccessRights($topic);

        $request->validate([
            'content' => 'required|string',
        ]);

        $topic->messages()->create([
            'sender_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('site.account.messages.show', $topic->id)
            ->with('success', 'Reply sent!');
    }

    public function getUnreadCount()
    {
        $topics = QaTopic::where(function ($query) {
            $query->where('creator_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
        })
        ->with('messages')
        ->get();

        $unreadCount = 0;
        foreach ($topics as $topic) {
            foreach ($topic->messages as $message) {
                if ($message->sender_id !== Auth::id() && $message->read_at === null) {
                    $unreadCount++;
                }
            }
        }

        return $unreadCount;
    }

    private function checkAccessRights(QaTopic $topic)
    {
        $user = Auth::user();
        if ($topic->creator_id !== $user->id && $topic->receiver_id !== $user->id) {
            abort(403);
        }
    }
}
