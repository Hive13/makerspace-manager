@extends('layouts.base')
@section('content')

    <h1>Admin</h1>
    <hr>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>Login as any user.</p>
                {!! Form::open()->action(url('admin/login'))->post() !!}
                {!! Form::select('User','user_id',$users->getSelector()) !!}
                {!! Form::submit('Login') !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection