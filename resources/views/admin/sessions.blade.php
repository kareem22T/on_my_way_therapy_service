@extends('admin.layout.admin-layout')

@section('title', 'Sessions | data')

@section('receipt-active', 'active')

@section('content')
    <main>
        <h1 class="mt-5">Sessions</h1>
        @php
            $appointments = App\Models\Appointment::paginate(10);
        @endphp
        <div class="table_clients">
            <table>
                <thead>
                    <tr>
                        <th>#id</th>
                        <th>Therapist Name</th>
                        <th>Client Name</th>
                        <th>Therapist phone</th>
                        <th>Therapist email</th>
                        <th>Client address</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($appointments->count() > 0)
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td># {{ $appointment->id }}</td>
                                <td>{{ $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name }}</td>
                                <td>{{ $appointment->client->first_name . ' ' . $appointment->client->last_name }}</td>
                                <td>+{{ $appointment->doctor->phone_key . ' ' . $appointment->doctor->phone }}</td>
                                <td>{{ $appointment->doctor->email }}</td>
                                <td>{{ $appointment->client->address }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No sessions yet!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </main>
@endsection
