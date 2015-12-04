@extends('layouts.base')
@section('content')

    <h1>API Documentation</h1>
    <hr>
    <p>
        Current Endpoint:
    <div class="well">
        {{url('api/v1/')}}
    </div>

    </p>
    <h2>General</h2>
    <p>
        The API makes use of the following variables:</br>
        <b>KEY_ID</b>: A short alphanumeric string unique to each user. Read via an RFID Reader.

    </p>
    <h3>Permissions</h3>
    <p>
        To check if a user has a permission use the following call:
    <div class="well">
        {{url('api/v1/perm/')}}/{KEY_ID}/{PERMISSION_NAME}
    </div>
    The API will return a document containing either "true" or "false" in plain text.</br>
    </p>
    <h3>Transactions</h3>
    <p>
        There is two types TransactionType.
    <ul>
        <li>
            Predefined Cost: These are TransactionTypes with a set price.
            Useful for soda machines.
        </li>
        <li>
            Undefined Cost: These are TransactionTypes with no set price.
            Useful for times when you do not know the cost until an operation has completed, such as laser minutes.
        </li>
    </ul>
    <h4>Predefined Cost</h4>
    <div class="well">
        {{url('api/v1/trans/')}}/{KEY_ID}/{TRANSACTION_TYPE_NAME}
    </div>
    The API will return a document containing either "true" or "false" in plain text if the transaction is successful.
    <h4>Undefined Cost</h4>
    <div class="well">
        {{url('api/v1/trans/')}}/{KEY_ID}/{TRANSACTION_TYPE_NAME}/{COST}
    </div>
    The API will return a document containing either "true" or "false" in plain text if the transaction is successful.
    </p>
    <h3>Variables</h3>
    <p>
        Variables can be get and set using a simple API. Variables can fire callbacks on get/set events. All variable events are logged.
    <h4>Get Variable</h4>
    <div class="well">
        {{url('api/v1/var/get')}}/{VAR_NAME}
    </div>
    The API will return a document containing the value of the variable, or "false" when nothing is found.
    <b>Because the API returns nothing but a document containing "false" to help tiny embedded devices, it is not recommended to use "true" and "false" as variable values. Use 0 and 1 instead.</b>
    <h4>Set Variable</h4>
    <div class="well">
        {{url('api/v1/var/set/')}}/{VAR_NAME}/{VAR_VALUE}/{KEY_ID?}
    </div>
    The API will return a document containing either "true" or "false" in plain text if the transaction is successful.
    </p>

@endsection