@extends('layouts.base')
@section('content')

    <div class="text-center">
        <img src="{{url('img/logo.svg')}}" height="250"></img>

        <h1>{{env('SPACE_NAME')}} Login</h1>
    </div>
    {!! Form::open()->action('/auth/login') !!}
    {!! Form::text('Email','email') !!}
    {!! Form::password('Password','password') !!}
    {!! Form::submit('Login') !!}
    {!! Form::close() !!}

@endsection