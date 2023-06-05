@extends('layouts.master')

@section('title', 'Rebate Code Details')
 
@section('breadcrumb')
    <li><a href="/home">Home</a></li>
    <li class="is-
active"><a href="/rebate-codes">Rebate Codes</a></li>
@endsection

@section('content')
<!-- Show a card for one rebate code allowing to edit the user and project assigned to it -->
<div class="section" id="rebatecode-edit" style="padding-top: 10px; padding-left: 0px; padding-right: 0px;">
    <div class="card light-transparency">
        <div class="card-header">
            <p class="card-header-title">Update code {{$rebatecode->code}}</p>
        </div>
        <form method="POST" action="/rebate-codes/{{$rebatecode->id}}">
            @csrf
            @method('PATCH')
            <!-- display the project name -->
            <p class="card-header-title">Project: {{$rebatecode->project->name}}</p>
            <p class="card-header-title">Rebate amount: {{$rebatecode->rebate}}</p>
            <!-- send the rebate id in the request -->
            <input type="hidden" name="id" value="{{$rebatecode->id}}">
            <div class="field">
            <p class="card-header-title">Person</p>
                <div class="control">
                    <div class="select" style="padding-left: 10px">
                        <select name="person_id">
                            <option value="">None</option>
                            @foreach ($people as $person)
                                <option value="{{$person->id}}" @if ($person->id == $rebatecode->person_id) selected @endif>{{$person->first_name}} {{$person->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-link">Update Rebate Code</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection