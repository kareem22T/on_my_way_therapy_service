@extends('admin.layout.register-layout')

@section('title', 'Login')

@section('content')
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
    <div id="errors">
        @if (Session('errorLogin'))
            <div class="alert alert-danger">{{ Session('errorLogin') }}</div>
        @endif
    </div>

    <div class="login_wrapper">
        <form action="{{ route('admin.check.login') }}" method="POST" class="doctor_login_form" autocomplete="off">
            @csrf
            <h1 class="text-center">on my way therapy <br> dashboard</h1>
            <div class="img">
                <img src="{{ asset('/imgs/site/admin-login.png') }}" alt="doctors">
            </div>
            <div class="form-group">
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="g-2 btn btn-primary form-control">Login</button>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $(function() {
            $('#errors').fadeIn('slow')
            setTimeout(() => {
                $('#errors').fadeOut('slow')
            }, 8000);
        })
    </script>
@endsection
