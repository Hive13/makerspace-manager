{!! Form::open()->action('/perm/user') !!}
{!! Form::select('User','user_id',$users->getSelector()) !!}

@if(isset($permissions))
    {!! Form::select('Permission','permission_id',$permissions->getSelector(['all'=>'All Permissions','remove'=>'Remove All'])) !!}

@else
    {!! Form::hidden('permission_id')->value($permission->id) !!}

@endif

{!! Form::submit() !!}
{!! Form::close() !!}