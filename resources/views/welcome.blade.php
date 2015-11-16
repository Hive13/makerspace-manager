@extends('layouts.base')
@section('content')

    <h1>Welcome back, {{$user->name}}.</h1>

    <hr>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-2">
            <img src="{{$user->present()->displayPicture}}" height="150" alt="Picture" class="img-circle">
        </div>
        <div class="col-sm-2">

        </div>
        <div class="col-sm-4">
            <div class="row">
                {{$user->email}}
            </div>
            <div class="row">
                Account Balance: ${{$user->balance}}
            </div>
            <div class="row">
                KeyID: {{$user->key_id}}
            </div>
            <div class="row">
                Member Since: {{$user->present()->memberSince}}
            </div>
            <div class="row">
                @include('partials.checkout')
            </div>
        </div>
        <div class="col-sm-2">

        </div>
    </div>
    <hr>

    @if(count($user->getFriendRequests()) > 0)
    <h3>Friend Requests</h3>
    <div class="text-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Last Seen</th>
                <th class="text-center">Accept</th>
                <th class="text-center">Decline</th>
            </tr>
            </thead>
            <tbody>
            @forelse($user->getFriendRequests() as $friendship)
                <tr>
                    <td>{{$friendship->sender->name}}</td>
                    <td>{{$friendship->sender->present()->lastSeen}}</td>
                    <td>
                        {!! Form::open()->action(url('friends/accept-friend/'.$friendship->sender->id)) !!}
                        {!! Form::submit('Accept')->class('btn btn-success') !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open()->action(url('friends/decline-friend/'.$friendship->sender->id)) !!}
                        {!! Form::submit('Decline')->class('btn btn-danger') !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <td colspan="4">No Permissions</td>
            @endforelse
            </tbody>
        </table>
    </div>
    <hr>
    @endif

    <h3>Your Permissions</h3>
    <div class="text-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Description</th>
                <th class="text-center">Since</th>
                <th class="text-center">Grant</th>
            </tr>
            </thead>
            <tbody>
            @forelse($user->permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->description}}</td>
                    <td>{{$permission->pivot->created_at->format('M j, Y')}}</td>
                    @can('edit-permission', $permission)
                    <td class="text-center"><a href="{{url('perm/'.$permission->id.'/edit')}}">Edit</a></td>
                    @else
                        <td></td>
                        @endcan
                </tr>
            @empty
                <td colspan="4">No Permissions</td>
            @endforelse
            </tbody>
        </table>
    </div>
    <hr>

    <h3>Recent Transactions</h3>
    <div class="text-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Type</th>
                <th class="text-center">Description</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Running</th>
                <th class="text-center">Time</th>
            </tr>
            </thead>
            <tbody>
            @forelse($user->transactions as $transaction)
                @if($transaction->isDeposit())
                    <tr class="success">
                @else
                    <tr class="danger">
                        @endif
                        <td>{{$transaction->type->name}}</td>
                        <td>{{$transaction->present()->trueDescription}}</td>
                        <td>{{$transaction->present()->dollarAmount}}</td>
                        <td>{{$transaction->present()->runningAmount}}</td>
                        <td>{{$transaction->present()->purchaseDate}}</td>
                    </tr>
                    @empty
                        <td colspan="5">No Transactions</td>
                    @endforelse
            </tbody>
        </table>
    </div>

    <h3>Recent Activity</h3>
    <div class="text-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Description</th>
                <th class="text-center">Time</th>
            </tr>
            </thead>
            <tbody>
            @forelse($user->activities->take(15) as $activity)
                <Tr>
                    <td>Checked permission for {{$activity->present()->name}}</td>
                    <td>{{$activity->present()->displayTime}}</td>

                </tr>
            @empty
                <td colspan="2">No Activity</td>
            @endforelse
            </tbody>
        </table>
    </div>





@endsection