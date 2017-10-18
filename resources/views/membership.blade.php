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
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" href="/nomember">
                              More info
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      ...
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                <script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
                                <script type="text/javascript">
                                $('#exampleModal').on('click', function(e){
                                  e.preventDefault();
                                  $('#exampleModal').modal('show').find('.modal-body').load($(this).attr('href'));
                                });
                                </script>
                            </td>





                          </tr>

                        @endforeach

                      </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
