@extends('layouts.base')
@section('content')

    <h1>{{env('SPACE_NAME')}} Permissions</h1>
    <hr>
    <div id="activity_over_time"></div>
    {!! $chart->render('activity_over_time') !!}


@endsection