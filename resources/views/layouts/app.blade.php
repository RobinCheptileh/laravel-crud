<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>

    <title>@yield('title', 'Home')</title>

    @section('stylesheets')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('fonts/material/material-icons.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('fonts/roboto/roboto.css') }}">
    @show
</head>
<body>
<div class="container-fluid">
    @yield('content')
</div>
</body>
@section('javascripts')
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
@show
</html>