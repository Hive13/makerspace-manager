@extends('layouts.base')
@section('content')

    <h1>Transactions</h1>
    <hr>
    <p>
    <h2>TransactionTypes</h2>
    <ul>
        <li>Name: The short name for the transaction. Used in the <a href="{{url('docs/api')}}">API.</a></li>
        <li>Description: a short description that appears in the users recent transactions.</li>
        <li>Permission (<b>Optional</b>): a permission to check against the user before a transaction can be completed.
        </li>
        <li>Cost (<b>Optional</b>): a predefined cost of a transaction. When not used, a amount must be sent via the <a
                    href="{{url('docs/api')}}">API.</a></li>
    </ul>
    </p>

@endsection