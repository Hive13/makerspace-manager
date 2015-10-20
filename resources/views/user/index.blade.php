@extends('layouts.base')
@section('content')
    <h1>{{env('SPACE_NAME')}} Members</h1>
    <p>{{count($users)}} Total Members</p>
    <hr>
    @foreach($users as $user)
        <div class="col-lg-3">
            <div class="text-center">
                <div class="row">
                    <img src="{{$user->present()->displayPicture}}" height="150" alt="Picture" class="img-circle"></div>
                <div class="row">
                    {{$user->name}}</div>
                <div class="row">
                    {{$user->key_id}}</div>
                <div class="row">
                    {{$user->present()->lastSeen}}</div>
            </div>
        </div>
    @endforeach

@endsection