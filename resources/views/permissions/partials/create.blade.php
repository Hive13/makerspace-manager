@if(isset($update) && $update)
    {!! Form::open()->action(url('perm/'.$permission->id))->put() !!}
    {!! Form::bind($permission) !!}
@else
    {!! Form::open()->action(url('perm')) !!}
    {!! Form::text('Name (Slug)','name') !!}
@endif
{!! Form::text('Description','description') !!}
{!! Form::submit() !!}
{!! Form::close() !!}
