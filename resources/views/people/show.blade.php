@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/people">The Network</a></li>
            <li class="breadcrumb-item">{{$first_name}} {{$last_name}}</li>
            {{-- <div class="float-right">
                {{$currentrecord}}/{{$count}}
            </div> --}}
          </ol>


        </nav>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">

                <div class="card light-transparency">

                    <div class="card-header">

                      <div class="row">
                        <div class="col-sm-2 col-xs-12 pr-0">
                          <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_150,w_150,c_thumb,g_face,z_0.8/https://ctc-members.dk/media/{{$portrait}}" alt="" style="max-width: 100%; border: lightgrey solid 2px; border-radius: 10px;">
                        </div>
                        <div class="col-sm-8 col-xs-12 pl-0">
                          <h1 class="display-5">{{$first_name}} {{$last_name}}</h1>
                          {{-- <h4><a href="mailto:{{mail}}" class="text-secondary">{{$mail}}</a></h4>
                          <h4>{{$mobile}}</h4> --}}
                        </div>
                      </div>
                    </div>

                    <div class="card-body">


                      {{-- <div class="container alert-secondary" style="max-width: 660px; background-color: #efefef; margin-bottom: 0px; padding: 30px; padding-left: 40px;"> --}}






                          {{-- <div class="tab-content" id="myTabContent"> --}}

                              @if (! empty($biography))
                                <div class="row">
                                  <div class="col-2 pr-0">
                                    About Me:
                                  </div>
                                  <div class="col-8 pl-0">
                                      <p>
                                      {!! nl2br(e(str_replace('&#39;',"'",$biography))) !!}
                                      </p>
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (! empty($roles))
                                <div class="row">
                                  <div class="col-2 pr-0 mt-3">
                                    CTC Appearances:
                                  </div>
                                  <div class="col-8 pl-0 ml-0">
                                      <table class="table table-striped">
                                          <thead class="thead-light">
                                              <tr>
                                                  <th style="width: 50%;">Play</th>
                                                  <th style="width: 50%;">Character</th>
                                              </tr>
                                          </thead>
                                          @foreach ($roles as $role)
                                              <tr>
                                                  <td style="width: 50%;"><a href="/projects/{{$role['project_id']}}" style="color: #d10f22">{{$role['play']}}</a></td>
                                                  <td style="width: 50%;">{{$role['character']}}</td>
                                              </tr>

                                          @endforeach
                                      </table>
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (! empty($crewjobs))
                                <div class="row">
                                  <div class="col-2 pr-0 mt-3">
                                    CTC Crew Roles:
                                  </div>
                                  <div class="col-8 pl-0 ml-0">
                                      <table class="table table-striped">
                                          <thead class="thead-light">
                                              <tr>
                                                  <th>Play</th>
                                                  <th>Role(s)</th>
                                              </tr>
                                          </thead>
                                          @foreach ($crewjobs as $job)
                                            {{-- {{dd($job)}} --}}

                                              <tr>
                                                <td style="width: 50%;"><a href="/projects/{{$job['project_id']}}" style="color: #d10f22">{{$job['project']}}</a></td>
                                                <td style="width: 50%;">
                                                {{implode (', ', $job['crewfunction'])}}
                                                </td>

                                              </tr>

                                          @endforeach
                                      </table>
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (!empty($general_interests))
                                <div class="row pb-3">
                                  <div class="col-2 pr-0">
                                    General Interests:
                                  </div>
                                  <div class="col-8 pl-0">
                                    @foreach ($general_interests as $general_interest)
                                      <span class='badge badge-primary' style='font-size: 16px; margin-right: 5px; margin-bottom: 5px; background-color:#{{$general_interest['color_hex']}}; white-space:normal;'>{{$general_interest['name']}}</span> &nbsp;
                                    @endforeach
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (!empty($experience))
                                <div class="row pb-3">
                                  <div class="col-2 pr-0">
                                    Experience:
                                  </div>
                                  <div class="col-8 pl-0">
                                    @foreach ($experience as $experience_single)
                                      <span class='badge badge-pill badge-primary' style='font-size: 15px; white-space:normal; margin-right: 5px; margin-bottom: 5px; background-color:#{{$experience_single['color_hex']}}'>{{$experience_single['name']}}</span>
                                    @endforeach
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (!empty($wants_to_learn))
                                <div class="row pb-3">
                                  <div class="col-2 pr-0">
                                    Wants to learn:
                                  </div>
                                  <div class="col-8 pl-0">
                                    @foreach ($wants_to_learn as $learn)
                                      <span class='badge badge-pill badge-light' style='font-size: 15px; margin-right: 5px; margin-bottom: 5px; background-color:#dddddd;color:black; white-space:normal;'>{{$learn['name']}}</span>
                                    @endforeach
                                  </div>
                                </div>
                              @endif



                          {{-- </div> --}}


                </div>



            </div>
        </div>




    </div>


@endsection
