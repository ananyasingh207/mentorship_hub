<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\MentorRequest;

class MessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'startup') {
            $contacts = User::whereIn('id', function($query) use ($user) {
                $query->select('mentor_id')
                      ->from('mentor_requests')
                      ->where('startup_id', $user->id)
                      ->where('status', 'accepted');
            })->get();
        } else if ($user->role === 'mentor') {
            $contacts = User::whereIn('id', function($query) use ($user) {
                $query->select('startup_id')
                      ->from('mentor_requests')
                      ->where('mentor_id', $user->id)
                      ->where('status', 'accepted');
            })->get();
        } else {
            $contacts = collect();
        }

        foreach ($contacts as $contact) {
            $contact->latest_message = Message::where(function($query) use ($user, $contact) {
                $query->where('sender_id', $user->id)->where('receiver_id', $contact->id);
            })->orWhere(function($query) use ($user, $contact) {
                $query->where('sender_id', $contact->id)->where('receiver_id', $user->id);
            })->orderBy('created_at', 'desc')->first();
        }

        $contacts = $contacts->sortByDesc(function ($contact) {
            return $contact->latest_message ? $contact->latest_message->created_at : $contact->created_at;
        });

        return view('messages.index', compact('contacts'));
    }

    public function show(User $user)
    {
        $this->checkAuthorization($user);

        $currentUser = auth()->user();

        $messages = Message::where(function($query) use ($currentUser, $user) {
            $query->where('sender_id', $currentUser->id)
                  ->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($currentUser, $user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $currentUser->id);
        })->orderBy('created_at', 'asc')->get();

        // Fetch contacts for the sidebar
        if ($currentUser->role === 'startup') {
            $contacts = User::whereIn('id', function($query) use ($currentUser) {
                $query->select('mentor_id')
                      ->from('mentor_requests')
                      ->where('startup_id', $currentUser->id)
                      ->where('status', 'accepted');
            })->get();
        } else if ($currentUser->role === 'mentor') {
            $contacts = User::whereIn('id', function($query) use ($currentUser) {
                $query->select('startup_id')
                      ->from('mentor_requests')
                      ->where('mentor_id', $currentUser->id)
                      ->where('status', 'accepted');
            })->get();
        } else {
            $contacts = collect();
        }

        foreach ($contacts as $contact) {
            $contact->latest_message = Message::where(function($query) use ($currentUser, $contact) {
                $query->where('sender_id', $currentUser->id)->where('receiver_id', $contact->id);
            })->orWhere(function($query) use ($currentUser, $contact) {
                $query->where('sender_id', $contact->id)->where('receiver_id', $currentUser->id);
            })->orderBy('created_at', 'desc')->first();
        }

        $contacts = $contacts->sortByDesc(function ($contact) {
            return $contact->latest_message ? $contact->latest_message->created_at : $contact->created_at;
        });

        return view('messages.show', compact('messages', 'user', 'contacts'));
    }

    public function store(Request $request, User $user)
    {
        $this->checkAuthorization($user);

        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
        ]);

        return redirect()->route('messages.show', $user);
    }

    private function checkAuthorization(User $otherUser)
    {
        $user = auth()->user();

        if ($user->id === $otherUser->id) {
            abort(403, 'You cannot message yourself.');
        }

        $hasAccepted = false;

        if ($user->role === 'startup' && $otherUser->role === 'mentor') {
            $hasAccepted = MentorRequest::where('startup_id', $user->id)
                                    ->where('mentor_id', $otherUser->id)
                                    ->where('status', 'accepted')
                                    ->exists();
        } elseif ($user->role === 'mentor' && $otherUser->role === 'startup') {
            $hasAccepted = MentorRequest::where('mentor_id', $user->id)
                                    ->where('startup_id', $otherUser->id)
                                    ->where('status', 'accepted')
                                    ->exists();
        }

        if (!$hasAccepted) {
            abort(403, 'Unauthorized. You can only message users with an accepted mentor request.');
        }
    }
}
