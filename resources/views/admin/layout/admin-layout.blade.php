<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('/imgs/site/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
        integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('/css/maps.css') }}?v={{ time() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .container {
            width: 100%;
        }
        .logout_btn {
            position: absolute;
            top: 30px;
            right: 30px;
            text-decoration: none;
            font-weight: 600;
            color: #751212;
            font-size: 18px;
            border: 2px solid;
            padding: .3rem 1rem;
            border-radius: 20px;
            transition: .3s ease-in
        }
        .logout_btn:hover {
            background: #751212;
            color: #fff;
            border-color: #751212
        }
    </style>
    <title>Admin | @yield('title')</title>
</head>

<body>
    @include('admin.includes.side-bar')
    @yield('content')
    <a href="/admin/logout" class="logout_btn">logout</a>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    @yield('scripts')
</body>

</html>
