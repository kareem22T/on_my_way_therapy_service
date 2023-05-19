@extends('admin.layout.admin-layout')

@section('title', 'Users | clients')

@section('users-active', 'active')

@section('content')
    <main>
        @php
            $clients_active = 'active';
            $therapists_active = null;
        @endphp

        @include('admin.includes.header-users')
    </main>
@endsection
