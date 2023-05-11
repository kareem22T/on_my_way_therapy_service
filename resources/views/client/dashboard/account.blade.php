
@extends('client.layouts.dashboard-layout')

@section('account_link', 'active')

@section('title', 'Account')

@section('content')
<main class="account_wrapper">
    <div class="container lg-grid">
        <div class="profile g-12">
            <div class="img">
                <img src="{{ asset('/imgs/client/uploads/client_profile/1_profile_picture.jpg') }}">
            </div>
            <h1>Kareem Mohamed</h1>
            <a href="/client/logout" class="btn btn-danger" >Log out</a>
        </div>

        <div class="form-group g-6">
            <input type="text" name="address" id="address" value="10 ali fahmy kamel" disabled>
            <button><i class="fa fa-edit"></i></button>
        </div>
        <div class="form-group g-6">
            <input type="text" name="number" id="number" value="01550552371" disabled>
            <span>Still your number?</span>
        </div>
    </div>
</main>
@endSection
@section('scripts')
@endsection