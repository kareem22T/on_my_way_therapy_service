<span></span>
@if (!Auth::guard('doctor')->check())
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="/">
                            <div class="img">
                                <img src="{{ asset('/imgs/site/logo.png') }}" alt="">

                            </div> On My Way Therapy Services
                        </a>
                    </li>
                    <li class="more">
                        <span href="" id="menu-icon">
                            <a href="" id="sign_in">Log in</a>
                            |
                            <a href="" id="sign_up">Sign up</a>
                        </span>
                        <ul class="register-pop-up">
                            <li>Sign up <i class="fa fa-x-register fa-x"></i></li>
                            <li><a href="/client/register">as referrer/client</a></li>
                            <li><a href="/therapist/register">as therapist</a></li>
                        </ul>
                        <ul class="login-pop-up">
                            <li>Log in <i class="fa fa-x-login fa-x"></i></li>
                            <li><a href="/client/login">as referrer/client</a></li>
                            <li><a href="/therapist/login">as therapist</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="/">
                            <div class="img"></div> On My Way Therapy Services
                        </a></li>
                    <li class="more">
                        <a href=""><i class="fa fa-bars"></i></a>
                        <ul>
                            @if (Auth::guard('doctor')->check())
                                <li><a href="">Profile</a></li>
                                <li><a href="/therapist/logout">Logout</a></li>
                            @elseif (Auth::guard('client')->check())
                                <li><a href="">Profile</a></li>
                                <li><a href="/client/logout">Logout</a></li>
                            @else
                                <li>
                                    Sign up
                                    <ul>
                                        <li><a href="/client/register">as referrer/client</a></li>
                                        <li><a href="/therapist/register">as therapist</a></li>
                                    </ul>
                                </li>
                                <li>
                                    Sign in
                                    <ul>
                                        <li><a href="/client/login">as referrer/client</a></li>
                                        <li><a href="/therapist/login">as therapist</a></li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <script>
        const sing_inBtn = document.querySelector("a#sign_in");

        sing_inBtn.addEventListener("click", function(e) {
            e.preventDefault();
            $('.login-pop-up').fadeIn();
            $('.register-pop-up').fadeOut();
        });
        const sing_upBtn = document.querySelector("a#sign_up");

        sing_upBtn.addEventListener("click", function(e) {
            e.preventDefault();
            $('.register-pop-up').fadeIn();
            $('.login-pop-up').fadeOut();
        });

        const x = document.querySelector(".fa-x-register");

        x.addEventListener("click", function(e) {
            e.preventDefault();
            $('.login-pop-up').fadeOut();
            $('.register-pop-up').fadeOut();
        });
        const x2 = document.querySelector(".fa-x-login");

        x2.addEventListener("click", function(e) {
            e.preventDefault();
            $('.login-pop-up').fadeOut();
            $('.register-pop-up').fadeOut();
        });
    </script>

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
@endif
