<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link rel="shortcut icon" href="{{asset('/imgs/site/logo.png')}}" type="image/x-icon">
    <title>Therapist | @yield('title')</title>
    <style>
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
</head>
<body>
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        $('.togglePassVisabilaty').on('click', function () {
            let inputType = $(this).parent().find('input').attr('type')
            $(this).parent().find('input').attr('type', inputType == 'password' ? 'text' : 'password')
            $(this).toggleClass('fa-eye fa-eye-slash')
        })
    </script>
</body>
</html>