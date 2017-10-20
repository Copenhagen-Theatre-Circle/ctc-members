@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">

                      <table class="table table-striped">

                          <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Member</th>
                            <th></th>
                          </tr>

                        @foreach ($people as $person)

                          <tr>
                            <td style="width: 70px;">

                            @if (!empty($person->main_portrait()))

                              <img src="http://ctc-members.dk/media/{{$person->main_portrait()}}" alt="" style="object-fit: cover; height: 50px; width: 50px; border-radius: 50%; border: solid grey 1px; ">

                            @else

                              <img src="http://ctc-members.dk/media/unisex_silhouette.png" alt="" style="object-fit: cover; height: 50px; width: 50px; border-radius: 50%; border: solid grey 1px; ">

                            @endif

                            </td>

                            <td style="vertical-align:middle; width: 230px;">
                              <span style="font-size: 18px;">{{$person->first_name}} {{$person->last_name}}</span>
                            </td>

                            <td style="vertical-align:middle; text-align: center; width: 50px;">
                                <img src="http://ctc-members.dev/media/star.png" alt="" style="object-fit: cover; height: 30px; width: 30px;  ">
                            </td>

                            <td style="vertical-align:middle;">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Member_{{$person->id}}" href="/person/{{$person->id}}" >
                              More info
                              </button>
                            </td>

                          </tr>

                          <!-- Modal -->
                          <div class="modal fade" id="Member_{{$person->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                              </div>
                            </div>
                          </div>
                            <script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
                            <script type="text/javascript">
                            $('#Member_{{$person->id}}').on('click', function(e){
                              e.preventDefault();
                              $('#Member_{{$person->id}}').modal('show').find('.modal-body').load($(this).attr('href'));
                            });
                            </script>

                        @endforeach

                      </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
