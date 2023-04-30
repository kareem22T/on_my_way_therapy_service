
@extends('doctor.layouts.dashboard-layout')

@section('title', 'Chats (0)')

@section('chats_link', 'active')

@section('content')
<main class="chat_wapper">
    <div class="container lg-grid">
        <div class="side-chats g-4">
            <ul>
                @if ($client_data)
                    <li>
                        <a href="/therapist/chats/{{ $client_data['id'] }}" class="selected">
                            <div class="profile">
                                <img src="{{ asset('imgs/client/uploads/client_profile/default_client_profile.jpg') }}" alt="client img">
                            </div> {{ $client_data['first_name'] . ' ' . $client_data['last_name'] }}
                        </a>
                    </li>
                @endif
                @if ($chats && $chats->count() > 0)
                    @foreach ($chats as $chat)
                        @if ($chat->client_id != ($client_data !== null ? $client_data['id'] : 0))
                            <li>
                                <a href="/therapist/chats/{{ $chat->client_id }}" class="chat_link" sender_guard="2" chat_id="{{$chat->id}}">
                                    <div class="profile">
                                        <img src="{{ asset('imgs/client/uploads/client_profile/default_client_profile.jpg') }}" alt="client img">
                                    </div> {{ $chat->client->first_name . ' ' . $chat->client->last_name }}
                                    <span style="display: {{$chat->msgs->where('seen', false)->where('sender_guard', 2)->count() > 0 ? 'flex' : 'none'}}">
                                        {{$chat->msgs->where('seen', false)->count() > 0 ? 
                                            $chat->msgs->where('seen', false)->count() : ''}}
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @else
                    <h1>No chats yet, wait until client contact you!</h1>
                @endif
            </ul>
        </div>
        <div class="chat g-8">
            @if ($client_data)
                <div class="head">
                    <div>
                        @if ($client_data)
                            <div class="profile">
                                <img src="{{ asset('imgs/client/uploads/client_profile/default_client_profile.jpg') }}" alt="client img">
                            </div> {{ $client_data['first_name'] . ' ' . $client_data['last_name'] }}
                        @else
                            
                        @endif
                    </div>
                    <i class="fa-solid fa-ellipsis"></i>
                </div>
            @endif

            <div class="msgs">
                @if ($client_data)
                    @if ($chats && $chats->count() > 0)
                        @foreach ($chats as $chat)
                            @if ($chat->client_id == $client_data['id'])
                                <ul>
                                    @foreach ($chat->msgs as $msg)
                                        <li class="{{ $msg['sender_guard'] == 1 ? 'your-msg' : 'their-msg' }}">
                                            {{ $msg['msg_data'] }} 
                                            <span>
                                                {{ $msg['created_at']->format('n/j, g:i A')}}
                                                @if ($msg['sender_guard'] == 1)
                                                    <i class="fa-solid {{ $msg['seen']  ? 'fa-check-double' : 'fa-check'}}"></i>
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else 
                                no messages yet did you say hi!
                                <ul></ul>
                            @endif
                        @endforeach
                    @else
                        no messages yet did you say hi!
                        <ul></ul>
                    @endif
                @endif
            </div>

            <form action="" class="send" id="send" autocomplete="off">
                @csrf
                <input type="hidden" name="guard_type" id="guard_type"
                value="{{ Auth::guard('client')->check() ? 2 : 1 }}">
                <input type="hidden" name="doctor_id" value="{{ Auth::guard('doctor')->user()->id }}" autocomplete="off">
                @if ($client_data)
                    <input type="hidden" name="client_id" value="{{ $client_data['id'] }}">
                @endif
                @if ($client_data)
                    <input type="text" name="msg" id="msg" placeholder="Type message">
                    <button type="submit"><i class='bx bxs-send'></i></button>
                @endif
            </form>
        </div>
    </div>
</main>
@endSection

@section('scripts')
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="{{ asset('/js/chat.js') }}"></script>
@endsection