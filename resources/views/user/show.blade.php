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

            <div class="row">
                {!! Form::open()->action(url('friends/delete-friend/'.$user->id)) !!}
                {!! Form::submit('Unfriend')->class('btn btn-danger') !!}
                {!! Form::close() !!}
            </div>
        </div>
        @if($user->id != Auth::User()->id)
            <div class="row">
                <div class="col-sm-4">
                    <h3>Buy a drink</h3>
                    {!! Form::open()->action(url('trans/gift'))->post() !!}
                    {!! Form::hidden('user_id')->value($user->id); !!}
                    {!! Form::text('Amount to deduct from your balance of '.Auth::User()->present()->bankBalance,'amount')->length(5) !!}
                    {!! Form::submit() !!}
                </div>
            </div>
        @endif
    </div>
    <hr>




    <h3>Permissions</h3>
    <div class="text-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Description</th>
                <th class="text-center">Since</th>
            </tr>
            </thead>
            <tbody>
            @forelse($user->permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->description}}</td>
                    <td>{{$permission->pivot->created_at->format('M j, Y')}}</td>

                </tr>
            @empty
                <td colspan="4">No Permissions</td>
            @endforelse
            </tbody>
        </table>
    </div>
    <hr>

@endsection