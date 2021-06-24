<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>protected</title>
</head>
<body>

    @include('components.main-header')

    <div class="my-show-user">

        <div class="sidebar-part">

             @include('components.sidebar')

        </div>


        <div class="main-content-part">

            @include('components.main-content')

        </div>

    </div>



    @include('components.footer')

</body>
</html>
