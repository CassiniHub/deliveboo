<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{asset('js/showcart.js')}}"></script>

    <title>Deliveboo</title>
</head>
<body>

    <div id="app">

        @include('components.home-header')

        @yield('content')

        @include('components.footer')

    </div>



</body>
</html>

