@extends('layouts.base')
@section('content')

    <h1>Callbacks</h1>
    <p>Callbacks are URLs triggered by events. An event may have many callbacks. <b>WORK IN PROGRESS</b></p>
    <hr>
    <div class="text-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">URL</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Details</th>
                @if(Auth::User()->is('admin'))
                    <th class="text-center">Delete</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @forelse($callbacks as $cb)
                <tr>
                    <td>{{$type->name}}</td>
                    <td>{{$type->url}}</td>
                    <td>{{$type->created_at->format('M j, Y')}}</td>
                    <td><a href="{{url('callback/'.$type->id.'/edit')}}">Details</a></td>


                    @if(Auth::User()->is('admin'))
                        <td>
                            {!! Form::open()->action(url('callback/'.$type->id))->delete() !!}
                            {!! Form::submit('Delete')->class('btn btn-danger') !!}
                            {!! Form::close() !!}
                        </td>
                    @endif
                </tr>
            @empty
                <td colspan="4">No Callbacks</td>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection