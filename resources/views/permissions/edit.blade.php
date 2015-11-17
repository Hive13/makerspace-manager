@extends('layouts.base')
@section('content')

    <h1>Edit Permission</h1>
    <hr>
    <h2>Name: {{$permission->name}}</h2>
    {{$permission->description}}
    <hr>
    <div class="text-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Master</th>
                <th class="text-center">Since</th>
                <th class="text-center">Master</th>
                <th class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            @forelse($permission->users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    @if($user->pivot->is_master)
                        <td class="text-center">Yes</td>
                    @else
                        <td class="text-center">No</td>
                    @endif
                    <td>{{$user->pivot->created_at->format('M j, Y')}}</td>
                    <td>
                        {!! Form::open()->action('/perm/master')->post() !!}
                        {!! Form::hidden('user_id')->value($user->id) !!}
                        {!! Form::hidden('permission_id')->value($permission->id) !!}
                        {!! Form::submit('Master')->class('btn btn-success') !!}
                        {!! Form::close() !!}</td>
                    <td>
                        {!! Form::open()->action('/perm/user')->delete() !!}
                        {!! Form::hidden('user_id')->value($user->id) !!}
                        {!! Form::hidden('permission_id')->value($permission->id) !!}
                        {!! Form::submit('Delete')->class('btn btn-danger') !!}
                        {!! Form::close() !!}</td>
                </tr>
            @empty
                <td colspan="4">No Permissions</td>
            @endforelse
            </tbody>
        </table>
    </div>
    <h3>Edit Permission</h3>
    <hr>
    @include('permissions.partials.create',['update'=>true])
    <h3>Grant Permission</h3>
    <hr>
    @include('permissions.partials.grant')
@endsection