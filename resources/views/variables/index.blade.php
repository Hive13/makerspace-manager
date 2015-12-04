@extends('layouts.base')
@section('content')

    <h1>{{env('SPACE_NAME')}} Variables</h1>
    <hr>
    <div class="text-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Value</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
                @if(Auth::User()->is('admin'))
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @forelse($variables as $variable)
                <tr>
                    <td>{{$variable->slug}}</td>
                    <td>{{$variable->value}}</td>
                    <td>{{$variable->created_at->format('M j, Y')}}</td>
                    <td>{{$variable->updated_at->format('M j, Y')}}</td>

                @if(Auth::User()->is('admin'))
                            <td>
                                {!! Form::open()->action('/var/'.$variable->id)->update() !!}
                                {!! Form::submit('Edit')->class('btn btn-default') !!}
                                {!! Form::close() !!}
                            </td>
                        <td>
                            {!! Form::open()->action('/var/'.$variable->id)->delete() !!}
                            {!! Form::submit('Delete')->class('btn btn-danger') !!}
                            {!! Form::close() !!}
                        </td>
                        @endif
                </tr>
            @empty
                <td colspan="3">No Variables</td>
            @endforelse
            </tbody>
        </table>
    </div>
    @if(Auth::User()->is('admin'))
        <h2>
            Create Variable
        </h2>
        <hr>
        {!! Form::open()->action('var') !!}
        {!! Form::text('Name (Slug)','slug') !!}
        {!! Form::select('Set Permission','set_permission_id',$permissions->getSelector(['none'=>'None'])) !!}
        {!! Form::select('Get Permission','get_permission_id',$permissions->getSelector(['none'=>'None'])) !!}
        {!! Form::submit() !!}
        {!! Form::close() !!}
    @endif

@endsection