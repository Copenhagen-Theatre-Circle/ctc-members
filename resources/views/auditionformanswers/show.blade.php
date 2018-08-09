@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/auditions">Projects</a></li>
            <li class="breadcrumb-item"><a href="/auditions/{{$auditionFormAnswer->project->id}}">{{$auditionFormAnswer->project->name}}</a></li>
            <li class="breadcrumb-item">{{$auditionFormAnswer->person->first_name}} {{$auditionFormAnswer->person->last_name}}</li>
            <div class="float-right">
                {{$currentrecord}}/{{$count}}
            </div>
          </ol>


        </nav>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">

                <div class="card light-transparency">

                    <div class="card-header">

                      <div class="row">
                        <div class="col-sm-2 col-xs-12 pr-0">
                          <img src="https://ctc-members-balmec.imgix.net/{{$auditionFormAnswer->person->portrait}}?fit=crop&w=123&h=123&crop=faces&facepad=1.7&fit=facearea" alt="" style="max-width: 100%; border: lightgrey solid 2px; border-radius: 10px;">
                        </div>
                        <div class="col-sm-8 col-xs-12 pl-0">
                          <h1 class="display-5">{{$auditionFormAnswer->person->first_name}} {{$auditionFormAnswer->person->last_name}}</h1>
                          <h4><a href="mailto:{{$auditionFormAnswer->person->mail}}" class="text-secondary">{{$auditionFormAnswer->person->mail}}</a></h4>
                          <h4>{{$auditionFormAnswer->person->mobile}}</h4>
                        </div>
                      </div>
                    </div>

                    <div class="card-body">


                      {{-- <div class="container alert-secondary" style="max-width: 660px; background-color: #efefef; margin-bottom: 0px; padding: 30px; padding-left: 40px;"> --}}




                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="auditions-tab" data-toggle="tab" href="#audition" role="tab">Audition Information</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="interests-tab" data-toggle="tab" href="#interests" role="tab">Other Theatre Interests & Experience</a>
                            </li>
                          </ul>

                          <div class="tab-content p-3 border-tab rounded-bottom rounded-right" id="myTabContent">
                            <div class="tab-pane fade show active" id="audition" role="tabpanel">
                              @if (! empty($auditionFormAnswer->person->member_bio))
                                <div class="row">
                                  <div class="col-2 pr-0">
                                    Biography:
                                  </div>
                                  <div class="col-6 pl-0">
                                      <p>
                                      {!! nl2br(e(str_replace('&#39;',"'",$auditionFormAnswer->person->member_bio))) !!}
                                      </p>
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (! empty($auditionFormAnswer->date_preferences))
                                <div class="row">
                                  <div class="col-2 pr-0">
                                    Audition Availability:
                                  </div>
                                  <div class="col-6 pl-0">
                                      <p>
                                      {!! nl2br ($auditionFormAnswer->date_preferences) !!}
                                      </p>
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (! empty($auditionFormAnswer->video_link))
                                <div class="row">
                                  <div class="col-2 pr-0">
                                    Audition Video:
                                  </div>
                                  <div class="col-6 pl-0">
                                      {!!LaravelVideoEmbed::parse($auditionFormAnswer->video_link);!!}
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (! empty($auditionFormAnswer->not_available_weekdays))
                                <div class="row">
                                  <div class="col-2 pr-0">
                                    Days not available:
                                  </div>
                                  <div class="col-6 pl-0">
                                      <p>
                                      {{$auditionFormAnswer->not_available_weekdays}}
                                      </p>
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (! empty($auditionFormAnswer->not_available_dates))
                                <div class="row">
                                  <div class="col-2 pr-0">
                                    Dates absent:
                                  </div>
                                  <div class="col-6 pl-0">
                                      <p>
                                      {{$auditionFormAnswer->not_available_dates}}
                                      </p>
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (! empty($auditionFormAnswer->heard_about))
                                <div class="row">
                                  <div class="col-2 pr-0">
                                    Heard about us:
                                  </div>
                                  <div class="col-6 pl-0">
                                      <p>
                                      {{$auditionFormAnswer->heard_about}}
                                      </p>
                                  </div>
                                </div>
                              @endif
                            </div>

                            <div class="tab-pane fade" id="interests" role="tabpanel">
                              @if (!empty($person['general_interests']))
                                <div class="row pb-3">
                                  <div class="col-2 pr-0">
                                    General Interests:
                                  </div>
                                  <div class="col-8 pl-0">
                                    @foreach ($person['general_interests'] as $general_interest)
                                      <span class='badge badge-primary' style='font-size: 16px; margin-right: 5px; margin-bottom: 5px; background-color:#{{$general_interest['color_hex']}}; white-space:normal;'>{{$general_interest['name']}}</span> &nbsp;
                                    @endforeach
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (!empty($person['experience']))
                                <div class="row pb-3">
                                  <div class="col-2 pr-0">
                                    Experience:
                                  </div>
                                  <div class="col-8 pl-0">
                                    @foreach ($person['experience'] as $experience)
                                      <span class='badge badge-pill badge-primary' style='font-size: 15px; white-space:normal; margin-right: 5px; margin-bottom: 5px; background-color:#{{$experience['color_hex']}}'>{{$experience['name']}}</span>
                                    @endforeach
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (!empty($person['wants_to_learn']))
                                <div class="row pb-3">
                                  <div class="col-2 pr-0">
                                    Wants to learn:
                                  </div>
                                  <div class="col-8 pl-0">
                                    @foreach ($person['wants_to_learn'] as $learn)
                                      <span class='badge badge-pill badge-light' style='font-size: 15px; margin-right: 5px; margin-bottom: 5px; background-color:#dddddd;color:black; white-space:normal;'>{{$learn['name']}}</span>
                                    @endforeach
                                  </div>
                                </div>
                              @endif

                            </div>

                          </div>

                    </div>
                </div>

                <div class="card light-transparency mt-1 p-2">
                    <div class="row">
                        <div class="col pl-4">
                            @if (!empty($previous))
                                <a class="btn btn-outline-secondary btn-sm px-2 float-left" href="{{$previous}}@if(!empty(app('request')->input('sort')))?sort={{app('request')->input('sort')}}@endif">Previous</a>
                            @endif
                        </div>
                        <div class="col pr-4 text-center">
                                <a class="btn btn-outline-secondary btn-sm px-2 text-center" href="/auditions/{{$auditionFormAnswer->project->id}}@if(!empty(app('request')->input('sort')))?sort={{app('request')->input('sort')}}@endif">Back to List</a>
                        </div>
                        <div class="col pr-4">
                            @if (!empty($next))
                                <a class="btn btn-outline-secondary btn-sm px-2 float-right" href="{{$next}}@if(!empty(app('request')->input('sort')))?sort={{app('request')->input('sort')}}@endif">Next</a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>




    </div>


@endsection
