<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('/imgs/site/logo.png') }}" type="image/x-icon">
    <title>NDIS Service Agreement</title>
</head>

<body>
    @php
        $client = Auth::guard('client')->user();
    @endphp
    <script type="text/javascript"
        src="https://form.jotform.com/jsform/231594061545557?client_id={{ $client->id }}&first_name={{ $client->first_name }}&last_name={{ $client->last_name }}&email={{ $client->email }}&phone={{ $client->phone }}&dob={{ $client->dob }}">
    </script>
</body>

</html>
