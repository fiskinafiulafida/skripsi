<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('LoginRegister/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('LoginRegister/css/style.css')}}">
</head>

<body>

    <div class="main">

        @yield('main')

    </div>

    <!-- JS -->
    <script src="{{ asset('LoginRegister/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('LoginRegister/js/main.js')}}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>