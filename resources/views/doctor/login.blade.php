@extends('doctor.layouts.register-layout')

@section("title", "Login")

@section("content")
    <div id="errors">
        @if (Session('errorLogin'))
        <div class="alert alert-danger">{{ Session('errorLogin') }}</div>
        @endif
    </div>

    <div class="login_wrapper">
        <form action="{{ route('doctor.check.login') }}" method="POST" class="doctor_login_form" autocomplete="off">
            @csrf
            <h1>Login | Therapist</h1>
            <div class="img">
                <img src="{{ asset("/imgs/doctor/login.png") }}" alt="doctors">
            </div>
            <div class="form-group">
                <input type="text" name="emailorphone" id="emailorphone" class="form-control" placeholder="Email or phone number" required>
            </div>

            <div class="form-group pass-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <i class="fa fa-eye togglePassVisabilaty"></i>
            </div>

            <button type="submit" class="g-2 btn btn-primary form-control">Login</button>
        </form>
    </div>

@endsection

@section('scripts')
<script>
    $(function () {
        $('#errors').fadeIn('slow')
        setTimeout(() => {
            $('#errors').fadeOut('slow')
        }, 8000);
    })
</script>
@endsection