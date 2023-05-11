<header>
    
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="/">
                        <div class="img">
                            <img src="{{asset('/imgs/site/logo.png')}}" alt="">
                        </div> On My Way Therapy Services
                    </a>
                </li>
                <li class="more">
                    <a href="" id="menu-icon">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </a>
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
                                    <li><a href="/client/register">as referrer</a></li>
                                    <li><a href="/therapist/register">as therapist</a></li>
                                </ul>
                            </li>
                            <li>
                                Sign in
                                <ul>
                                    <li><a href="/client/login">as referrer</a></li>
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
<header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="/"><div class="img"></div> On My Way Therapy Services</a></li>
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
                                    <li><a href="/client/register">as referrer</a></li>
                                    <li><a href="/therapist/register">as therapist</a></li>
                                </ul>
                            </li>
                            <li>
                                Sign in
                                <ul>
                                    <li><a href="/client/login">as referrer</a></li>
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
    const menuButton = document.querySelector("a#menu-icon");

        menuButton.addEventListener("click", function(e) {
        e.preventDefault();
        menuButton.classList.toggle("close");

        if (!$(this).hasClass("close"))
            $('.more >ul').fadeOut().removeClass("animate__animated animate__bounceIn");
        else
            $('.more >ul').fadeIn().css('display', 'flex').addClass("animate__animated animate__bounceIn");
    });

</script>

<style>
    .img, .logo {
        overflow: visible;
        background-color: #fff !important;
        border-radius: 0 !important;
    }
    .img img, .logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>
