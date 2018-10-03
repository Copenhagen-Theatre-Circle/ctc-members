@extends('layouts.app')

@section('content')

  {{-- @foreach ($functionarray as $functiongroup=>$values)
    functiongroup: {{$functiongroup}} <br/>
      @foreach ($values as $key=>$value)
      key: {{$key}}, value: {{$value['questionnaire_name']}} <br/>
      @endforeach

  @endforeach --}}

<div class="container py-3">
    <div class="row scrollbox">
        <div class="col-md-12 col-md-offset-0">
            <div class="card light-transparency">
                <div class="card-header">

                {{-- The Dropdowns --}}

                  <div class="form-row">

                    <div class="col-md-3">
                      <form action="/membership" method="GET">
                        <label>Find by Name:</label>
                        <input type="text" class="form-control @if (!empty ($request['name'])) filtered  @endif" placeholder="Name" name="name" value="{{app('request')->input('name')}}">
                      </form>
                    </div>

                    <div class="col-md-3">
                      <form action="/membership" method="GET">
                        <label>General Interests:</label>
                        <select class="form-control @if (!empty ($request['g'])) filtered  @endif" name="g" onchange="this.form.submit()">
                          <option value="">all</option>
                        @foreach ($functiongroups as $functiongroup)
                          <option value="{{$functiongroup->id}}" @if (app('request')->input('g')==$functiongroup->id){{ "selected"}}@endif>
                            {{$functiongroup->questionnaire_name}}
                          </option>
                        @endforeach
                        </select>
                        <input type="hidden" name="c" value="{{$request['c']}}">
                      </form>
                    </div>

                    <div class="col-md-3">
                      <form action="/membership" method="GET">
                        <label>Specific Interests:</label>
                        <select class="form-control @if (!empty ($request['f'])) filtered  @endif" name="f" onchange="this.form.submit()">
                          <option value="">all</option>
                          <option disabled>––––––––––––</option>
                          @foreach ($functionarray as $functiongroup=>$values)
                            <optgroup label="{{$functiongroup}}">
                              @foreach ($values as $id=>$value)
                                <option value="{{$id}}" @if (app('request')->input('f')==$id){{ "selected"}}@endif>
                                  {{$value}}
                                </option>
                              @endforeach
                            </optgroup>
                          @endforeach
                        </select>
                        <input type="hidden" name="e" value="{{$request['e']}}">
                        <input type="hidden" name="c" value="{{$request['c']}}">
                      </form>
                    </div>

                    <div class="col-md-2">
                      <form action="/membership" method="GET">
                        <label>experience:</label>
                        <select class="form-control @if (!empty ($request['e'])) filtered  @endif" name="e" onchange="this.form.submit()">
                          @if (empty($request['f']))
                            <option value="">all</option>
                            <option disabled>––––––––––––</option>
                            <option disabled>please select specific interest first</option>
                          @else
                            <option value="">all</option>
                            <option disabled>––––––––––––</option>
                            <option value="1" @if ( $request['e']==1 and !empty($request['f']) ) {{"selected"}} @endif >experience</option>
                            <option value="2" @if ( $request['e']==2 and !empty($request['f']) ) {{"selected"}} @endif >no experience</option>
                            <option disabled>––––––––––––</option>
                            <option value="3" @if ( $request['e']==3 and !empty($request['f']) ) {{"selected"}} @endif >wants to learn</option>
                          @endif
                        </select>
                        <input type="hidden" name="f" value="{{$request['f']}}">
                        <input type="hidden" name="c" value="{{$request['c']}}">
                      </form>
                    </div>

                    <div class="col-md-1">
                      <form action="/membership" method="GET">
                        <label>Member:</label>
                        <select class="form-control @if (!empty ($request['c'])) filtered  @endif" name="c" onchange="this.form.submit()">
                          <option value="">all</option>
                          <option disabled>––––––</option>
                          <option value="1" @if ( $request['c']==1 ) {{"selected"}}@endif>yes</option>
                          <option value="2" @if ( $request['c']==2 ) {{"selected"}}@endif>no</option>
                        </select>
                        <input type="hidden" name="f" value="{{$request['f']}}">
                        <input type="hidden" name="g" value="{{$request['g']}}">
                        <input type="hidden" name="name" value="{{$request['name']}}">
                        <input type="hidden" name="e" value="{{$request['e']}}">
                      </form>
                    </div>

                  </div>
                    <hr>
                  <div class="row mt-2 mb-0">
                    <div class="col">

                      <button type="button" class="btn btn-outline-success mr-5">{{$peoplecount}} results found</button>


                    </div>

                  </div>

                </div>

                {{-- The List --}}

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif --}}



                    <div class="table-responsive">

                      <table class="table table-striped">

                          <tr>
                            <th class="hidden-xs-down"></th>
                            <th>Name</th>
                            <th class="hidden-xs-down">Member</th>
                            <th class="hidden-md-down">Last Update</th>
                            <th></th>
                            {{-- <th></th> --}}
                            <th></th>
                          </tr>

                        @foreach ($people as $person)

                          <tr>

                            {{-- Portrait --}}

                            <td class="hidden-xs-down" style="width: 70px;">

                            @if (!empty($person->main_portrait()))

                              {{-- <img src="https://ctc-members-balmec.imgix.net/{{$person->main_portrait()}}?fit=crop&w=123&h=123&crop=faces&facepad=1.7&fit=facearea" alt="" style="object-fit: cover; height: 50px; width: 50px; border-radius: 50%; border: solid grey 1px; "> --}}
                              <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_123/https://ctc-members.dk/media/{{$person->main_portrait()}}" alt="" style="object-fit: cover; height: 50px; width: 50px; border-radius: 50%; border: solid grey 1px; ">
                              {{-- <img src="https://ctc-members.dk/media/thumb_200/{{$person->main_portrait()}}" alt="" style="object-fit: cover; height: 50px; width: 50px; border-radius: 50%; border: solid grey 1px; "> --}}

                            @else

                              <img src="https://ctc-members.dk/media/unisex_silhouette.png" alt="" style="object-fit: cover; height: 50px; width: 50px; border-radius: 50%; border: solid grey 1px; ">

                            @endif

                            </td>

                            {{-- Name --}}

                            <td style="vertical-align:middle; width: 290px; ">
                              <span style="font-size: 18px;">{{$person->first_name}} {{$person->last_name}}</span>
                            </td>

                            {{-- Membership Star --}}

                            <td class="hidden-xs-down" style="vertical-align:middle; text-align: center; width: 50px;">
                              @if ($person->isPaidUpMember())
                                  <img src="https://ctc-members.dk/media/star.png" alt="" style="object-fit: cover; height: 30px; width: 30px;  ">
                              @endif
                            </td>

                            {{-- Last Update --}}

                            <td class="hidden-md-down" style="vertical-align:middle; width: 130px;">
                              <span style="font-size: 18px;">{{$person->questionnaire_answered}}</span>
                            </td>

                            {{-- More Info Button --}}

                            <td style="vertical-align:middle; width: 50px;">
                              <a class="btn btn-primary hidden-sm-down" href="/person/{{$person->id}}">
                              More info
                              </a>

                              <a class="btn btn-primary hidden-md-up" data-toggle="modal" data-target="#Member_{{$person->id}}" href="/person/{{$person->id}}">
                              ℹ︎
                              </a>
                            </td>

                            {{-- Contact Button --}}

                            <td style="vertical-align:middle; width: 50px;">
                              @if (!empty($person->mail))
                                <a class="btn btn-outline-primary hidden-sm-down" href="/message/create?u={{$person->id}}">
                                contact
                                </a>

                                <a class="btn btn-outline-primary hidden-md-up" href="/message/create?u={{$person->id}}">
                                ✉︎
                                </a>
                              @endif
                            </td>

                            <td></td>

                          </tr>

                          <!-- Modal -->
                          {{-- <div class="modal fade" id="Member_{{$person->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-body p-0">
                                  ...
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div> --}}


                        @endforeach

                      </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
{{-- <script type="text/javascript">

$('body').on('click', '[data-toggle="modal"]', function(){
  // alert ('Hello World!');
  $($(this).data("target")+' .modal-body').load($(this).attr('href'));
});



</script> --}}
@endsection
