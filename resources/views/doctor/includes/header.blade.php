<header>
    <div class="container">
        <nav>
            <div class="logo">
                <a href="/"><img src="{{ asset('/imgs/site/logo.png') }}" alt=""></a>
            </div>
            <ul class="links">
                <li><a href="/therapist" class="@yield('calendar_link')"><span>Calendar </span><i
                            class="fa-solid fa-calendar-days"></i></a></li>
                <li>
                    <a href="/therapist/chats" class="@yield('chats_link')"><span>Chats </span><i
                            class="fa-solid fa-comment-dots"></i></a>
                    @php
                        $guard_type = Auth::guard('client')->check() ? 2 : 1;
                        $unSeen = 0;
                        foreach (Auth::guard('doctor')->user()->chats as $chat):
                            $unSeen += $chat->msgs
                                ->where('seen', 0)
                                ->where('sender_guard', '!=', $guard_type)
                                ->count();
                        endforeach;
                    @endphp
                    <span style="display: {{ $unSeen > 0 ? 'flex' : 'none' }}">{{ $unSeen > 0 ? $unSeen : '' }}</span>
                </li>
                <li><a href="/therapist/resources" class="@yield('account_link')"><span>Resources </span><i
                            class="fa-solid fa-paste"></i></a></li>
            </ul>
            <a href="/therapist/my-account" class="nutification">
                <i class="fa fa-user"></i>
            </a>
        </nav>
    </div>
</header>

<style>
    header .img,
    header .logo {
        overflow: visible;
        background-color: #fff !important;
        border-radius: 0 !important;
    }

    header .img img,
    header .logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>
