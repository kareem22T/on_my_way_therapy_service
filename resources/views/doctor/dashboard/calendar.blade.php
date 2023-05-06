@extends('doctor.layouts.dashboard-layout')

@section('title', 'Calendar ')

@section('calendar_link', 'active')

@section('extra-stylesheets')
<link rel="stylesheet" href="{{ asset('/css/doctor_calendar.css') }}">
@endSection

@section('content')
<div id="errors">
    {{-- validation errors will appear here. --}}
</div>
<main class="calendar_wrapper">
    <div class="container">
        <div class="work-time">
            @if (!isset($therapist_times))
            <form action="" id="working_hours">
                <div class="row-1">
                    <div>
                        Working hours
                        <div class="form-group">
                            <select name="from" id="from" class="form-control">
                                <option value="">From ---</option>
                                <option value="0">12 am</option>
                                <option value="1">1 am</option>
                                <option value="2">2 am</option>
                                <option value="3">3 am</option>
                                <option value="4">4 am</option>
                                <option value="5">5 am</option>
                                <option value="6">6 am</option>
                                <option value="7">7 am</option>
                                <option value="8">8 am</option>
                                <option value="9">9 am</option>
                                <option value="10">10 am</option>
                                <option value="11">11 am</option>
                                <option value="12">12 pm</option>
                                <option value="13">1 pm</option>
                                <option value="14">2 pm</option>
                                <option value="15">3 pm</option>
                                <option value="16">4 pm</option>
                                <option value="17">5 pm</option>
                                <option value="18">6 pm</option>
                                <option value="19">7 pm</option>
                                <option value="20">8 pm</option>
                                <option value="21">9 pm</option>
                                <option value="22">10 pm</option>
                                <option value="23">11 pm</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="to" id="to" class="form-control">
                                <option value="">To ---</option>
                                <option value="0">12 am</option>
                                <option value="1">1 am</option>
                                <option value="2">2 am</option>
                                <option value="3">3 am</option>
                                <option value="4">4 am</option>
                                <option value="5">5 am</option>
                                <option value="6">6 am</option>
                                <option value="7">7 am</option>
                                <option value="8">8 am</option>
                                <option value="9">9 am</option>
                                <option value="10">10 am</option>
                                <option value="11">11 am</option>
                                <option value="12">12 pm</option>
                                <option value="13">1 pm</option>
                                <option value="14">2 pm</option>
                                <option value="15">3 pm</option>
                                <option value="16">4 pm</option>
                                <option value="17">5 pm</option>
                                <option value="18">6 pm</option>
                                <option value="19">7 pm</option>
                                <option value="20">8 pm</option>
                                <option value="21">9 pm</option>
                                <option value="22">10 pm</option>
                                <option value="23">11 pm</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        Max travelling distance
                        <div class="form-group">
                            <select name="distance" id="distance" class="form-control">
                                <option value="">Distance in KM</option>
                                <option value="1">10</option>
                                <option value="2">20</option>
                                <option value="3">30 +</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <div>
                        Select holidays
                        <div class="form-group">
                            <select name="holidays[]" id="holidays" class="form-control">
                                <option value="">Day ---</option>
                                <option value="1">Sun</option>
                                <option value="2">Mon</option>
                                <option value="3">Tue</option>
                                <option value="4">Wed</option>
                                <option value="5">Thu</option>
                                <option value="6">Fri</option>
                                <option value="7">Sat</option>
                            </select>
                        </div>
                        <ul class="holidays">
                        </ul>
                    </div>

                    <div class="form-group">
                        <button class="btn-info">Set</button>
                    </div>
                </div>
            </form>
            @else
                <h1>Your working hours 
                    <span>
                        {{$therapist_times['working_hours_from'] <= 12 ? $therapist_times['working_hours_from'] . ' am' : $therapist_times['working_hours_from'] - 12 . ' pm'}}
                    </span> - 
                    <span>
                        {{$therapist_times['working_hours_to'] <= 12 ? $therapist_times['working_hours_to'] . ' am' : $therapist_times['working_hours_to'] - 12 . ' pm'}}
                    </span>
                    <button><i class="fa fa-edit"></i></button>
                </h1>
                <h1>Your max traviling distance
                    <span>
                        {{$therapist_times['travel_range'] * 10 . ' km'}}
                    </span> 
                    <button><i class="fa fa-edit"></i></button>
                </h1>
                <h1>Your holidays
                    @php
                        $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                    @endphp
                    @foreach ($therapist_times['holidays'] as $holiday)
                        <span>
                            {{ $holiday->name}}
                        </span>
                    @endforeach
                    <button><i class="fa fa-edit"></i></button>
                </h1>
                
            @endif
        </div>
        <div class="preview">
            <div class="left">
                <div class="calendar">
                <div class="month">
                    <i class="fas fa-angle-left prev"></i>
                    <div class="date">december 2015</div>
                    <i class="fas fa-angle-right next"></i>
                </div>

                <div class="weekdays">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>

                <div class="days"></div>

                {{-- <div class="goto-today">
                    <button class="today-btn">Today</button>
                </div> --}}
                </div>

            </div>

            <div class="right">
                <div class="today-date">
                    <div class="event-day">wed</div>
                    <div class="event-date">12th december 2022</div>
                </div>
            </div>
        </div>

        <div class="this_week_wrapper">
            <h1>
                This week
            </h1>
            <div class="this-week">
                <table>
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Appointments</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach (range(0, 6) as $i)
                        <tr>
                            <td>{{ \Carbon\Carbon::today()->addDays($i)->format('M j, D') }}</td>
                            <td>

                                @if (\App\Models\Appointment::whereDate('date', '=', \Carbon\Carbon::today()->addDays($i)->format('Y-m-d'))->get()->count() == 0)
                                    <p>There is no appointment yet!</p>
                                @endif

                                @foreach (\App\Models\Appointment::whereDate('date', '=', \Carbon\Carbon::today()->addDays($i)->format('Y-m-d'))->where('status', 1)->get() as $appointment)
                                    <p>
                                        <span>{{date("F j", strtotime($appointment->date))}}</span>
                                        <span>{{date('h:i A', strtotime($appointment->date))}}</span>
                                        <span>{{$appointment->client->address}}</span>
                                        <span>15 km in 10 min</span>
                                        <span>{{ $appointment->client->gender }}</span>
                                        <span>{{ Carbon\Carbon::parse($appointment->client->dob)->age }} yo</span>
                                    </p>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="appointments">
            <h3>Up coming sessions</h3>
            <table>
                <tbody>
                    @foreach (App\Models\Appointment::where('status', 1)->where('doctor_id', Auth::guard('doctor')->user()->id)->paginate(4) as $appointment)
                        <tr>
                            <td>{{date("F j", strtotime($appointment->date))}}</td>
                            <td>{{date('h:i A', strtotime($appointment->date))}}</td>
                            <td>{{$appointment->client->address}}</td>
                            <td>15 km in 10 min</td>
                            <td>{{ $appointment->client->gender }}</td>
                            <td>{{ Carbon\Carbon::parse($appointment->client->dob)->age }} yo</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endSection

@section('scripts')
<script src="{{ asset('/js/doctor/calendar.js') }}"></script>
@endsection
