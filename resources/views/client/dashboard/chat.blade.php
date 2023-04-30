
@extends('client.layouts.dashboard-layout')

@section('chats_link', 'active')
@php
    $guard_type = Auth::guard('client')->check() ? 2 : 1;
    $unSeen = 0;
    foreach (Auth::user()->chats as $chat) :
        $unSeen += $chat->msgs->where('seen', 0)->where('sender_guard', '!=', $guard_type)->count();
    endforeach;
@endphp

@section('title', 'Chats (' . $unSeen . ')')

@section('content')
<main class="chat_wapper">
    <div class="container lg-grid">
        <div class="side-chats g-4">
            <ul>
                @if ($therapist_data)
                    <li>
                        <a href="/client/chats/{{ $therapist_data['id'] }}" class="selected">
                            <div class="profile">
                                <img src="{{ asset('imgs/doctor/uploads/therapist_profile/'. $therapist_data['photo']) }}" alt="therapist img">
                            </div> {{ $therapist_data['first_name'] . ' ' . $therapist_data['last_name'] }}
                        </a>
                    </li>
                @endif
                @if ($chats && $chats->count() > 0)
                    @foreach ($chats as $chat)
                        @if ($chat->doctor_id != ($therapist_data !== null ? $therapist_data['id'] : 0))
                            <li>
                                <a href="/client/chats/{{ $chat->doctor_id }}" class="chat_link" sender_guard="1" chat_id="{{$chat->id}}">
                                    <div class="profile">
                                        <img src="{{ asset('imgs/doctor/uploads/therapist_profile/'. $chat->doctor->photo) }}" alt="therapist img">
                                    </div> {{ $chat->doctor->first_name . ' ' . $chat->doctor->last_name }}
                                    <span style="display: {{$chat->msgs->where('seen', false)->where('sender_guard', 1)->count() > 0 ? 'flex' : 'none'}}">
                                        {{$chat->msgs->where('seen', false)->count() > 0 ? 
                                            $chat->msgs->where('seen', false)->count() : ''}}
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @else
                    <h1>No chats yet, <a href="/client">find therapist to contact them ?</a></h1>
                @endif
            </ul>
        </div>
        <div class="chat g-8">
            @if ($therapist_data)
                <div class="head">
                    <div>
                        @if ($therapist_data)
                            <div class="profile">
                                <img src="{{ asset('imgs/doctor/uploads/therapist_profile/'. $therapist_data['photo']) }}" alt="therapist img">
                            </div> {{ $therapist_data['first_name'] . ' ' . $therapist_data['last_name'] }}
                        @else
                            
                        @endif
                    </div>
                    <i class="fa-solid fa-ellipsis"></i>
                </div>
            @endif
            <div class="msgs">
                @if ($therapist_data)
                    @if ($chats && $chats->count() > 0)
                        @foreach ($chats as $chat)
                            @if ($chat->doctor_id == $therapist_data['id'])
                                <ul>
                                    @foreach ($chat->msgs as $msg)
                                        <li class="{{ $msg['sender_guard'] == 2 ? 'your-msg' : 'their-msg' }}">
                                            {{ $msg['msg_data'] }} 
                                            <span>
                                                {{ $msg['created_at']->format('n/j, g:i A')}} 
                                                @if ($msg['sender_guard'] == 2)
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
                {{-- <ul>
                    <li class="your-msg">
                        Hello how are you Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor odio cum hic in voluptates veniam ipsa minus sed architecto ex magnam, praesentium dignissimos velit et nam, ullam consequuntur vero autem!
                    </li>
                    <li class="their-msg">
                        I'm good how may i help you Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem quis natus, accusantium et pariatur repudiandae reprehenderit, sit voluptatem eos vel amet perspiciatis distinctio. Facere ipsam dignissimos quae sit explicabo omnis.
                    </li>
                </ul> --}}
            </div>
                <form action="" class="send" id="send" autocomplete="off">
                    @csrf
                    <input type="hidden" name="guard_type" id="guard_type" 
                    value="{{ Auth::guard('client')->check() ? 2 : 1 }}">
                    <input type="hidden" name="client_id" value="{{ Auth::guard('client')->user()->id }}">
                    @if ($therapist_data)
                        <input type="hidden" name="doctor_id" value="{{ $therapist_data['id'] }}">
                    @endif
                    @if ($therapist_data)
                        <input type="text" name="msg" id="msg" placeholder="Type message" autocomplete="off">
                        <button type="submit" class="send-btn"><i class='bx bxs-send'></i></button>
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