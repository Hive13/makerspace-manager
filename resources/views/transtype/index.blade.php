@extends('layouts.base')
@section('content')

    <h1>Transaction Types</h1>
    <p>Some of these things you may purchase, others you may not.</p>
    <hr>
    <div class="text-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Description</th>
                <th class="text-center">Cost</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Edit</th>
                @if(Auth::User()->is('admin'))

                    <th class="text-center">Delete</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @forelse($types as $type)
                <tr>
                    <td>{{$type->name}}</td>
                    <td>{{$type->description}}</td>
                    <td>{{$type->cost}}</td>
                    <td>{{$type->created_at->format('M j, Y')}}</td>
                    <td><a href="{{url('transtype/'.$type->id.'/edit')}}">Edit</a></td>


                    @if(Auth::User()->is('admin'))
                        <td>
                            {!! Form::open()->action('transtype/'.$type->id)->delete() !!}
                            {!! Form::submit('Delete')->class('btn btn-danger') !!}
                            {!! Form::close() !!}
                        </td>
                    @endif
                </tr>
            @empty
                <td colspan="3">No TransactionTypes</td>
            @endforelse
            </tbody>
        </table>
    </div>


@endsection