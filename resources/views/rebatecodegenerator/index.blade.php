@extends('layouts.master')


@section('title','Rebate Code Generator')
 
@section('breadcrumb')
<li><a href="/home">Home</a></li>
    <li class="is-active"><a href="rebate-codes">Rebate Codes</a></li>
@endsection


@section('content')
<div class="section" id="rebatecodegenerator-form" style="padding-top: 10px; padding-left: 0px; padding-right: 0px;">
        <div class="card light-transparency">
            <div class="card-header">
                <p class="card-header-title">Generate Rebate Codes</p>
            </div>
            <!-- display a form to generate rebate codes -->
            <!-- the form calls the generate method in the RebateCodeGeneratorController -->
            <form method="POST" action="/generate-codes">
                @csrf
                <div class="field">
                @if ($errors->any())
                    <div class="title is-4 has-text-dange">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <label class="label">Project</label>
                    <div class="control">
                        <div class="select" style="padding-left: 10px">
                            <select name="project_id">
                                <option value="">None</option>
                                @foreach ($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Rebate Amount</label>
                    <div class="control" style="padding-left: 10px">
                        <!-- validate that the rebate amount is a number -->
                       <input class="input" type="text" name="rebate" placeholder="Rebate Amount" value=20>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Number of Codes</label>
                    <div class="control" style="padding-left: 10px">
                        <input class="input" type="text" name="number_of_codes" default=10 placeholder="Number of Codes">
                    </div>
                </div>
                <div class="field">
                    <div class="control" style="padding-left: 10px">
                        <button type="submit" class="button is-link">Generate Codes</button>
                    </div>
                </div>

        </div>
</div>

@endsection