<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
        integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('extra-style')
    <link rel="stylesheet" href="{{ asset('/css/therapist_dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('/css/doctor_calendar.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('/css/client_dashboard.css') }}?v={{ time() }}">
    <link rel="shortcut icon" href="{{ asset('/imgs/site/logo.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('/css/maps.css') }}">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <title>Dashboard | @yield('title')</title>
</head>

<body>
    @include('client.includes.header')
    @yield('content')
    @include('site.includes.footer')

    <input type="hidden" name="pusher_channel_data" id="{{ Auth::guard('client')->user()->id }}" guard_type="2">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="{{ asset('/js/chat.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('/js/notification.js') }}?v={{ time() }}"></script>
    @yield('scripts')
</body>

</html>
