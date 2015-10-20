<!doctype html>
<html class="no-js" lang="">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>{{env('SPACE_NAME')}} Manager</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{elixir('css/all.css')}}">

</head>

<body>

@include('partials.navbar')

<div class="container" id="pjax-container">

    @include('flash::message')

    @yield('content')

</div>

<script src="{{elixir('js/all.js')}}"></script>

@include('partials.dev')

</body>

</html>
