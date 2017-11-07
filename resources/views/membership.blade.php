@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row scrollbox">
        <div class="col-md-12 col-md-offset-0">
            <div class="card">
                <div class="card-header">

                {{-- The Dropdowns --}}

                  <div class="form-row">
                    <div class="col-md-4">
                      <form action="/membership" method="GET">
                      <label>Find by Name:</label>
                      <input type="text" class="form-control" placeholder="Name" name="name" value="{{app('request')->input('name')}}">
                    </form>
                    </div>
                    <div class="col-md-4">
                      <form action="/membership" method="GET">
                      <label>General Interests:</label>
                      <select class="form-control" name="g" id="myselect" onchange="this.form.submit()">
                        <option value="">all</option>
                      @foreach ($functiongroups as $functiongroup)
                        <option value="{{$functiongroup->id}}" @if (app('request')->input('g')==$functiongroup->id){{ "selected"}}@endif>
                          {{$functiongroup->questionnaire_name}}
                        </option>
                      @endforeach
                      </select>
                    </form>
                    </div>

                    <div class="col-md-4">
                      <form action="/membership" method="GET">
                      <label>Speficic Interests:</label>
                      <select class="form-control" name="f" id="myselect" onchange="this.form.submit()">
                        <option value="">all</option>
                      @foreach ($functions as $function)
                        <option value="{{$function->id}}" @if (app('request')->input('f')==$function->id){{ "selected"}}@endif>
                          {{$function->questionnaire_name}}
                        </option>
                      @endforeach
                      </select>
                      </form>
                    </div>

                    <div class="col-md-4">

                    </div>

                  </div>

                </div>

                {{-- The List --}}

                <div class="card-body" style="overflow: scroll;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">

                      <table class="table table-striped">

                          <tr>
                            <th class="hidden-xs-down"></th>
                            <th>Name</th>
                            <th class="hidden-xs-down">Member</th>
                            {{-- <th class="hidden-md-down">Last Update</th> --}}
                            <th></th>
                            {{-- <th></th> --}}
                            <th></th>
                          </tr>

                        @foreach ($people as $person)

                          <tr>

                            {{-- Portrait --}}

                            <td class="hidden-xs-down" style="width: 70px;">

                            @if (!empty($person->main_portrait()))

                              <img src="https://ctc-members.dk/media/{{$person->main_portrait()}}" alt="" style="object-fit: cover; height: 50px; width: 50px; border-radius: 50%; border: solid grey 1px; ">

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
                                <img src="https://ctc-members.dk/media/star.png" alt="" style="object-fit: cover; height: 30px; width: 30px;  ">
                            </td>

                            {{-- Last Update --}}

                            {{-- <td class="hidden-md-down" style="vertical-align:middle; width: 120px;">
                              <span style="font-size: 18px;">2017</span>
                            </td> --}}

                            {{-- More Info Button --}}

                            <td style="vertical-align:middle; width: 50px;">
                              <button type="button" class="btn btn-primary hidden-sm-down" data-toggle="modal" data-target="#Member_{{$person->id}}" href="/person/{{$person->id}}">
                              More info
                              </button>

                              <button type="button" class="btn btn-primary hidden-md-up" data-toggle="modal" data-target="#Member_{{$person->id}}" href="/person/{{$person->id}}">
                              ℹ︎
                              </button>
                            </td>

                            {{-- Contact Button --}}

                            {{-- <td style="vertical-align:middle; width: 50px;">
                              <button type="button" class="btn btn-outline-primary hidden-sm-down" data-toggle="modal" data-target="#Member_{{$person->id}}" href="/person/{{$person->id}}">
                              contact
                              </button>

                              <button type="button" class="btn btn-outline-primary hidden-md-up" data-toggle="modal" data-target="#Member_{{$person->id}}" href="/person/{{$person->id}}">
                              ✉︎
                              </button>
                            </td> --}}

                            <td></td>

                          </tr>

                          <!-- Modal -->
                          <div class="modal fade" id="Member_{{$person->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                {{-- <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Profile Card: {{$person->first_name}} {{$person->last_name}}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div> --}}
                                <div class="modal-body p-0">
                                  ...
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>


                        @endforeach

                      </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
<script type="text/javascript">

$('body').on('click', '[data-toggle="modal"]', function(){
  // alert ('Hello World!');
  $($(this).data("target")+' .modal-body').load($(this).attr('href'));
});



</script>
@endsection
