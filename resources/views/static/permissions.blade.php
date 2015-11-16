@extends('layouts.base')
@section('content')

    <h1>Permissions</h1>
    <hr>
    <p>
    <ul>
        <li>Name: A short name used to define the permission. Sent to the <a href="{{url('docs/api')}}">API.</a></li>
        <li>Description: A short description showed to the user on their homepage.</li>
    </ul>
    </p>

@endsection