@extends('doctor.layouts.dashboard-layout')

@section('title', 'My Account')

@section('account_link', 'active')

@section('content')
    <main class="account">
        <div class="container">
            @if ($therapist)
                <div class="head">
                    <div>
                        <div class="photo">
                            <img src="{{ asset('/imgs/doctor/uploads/therapist_profile/' . $therapist['photo']) }}"
                                alt="">
                        </div>
                        <h1>{{ $therapist['first_name'] . ' ' . $therapist['last_name'] }},
                            <span>{{ $therapist['profession']['title'] }}</span>
                        </h1>
                    </div>
                    <a href="/therapist/my-account/profile"><i class="fa fa-gear"></i></a>
                </div>
            @endif
            <div class="total lg-grid">
                <div class="g-4">
                    <h1>(315) reviews</h1>
                    <span>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </span>
                </div>
                <div class="g-4">
                    <h1>Sessions of month</h1>
                    <span>
                        25
                    </span>
                </div>
                <div class="g-4">
                    <h1>income</h1>
                    <span>
                        5000$
                    </span>
                </div>
            </div>
            <div>
                <h1>Invoices</h1>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>client name</th>
                                <th>address</th>
                                <th>date</th>
                                <th>time</th>
                                <th>rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </main>
@endSection
