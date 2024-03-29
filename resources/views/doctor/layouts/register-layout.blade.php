<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
        integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('/css/client.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('/css/doctor.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('/css/maps.css') }}?v={{ time() }}">
    <link rel="shortcut icon" href="{{ asset('/imgs/site/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <style>
        ul {
            margin: 0;
            padding: 0;
        }
        .pass-group {
            position: relative;
        }
        .togglePassVisabilaty {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            font-size: 23px;
        }
    </style>
    <title>Therapist | @yield('title')</title>
</head>

<body>

    @include('site.includes.header')
    <div class="container">
        @yield('content')
    </div>

    @include('site.includes.footer')
    <div class="hide-content"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Your custom script here -->
    <script>
        $('.togglePassVisabilaty').on('click', function () {
            let inputType = $(this).parent().find('input').attr('type')
            $(this).parent().find('input').attr('type', inputType == 'password' ? 'text' : 'password')
            $(this).toggleClass('fa-eye fa-eye-slash')
        })
    </script>
    @yield('scripts')
</body>

</html>
