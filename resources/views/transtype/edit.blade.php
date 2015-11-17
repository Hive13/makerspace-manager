@extends('layouts.base')
@section('content')

    <h1>Edit TransactionType</h1>
    <hr>
    <h2>Name: {{$type->name}}</h2>
    <p>
        Description:{{$type->description}}
        </br>
        Cost: {{$type->present()->typeCost}}
        <br>
        Total Purchases: {{$type->transactions()->count()}}
        <br>
        Total Revenue: ${{substr($type->transactions()->sum('amount'),1)}}
    </p>
    @if(Auth::User()->is('admin'))
        <hr>
        <h3>Edit</h3>
        @include('transtype.partials.create',['update'=>true])
    @endif

@endsection