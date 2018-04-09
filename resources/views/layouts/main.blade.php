<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>GIS Test</title>

    <link rel="stylesheet" href="{{asset('css/libs.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>

<div class="app">

        @yield('content')

</div>

<script src="{{asset('js/libs.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
