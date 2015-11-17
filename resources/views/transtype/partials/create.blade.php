@if(isset($update) && $update)
    {!! Form::open()->action(url('transtype/'.$type->id))->put() !!}
    {!! Form::bind($type) !!}
@else
    {!! Form::open()->action('transtype') !!}
    {!! Form::text('Name (Slug)','name') !!}

@endif

{!! Form::text('Description','description') !!}
{!! Form::select('Attached Permission (optional)','permission_id',$permissions->getSelector(['none'=>'None'])) !!}
{!! Form::text('Cost (Optional)','cost') !!}
{!! Form::submit() !!}
{!! Form::close() !!}