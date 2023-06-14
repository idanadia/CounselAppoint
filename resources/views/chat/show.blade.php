@extends('layouts.template')
@php
use Carbon\Carbon;
@endphp
<style>
    .profile-picture {
        width: 2rem;
        object-fit: cover;
        height: 2rem;
    }

    /* QuickReset */
    * {
        margin: 0;
        box-sizing: border-box;
    }

    .chat {
        --rad: 20px;
        --rad-sm: 3px;
        font: 16px/1.5 sans-serif;
        display: flex;
        flex-direction: column;
        padding: 20px;
        margin: auto;
        justify-content: flex-start;
        /* Align chat bubbles to the top */
        align-items: flex-start;
        /* Align chat bubbles to the left */
    }

    .msg {
        position: relative;
        max-width: 75%;
        padding: 7px 15px;
        margin-bottom: 2px;
        width: fit-content;
        /* Adjust width to fit content */
        word-break: break-word;
        /* Break long words if needed */
    }

    .msg.sent {
        border-radius: var(--rad) var(--rad-sm) var(--rad-sm) var(--rad);
        background: #42a5f5;
        color: #fff;
        margin-left: auto;
        align-self: flex-end;
        /* Align sent messages to the right */
    }

    .msg.rcvd {
        border-radius: var(--rad-sm) var(--rad) var(--rad) var(--rad-sm);
        background: #f1f1f1;
        color: #555;
        margin-right: auto;
    }

    /* Improve radius for messages group */
    .msg.sent:first-child,
    .msg.rcvd+.msg.sent {
        border-top-right-radius: var(--rad);
    }

    .msg.rcvd:first-child,
    .msg.sent+.msg.rcvd {
        border-top-left-radius: var(--rad);
    }


    /* time */

    .msg::before {
        content: attr(data-time);
        font-size: 0.8rem;
        position: absolute;
        bottom: 100%;
        color: #888;
        white-space: nowrap;
        /* Hidden by default */
        display: none;
    }

    .msg.sent::before {
        right: 15px;
    }

    .msg.rcvd::before {
        left: 15px;
    }


    /* Show time only for first message in group */
    .msg.hidden::before {
        display: none;
    }

    .msg:first-child::before,
    .msg.sent+.msg.rcvd::before,
    .msg.rcvd+.msg.sent::before {
        /* Show only for first message in group */
        display: block;
    }
</style>
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <img src="{{! $receiver->imagePath ? Storage::url('images/default.jpg' ):Storage::url('images/' . $receiver->imagePath) }}"
                    class="profile-picture rounded-circle mr-2" alt="Profile Picture">
                <span class="sender-name"><b>{{ $receiver->fullName }}</b></span>
            </div>
        </div>
        <div class="card-body">
            <div class="chat">
                @foreach($messages as $key => $message)
                @php
                // Calculate the time difference between the current and previous messages
                $prevTime = isset($messages[$key - 1]) ? $messages[$key - 1]->created_at : null;
                $timeDiff = $prevTime ? Carbon::parse($message->created_at)->diffInMinutes($prevTime) : null;
                // Determine whether to display the name and time based on time difference
                $showNameTime = !$prevTime || $timeDiff >= 10;
                @endphp
                <div data-time="{{
                        $message->senderId != auth()->user()->id && $showNameTime ? $message->sender->fullName : ''
                    }} {{ Carbon::parse($message->created_at)->format('g:i A') }}"
                    class="msg {{$message->senderId == auth()->user()->id ? 'sent': 'rcvd'}}">
                    {{$message->message}}
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <form class="chat-form" method="post" action="{{ route('chats.store', ['receiver' => $receiver->id]) }}">
                @csrf
                <div class="input-group">
                    <textarea class="form-control" name="message" placeholder="Type your message"></textarea>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // JavaScript logic to handle showing name and time based on time intervals

    const messages = document.querySelectorAll('.msg');
    let prevNameTime = null;

    messages.forEach((message) => {
        const timeElement = message.getAttribute('data-time');

        if (!timeElement) {
            return;
        }

        const [name, time] = timeElement.split(' ');
        const showNameTime = prevNameTime !== name || parseInt(time) >= 10;

        if (showNameTime) {
            message.classList.remove('hidden');
        }

        prevNameTime = showNameTime ? name : prevNameTime;
    });
</script>
@endpush