@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$project->name}}</li>
            {{-- Excel download --}}
            {{-- <div class="float-right">
              <a class="btn btn-outline-success btn-sm mr-2" href="/export/auditions/{{$project->id}}?sort={{app('request')->input('sort')}}" download>Download .xlsx</a>
            </div> --}}
          </ol>
        </nav>
        <div class="row scrollbox">
            <div class="col-md-12 col-md-offset-0">

                <div class="card light-transparency">

                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab">Home</a>
                            <a class="nav-link" id="v-pills-auditions-tab" data-toggle="pill" href="#auditions" role="tab">Auditions</a>
                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab">Messages</a>
                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab">Settings</a>
                          </div>
                        </div>
                        <div class="col">
                          <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel">...</div>
                            <div class="tab-pane fade" id="auditions" role="tabpanel">@include('projects.show_auditions')</div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel">...</div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel">...</div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
