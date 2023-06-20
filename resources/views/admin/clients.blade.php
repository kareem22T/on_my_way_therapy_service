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

        <div class="table_clients">
            <table>
                <thead>
                    <tr>
                        <th>#id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($clients_data->count() > 0)
                        @foreach ($clients_data as $client)
                            <tr>
                                <td># {{ $client->id }}</td>
                                <td>{{ $client->first_name . ' ' . $client->last_name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>+{{ $client->phone_key . ' ' . $client->phone }}</td>
                                <td>{{ Carbon\Carbon::parse($client->dob)->age }} yo</td>
                                <td>{{ explode(',', $client->address)[0] }}</td>
                                <td><a href="/admin/client/{{ $client->id }}" class="btn btn-success"><i
                                            class="fa fa-eye"></i></a></td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No clients yet!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="pagination_wrapper">
            {!! $clients_data->links('pagination::bootstrap-4') !!}
        </div>
    </main>
@endsection
