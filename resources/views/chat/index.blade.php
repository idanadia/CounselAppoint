@extends('layouts.template')

@section('content')
{{-- @include('appointment.table')
--}}
<style>
    .indicator {
        width: 0.5rem;
        height: 0.5rem;
        border-radius: 100%;
        background-color: aquamarine;
    }

    a {
        color: rgb(26, 26, 26)
    }

    a:hover {
        color: rgb(92, 92, 92);
    }
</style>
<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">

            <h2>Chats</h2>
        </div>

    </div>
</div>
<div class="list-group">
    @foreach($users as $user)
    @if($user->id != auth()->user()->id)
    @php
    $latestMessage = $user->messages()->latest()->first();
    @endphp
    <a href="{{ $latestMessage->isSeen ?  route('chats.show', ['receiver' => $user->id]) : route('chat.switchSeen', ['receiver' => $user->id]) }}"
        class="list-group-item d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center ">
            <img src="{{! $user->imagePath ? Storage::url('images/default.jpg' ):Storage::url('images/' . $user->imagePath) }}"
                class="rounded-circle mr-2" alt="Profile Picture" style="width: 4rem; height: 4rem; object-fit:cover;">
            <div>
                <b> {{ $user->fullName }}</b>
                @if($latestMessage)
                <p class="mb-0">{{ $latestMessage->message }}</p>
                <small class="text-muted">{{ $latestMessage->created_at->diffForHumans() }}</small>
                @endif
            </div>

        </div>
        @if (!$latestMessage->isSeen && $user->unseenMessagesCount() != 0 )
        <span class="badge bg-primary rounded-pill">{{$user->unseenMessagesCount()}}</span>
        @endif

    </a>
    @endif
    @endforeach
</div>

@endsection