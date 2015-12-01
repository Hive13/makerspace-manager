@extends('layouts.base')
@section('content')

    <h1>{{$user->name}}</h1>

    <hr>
    <div class="row">

        <div class="col-sm-2">
            <img src="{{$user->present()->displayPicture}}" height="150" alt="Picture" class="img-circle">
        </div>
        <div class="col-sm-2">

        </div>
        <div class="col-sm-4">
            <br>

            <div class="row">
                {{$user->email}}
            </div>
            <div class="row">
                Member Since: {{$user->present()->memberSince}}
            </div>
            <div class="row">
                Last Seen: {{$user->present()->lastSeen}}
            </div>
            <br>
        </div>
    </div>
    <hr>
    <h3>Edit Profile</h3>
    <hr>
    {!! Form::open()->action(url('user/'.$user->id))->put() !!}
    {!! Form::Bind($user) !!}
    {!! Form::text('Name','name') !!}
    {!! Form::text('Email','email') !!}
    <div class="form-group"><label class="control-label" for="name">Profile Picture</label>
        <input type="file" name="file" />
    </div>
    {!! Form::submit() !!}
    {!! Form::close() !!}

    <h3>Change Password</h3>
    <hr>
    {!! Form::open()->action(url('user/change_password')) !!}
    {!! Form::password('Current Password','password') !!}
    {!! Form::password('Current Password (Confirmation)','password_confirm') !!}
    {!! Form::password('New Password','new_password') !!}
    {!! Form::submit() !!}
    {!! Form::close() !!}

@endsection