@extends('layouts.base')
@section('content')

    <h1>Register</h1>

    {!! Form::open()->action('/auth/register') !!}
    {!! Form::text('Name','name') !!}
    {!! Form::text('Email','email') !!}
    {!! Form::password('Password','password') !!}
    {!! Form::password('Password Confirmation','password_confirmation') !!}
    {!! Form::submit() !!}
    {!! Form::close() !!}

@endsection