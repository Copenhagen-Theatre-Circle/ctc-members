@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Info</div>

                <div class="panel-body">
                    Session Status: {{ session('status') }}
                    <br/>
                    You are a user!
                    <br/>
                    The user id is: {{ $user->id }}
                    <br/>
                    The user name is: {{ $user->name }}
                    <br/>
                    The user email is: {{ $user->email }}
                    <br/>
                    The user uniqid is: {{ $user->uniqid() }}
                    <br/>
                    The user is a member: {{ $user->ismember() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
