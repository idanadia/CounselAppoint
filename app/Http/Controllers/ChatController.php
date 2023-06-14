<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $loggedInUserId = auth()->user()->id;

        $chats = ChatMessage::select('senderId', 'receiverId')
            ->where('senderId', $loggedInUserId)
            ->orWhere('receiverId', $loggedInUserId)
            ->groupBy('senderId', 'receiverId')
            ->get();

        $userIds = $chats->pluck('senderId')->merge($chats->pluck('receiverId'));
        $users = User::whereIn('id', $userIds)->get();
        return view('chat.index', compact('users'));
    }

    public function show(User $receiver)
    {
        $senderId = auth()->user()->id;
        $receiverId = $receiver->id;

        $messages = ChatMessage::where(function ($query) use ($senderId, $receiverId) {
            $query->where('senderId', $senderId)
                ->where('receiverId', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('senderId', $receiverId)
                ->where('receiverId', $senderId);
        })->orderBy('created_at')
            ->get();

        return view('chat.show', compact('messages', 'receiver'));
    }
    public function store(Request $request, User $receiver)
    {
        $senderId = auth()->user()->id;
        $receiverId = $receiver->id;

        $message = new ChatMessage();
        $message->senderId = $senderId;
        $message->receiverId = $receiverId;
        $message->isSeen = false;
        $message->message = $request->input('message');
        $message->save();

        return redirect()->back();
    }

    public function switchSeen(User $receiver)
    {
        $senderId = auth()->user()->id;
        $receiverId = $receiver->id;

        $messages = ChatMessage::where(function ($query) use ($senderId, $receiverId) {
            $query->where('senderId', $senderId)
                ->where('receiverId', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('senderId', $receiverId)
                ->where('receiverId', $senderId);
        })->orderBy('created_at')
            ->get();

        $messages->each(function ($message) {
            $senderId = auth()->user()->id;

            if ($message->receiverId == $senderId && !$message->isSeen) {
                $message->isSeen = true;
                $message->save();
            }
        });

        return redirect()->route('chats.show', ['receiver' => $receiver->id]);
    }
}
