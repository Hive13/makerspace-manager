@extends('layouts.base')
@section('content')
    <h1>{{env('SPACE_NAME')}} Members</h1>
    <h3>{{count($friends)}} Friends</h3>
    <hr>
    <div class="row">
    @foreach($friends as $friend)
        <div class="col-lg-3">
            <div class="text-center">
                <div class="row">
                    <a href="{{url('user/'.$friend->id)}}"><img src="{{$friend->present()->displayPicture}}" height="150" alt="Picture" class="img-circle">
                    </a>
                </div>
                <div class="row">
                    {{$friend->name}}
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <h3>{{count($users)}} Other Members</h3>
    <hr>
    @foreach($users as $user)
        <div class="col-lg-3">
            <div class="text-center">
                <div class="row">
                    <img src="{{$user->present()->displayPicture}}" height="150" alt="Picture" class="img-circle">
                </div>
                <div class="row">
                    {{$user->name}}
                </div>
                <div class="row">
                    {{$user->present()->lastSeen}}
                </div>
                <div class="row">
                    {!! Form::open()->action(url('friends/add-friend/'.$user->id)) !!}
                    {!! Form::submit('Add')->class('btn btn-success') !!}
                    {!! Form::close() !!}
                </div>
                <div class="row">
                    <br>
                </div>
            </div>
        </div>
    @endforeach

@endsection