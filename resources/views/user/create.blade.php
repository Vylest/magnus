@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <h3>Create User</h3>
            {!! Form::open(['action'=>'UserController@store','class'=>'']) !!}
            @include('user.partials._formAdmin')
            {!! Form::close() !!}
        </div>
    </div>
@endsection