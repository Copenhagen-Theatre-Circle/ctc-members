@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/posts">Suggestions</a></li>
            <li class="breadcrumb-item">{{$post->title}}</li>
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

                        {{-- <div class="col-1">

                        </div> --}}

                        <div class="col-2">
                            <img src="https://ctc-members-balmec.imgix.net/{{$post->person->portrait}}?fit=crop&w=123&h=123&crop=faces&facepad=1.7&fit=facearea" alt="" style="max-width: 50%; border: lightgrey solid 2px; border-radius: 10px;">
                        </div>


                        <div class="col-8">

                          <div class="row">
                              <h1 class="display-5">{{$post->title}}</h1>
                          </div>

                          <div class="row">
                              <h4> by {{$post->person->first_name}} {{$post->person->last_name}}</h4>
                          </div>

                        </div>

                      </div>

                    </div>

                    <div class="card-body">

                              @if (! empty($post->title))
                                <div class="row">
                                  {{-- <div class="col-1">
                                  </div> --}}
                                  <div class="col-2 pr-0">
                                    Date:
                                  </div>
                                  <div class="col-6 pl-0">
                                      <p>
                                      {{date ('d M Y', strtotime($post->created_at))}}
                                      </p>
                                  </div>
                                </div>
                                <hr/>
                              @endif

                              @if (! empty($post->body))
                                <div class="row">
                                  {{-- <div class="col-1">
                                  </div> --}}
                                  <div class="col-2 pr-0">
                                    Details:
                                  </div>
                                  <div class="col-8 pl-0">
                                      <p>
                                      {!! nl2br(e(str_replace('&#39;',"'",$post->body))) !!}
                                      </p>
                                  </div>
                                </div>
                                <hr/>
                              @endif

                    </div>
                </div>

                <div class="card light-transparency mt-1 p-2">
                    <div class="row">
                        <div class="col pl-4">
                            @if (!empty($previous))
                                <a class="btn btn-outline-secondary btn-sm px-2 float-left" href="/posts/{{$previous}}">Previous</a>
                            @endif
                        </div>
                        <div class="col pr-4 text-center">
                                <a class="btn btn-outline-secondary btn-sm px-2 text-center" href="/posts">Back to List</a>
                        </div>
                        <div class="col pr-4">
                            @if (!empty($next))
                                <a class="btn btn-outline-secondary btn-sm px-2 float-right" href="/posts/{{$next}}">Next</a>
                            @endif
                        </div>
                    </div>
                </div>


        </div>




    </div>


@endsection
