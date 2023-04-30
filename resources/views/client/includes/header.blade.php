<header>
    <div class="container">
        <nav>
            <div class="logo"></div>
            <ul class="links">
                <li><a href="/client" class="@yield('home_link')">Home</a></li>
                <li>
                    <a href="/client/chats" class="@yield('chats_link')">Chats</a>
                    @php
                        $guard_type = Auth::guard('client')->check() ? 2 : 1;
                        $unSeen = 0;
                        foreach (Auth::user()->chats as $chat) :
                            $unSeen += $chat->msgs->where('seen', 0)->where('sender_guard', '!=', $guard_type)->count();
                        endforeach;
                    @endphp
                    <span style="display: {{$unSeen > 0 ? 'flex' : 'none'}}">{{$unSeen > 0 ? $unSeen : ''}}</span>
                </li>
                <li><a href="" class="@yield('account_link')">Account</a></li>
            </ul>
            <a href="" class="nutification">
                <i class="fa fa-bell"></i>
            </a>
        </nav>
    </div>
</header>