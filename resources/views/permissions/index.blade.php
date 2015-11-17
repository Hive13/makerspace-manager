@extends('layouts.base')
@section('content')

    <h1>{{env('SPACE_NAME')}} Permissions</h1>
    <hr>
    <div class="text-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Description</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Edit</th>
                @if(Auth::User()->is('admin'))

                    <th class="text-center">Delete</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @forelse($permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->description}}</td>
                    <td>{{$permission->created_at->format('M j, Y')}}</td>
                    @can('edit-permission',$permission)
                    <td><a href="{{url('perm/'.$permission->id.'/edit')}}">Edit</a></td>
                    @else
                        <td></td>
                        @endcan

                        @if(Auth::User()->is('admin'))
                            <td>
                                {!! Form::open()->action('perm/'.$permission->id)->delete() !!}
                                {!! Form::submit('Delete')->class('btn btn-danger') !!}
                                {!! Form::close() !!}
                            </td>
                        @endif
                </tr>
            @empty
                <td colspan="3">No Permissions</td>
            @endforelse
            </tbody>
        </table>
    </div>
    @if(Auth::User()->is('admin'))
        <h3>Create Permission</h3>
        <hr>
        @include('permissions.partials.create')
        <h3>Grant Permission</h3>
        <hr>
        @include('permissions.partials.grant')
    @endif

@endsection