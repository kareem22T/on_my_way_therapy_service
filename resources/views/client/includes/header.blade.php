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
            <div class="notification-wrapper">
                <a href="" class="nutification">
                    <i class="fa fa-bell"></i>
                </a>
                <ul>
                    <li>
                        <div class="img">
                            <img src="{{asset('/imgs/doctor/uploads/therapist_profile/1_profile_picture.png')}}" alt="client img">
                        </div>
                        <div>
                            <h1>
                                Walter Jesus 
                                <span class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </span>
                            </h1>
                            <span>May 10, 10:00 pm</span>
                            <div class="steps">
                                <div class="step-1">
                                    <span>1</span>
                                    Approved
                                </div>
                                <div class="step-2">
                                    <span>2</span>
                                    On his way
                                </div>
                                <div class="step-3">
                                    <span>3</span>
                                    Arrived
                                </div>
                                <div class="step-4">
                                    <span>4</span>
                                    Completed
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>