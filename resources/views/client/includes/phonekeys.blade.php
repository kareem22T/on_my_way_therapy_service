<!-- country codes (ISO 3166) and Dial codes. -->
@php
    $response = Http::get('https://gist.githubusercontent.com/pickletoni/021e2e18e83f33d16fee5daa308e6a4e/raw/fc6fd9127efd12d97a3d39f38befc784d6bcbf22/countryPhoneCodes.json');
    $countries = $response->json();
@endphp

<select name="countryCode" id="" class="form-control g-5 text-dark text-left">
    @foreach ($countries as $country)
        <option data-countryCode="{{ $country['iso'] }}" value="{{ $country['code'] }}"
            {{ $country['code'] == (isset($client->phone_key) ? $client->phone_key : '') ? 'selected' : '' }}
            {{ $country['code'] == (isset($therapist->phone_key) ? $therapist->phone_key : '') ? 'selected' : '' }}
            {{ $country['country'] == 'Australia' ? 'selected' : '' }}>
            {{ $country['country'] }}
            (+{{ $country['code'] }})
        </option>
    @endforeach
</select>
