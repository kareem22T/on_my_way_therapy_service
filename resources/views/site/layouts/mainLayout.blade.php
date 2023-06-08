<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script>
        sessionStorage.clear()
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{ asset('/imgs/site/logo.png') }}" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}?v={{ time() }}">
    @if (Auth::guard('client')->check() || Auth::guard('doctor')->check())
        <link rel="stylesheet" href="{{ asset('/css/therapist_dashboard.css') }}?v={{ time() }}">
        <style>
            nav {
                padding: 0 !important;
                background: none !important;
                backdrop-filter: none !important;
                border: none !important;
                box-shadow: none !important;
            }

            header {
                position: static !important;
            }
        </style>
    @endif
    <title>@yield('title')</title>
</head>

<body>
    @if (!Auth::guard('client')->check() && !Auth::guard('doctor')->check())
        @include('site.includes.header')
    @elseif (Auth::guard('client')->check())
        @include('client.includes.header')
    @elseif (Auth::guard('doctor')->check())
        @include('doctor.includes.header')
    @endif
    @include('site.includes.loader')
    @yield('content')
    @include('site.includes.footer')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</body>

</html>
