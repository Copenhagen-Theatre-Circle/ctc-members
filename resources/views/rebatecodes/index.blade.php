@extends('layouts.master')

@section('title','Rebate Codes')

@section('breadcrumb')
    <li><a href="/home">Home</a></li>
    <li class="is-active"><a href="#">Rebate Codes</a></li>
    
@endsection

@section('content')
<!-- show the c
ontents of the rebatecodes table with the option to remove and add new rows-->
<div class="section" id="rebatecodes" style="padding-top: 10px; padding-left: 0px; padding-right: 0px;">
<!-- Add button that links to the generate-codes page -->
<button class="button is-danger" style="margin-bottom: 10px; margin-left: 10px;" onclick="window.location.href='/generate-codes'">Generate Codes</button>
<div class="columns" style="margin-bottom: 0px; padding-left: 10px; padding-right: 10px; ">
    <div class="column">
        <input v-model="showFilter" class="input search" type="text" placeholder="Search projects" />
    </div>
</div>
            
<table class="table is-striped is-bordered is-fullwidth">
    <thead>
                <th></th>
                <th><span class="sort" data-sort="name">Project Name</span></th>
                <th><span class="sort" data-sort="name">Code</span></th>
                <th><span class="sort" data-sort="name">Rebate amount</span></th>
                <th><span class="sort" data-sort="name">Assigned to</span></th>
    </thead>
    <tbody class="list">
        @foreach ($rebatecodes as $rebatecode)
            <tr v-if="showFilter == '' 
            || (showFilter !== '' && '{{str_replace("'", "", $rebatecode->project->name)}}'.toLowerCase().includes(showFilter.toLowerCase()))">
                <td>
                    <!-- only allow to edit if the code is not assigned yet -->
                    @if ($rebatecode->person_id == null)
                        <a href="/rebate-codes/{{$rebatecode->id}}" class="button is-small is-outlined">
                            <span class="icon is-small">
                                <i class="fas fa-edit"></i>
                            </span>
                        </a>
                    @endif
                    <form action="/rebate-codes/{{$rebatecode->id}}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button class="button is-small is-outlined">
                            <span class="icon is-small">
                                <i class="fas fa-trash-alt"></i>
                            </span>
                        </button>
                </td>
                <td>{{$rebatecode->project->name}}</td>
                <td>{{$rebatecode->code}}</td>
                <td>{{$rebatecode->rebate}}</td>
                <td>@if ($rebatecode->person_id != null) {{$rebatecode->person->first_name}} {{$rebatecode->person->last_name}} @endif</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    var vue = new Vue ({
        el: '#app',
        data: {
            showFilter: '',
        }
    })
</script>

@endsection