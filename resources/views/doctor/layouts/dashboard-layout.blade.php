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
    @yield('extra-stylesheets')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js"
        integrity="sha512-R2ktoX0ULWEVnA5+oE1kuNEl3KZ9SczXbJk4aT7IgPNfbgTqMG7J14uVqPsdQmZfyTjh0rddK9sG/Mlj97TMEw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
    <link rel="shortcut icon" href="{{ asset('/imgs/site/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/css/therapist_dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('/css/client_dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('/css/maps.css') }}?v={{ time() }}">
    <style>
        body {
            padding: 0;
        }

        .emergency {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: clamp(5rem, calc(4.4837rem + 2.1739vw), 6.25rem);
            height: clamp(5rem, calc(4.4837rem + 2.1739vw), 6.25rem);
            padding: 14px;
            background: white;
            border-radius: 50%;
            border: 4px solid #132F75;
            outline: 2px solid white;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            z-index: 999999;
        }

        .emergency img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .emergency ul {
            position: absolute;
            bottom: 80%;
            right: 100%;
            white-space: nowrap;
            background: white;
            list-style: none;
            padding: 15px;
            margin: 0;
            background: white;
            border-radius: 10px;
            border: 4px solid #132F75;
            outline: 2px solid white;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            font-size: 24px;
            font-weight: 700;
            color: #132F75;
            display: flex;
            flex-direction: column;
            gap: 10px;
            display: none
        }

        .emergency ul a {
            color: #132F75;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard | @yield('title')</title>
</head>

<body>
    @include('doctor.includes.header')
    @yield('content')
    @include('site.includes.footer')

    <button class="emergency">
        <img src="{{ asset('/imgs/doctor/emergency-icon.png') }}" alt="">
        <ul>
            <a href="tel:000">
                <li>Call 000</li>
            </a>
            <a href="tel:1800666929">
                <li>Call On My Way</li>
            </a>
        </ul>
    </button>


    <input type="hidden" name="pusher_channel_data" id="{{ Auth::guard('doctor')->user()->id }}" guard_type="1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        $(function() {
            $('.emergency').click(function() {
                $(this).find('ul').fadeToggle()
            })
        })
    </script>
    <script src="{{ asset('/js/chat.js') }}?v={{ time() }}"></script>
    @yield('scripts')
</body>

</html>
