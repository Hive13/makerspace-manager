@extends('layouts.base')
@section('content')
    <h1>{{env('SPACE_NAME')}} Members</h1>
    <h2>{{count($friends)}} Friends</h2>
    <h3>{{count($users)}} Other Members</h3>
    <hr>



    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span></span></th>
                                <th><span>Name</span></th>
                                <th><span>Status</span></th>
                                <th><span>Last Seen</span></th>
                                <th><span>Add</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($friends as $friend)
                                <tr>
                                    <td>
                                        <a href="{{url('user/'.$friend->id)}}" class="user-link"> <img
                                                    src="{{$friend->present()->displayPicture}}" height="25"
                                                    alt="Picture"
                                                    class="img-circle">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{url('user/'.$friend->id)}}" class="user-link">{{$friend->name}}</a>
                                    </td>
                                    <td>
                                        <span class="user-subhead">Friend</span>
                                    </td>
                                    <td>
                                        {{$friend->present()->lastSeen}}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            @endforeach
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <img src="{{$user->present()->displayPicture}}" height="25" alt="Picture"
                                             class="img-circle">
                                    </td>
                                    <td>
                                        {{$user->name}}</td>
                                    <td>
                                        <span class="user-subhead">Member</span>
                                    </td>
                                    <td>{{$user->present()->lastSeen}}</td>
                                    <td>
                                        <a href="#">
                                            {!! Form::open()->action(url('friends/add-friend/'.$user->id)) !!}
                                            {!! Form::submit('Add')->class('btn btn-success') !!}
                                            {!! Form::close() !!}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection