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
                    <form action="" id="working_hours" class="g-2">
                        <h1>Customize your week</h1>
                        @php
                            $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                        @endphp
                        <table>
                            <thead>
                                <tr>
                                    <td></td>
                                    @foreach ($days as $day)
                                        <th>{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span>Start</span>
                                        <span>End</span>
                                    </td>
                                    @foreach ($days as $day)
                                        <td>
                                            <input type="hidden" class="day_name" value="{{ $day }}">
                                            <h4>{{ $day }}</h4>
                                            <input type="text" class="start form-control"
                                                name="{{ $day }}_start" placeholder="Start work"
                                                onfocus="(this.type='time')" onblur="(this.type='text')"
                                                value="{{ App\Models\WorkingHour::where('day_of_week', $day)->where('doctor_id', Auth::guard('doctor')->user()->id)->first()->start_time }}">

                                            <input type="text" class="end form-control" name="{{ $day }}_end"
                                                placeholder="End work" onfocus="(this.type='time')"
                                                onblur="(this.type='text')"
                                                value="{{ App\Models\WorkingHour::where('day_of_week', $day)->where('doctor_id', Auth::guard('doctor')->user()->id)->first()->end_time }}">
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <div class="form-group">
                                <button class="btn-info" id="set_week">Set this week</button>
                                <button class="btn-info" id="set_all_weeks">Set all weeks</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>

            @php
                $appoinments_sessions = App\Models\Appointment::where('status', 1)
                    ->where('doctor_id', Auth::guard('doctor')->user()->id)
                    ->where('journey', '!=', 4)
                    ->whereDate('date', '>=', now())
                    ->paginate(10);
                
                $wait_list = App\Models\Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
                    ->where('wait', 1)
                    ->paginate(10);
            @endphp

            <div class="appointments">
                <h3>Up coming sessions</h3>
                @if ($appoinments_sessions->count() > 0)
                    @foreach ($appoinments_sessions as $appointment)
                        <tr>
                            <a href="/therapist/appointment/{{ $appointment->id }}" target="_blank">
                                <span>{{ date('F j', strtotime($appointment->date)) }}</span>
                                <span>{{ date('h:i A', strtotime($appointment->date)) }}</span>
                                <span>{{ $appointment->client->address }}</span>
                                <span>{{ $appointment->client->gender }}</span>
                                <span>{{ Carbon\Carbon::parse($appointment->client->dob)->age }} yo</span>
                            </a>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <p>There are no sessions yet!</p>
                    </tr>
                @endif
            </div>


            <div class="appointments">
                <h3>Wait list</h3>
                @if ($wait_list->count() > 0)
                    @foreach ($wait_list as $appointment)
                        <tr>
                            <div class="waiting_wrapper" style="flex-wrap: wrap;">
                                <div class="details">
                                    <span>{{ $appointment->client->first_name . ' ' . $appointment->client->last_name }}</span>
                                    <span>{{ date('F j', strtotime($appointment->date)) }}</span>
                                    <span>{{ date('h:i A', strtotime($appointment->date)) }}</span>
                                    <span>{{ $appointment->client->gender }}</span>
                                    <span>{{ Carbon\Carbon::parse($appointment->client->dob)->age }} yo</span>
                                </div>
                                <div class="btns controls">
                                    <button class="edit-date btn btn-secondary" appointment_date="{{ $appointment->date }}"
                                        client_id="{{ $appointment->client->id }}"
                                        doctor_id="{{ $appointment->doctor->id }}">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </button>
                                    <div class="set-date">
                                        <input type="datetime-local" name="new_date" id="new_date">
                                        <input type="submit" name="submit_new_date"
                                            appointment_id="{{ $appointment->id }}" value="Set date">
                                    </div>

                                    <a href="/therapist/chats/{{ $appointment->client->id }}" target="_blank"
                                        class="btn btn-primary">Contact</a>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <p>There are no waiting!</p>
                    </tr>
                @endif
            </div>

            <style>
                .working-hours {
                    background: black;
                }
            </style>
            <div class="this_week_wrapper">
                <h1>
                    My schedule
                </h1>
                <div id="calendar"></div>
            </div>

        </div>
    </main>
@endSection

@section('scripts')
    <script src="{{ asset('/js/doctor/calendar.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                events: @json($events),
                editable: true,
                dayRender: function(dayEl) {
                    if (dayEl.data('workingHours')) {
                        dayEl.addClass('working-hours');
                    }
                }
            });

            calendar.render();
        });
    </script>
@endsection
