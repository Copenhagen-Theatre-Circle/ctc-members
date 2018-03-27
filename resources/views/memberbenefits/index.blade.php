@extends('layouts.app_simple')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <div class="container">
      <div class="row">
          <div class="col-lg-8 mx-auto">

              <div class="card light-transparency mb-4">

                  <div class="card-body">

                    <div class="row">



                          <div class="col-2">
                            <img class="img-fluid" src="/media/logo_dark.png"/>
                          </div>
                          <div class="col-10 pl-0">
                            <h1 class="display-4">Membership Benefits</h1>
                          </div>

                    </div>

                    <div class="row">



                      <div class="col">



                          @foreach ($array as $memberbenefitgroup)

                            <table class="table table-striped table-bordered mt-4">
                              <thead class="thead-dark">
                                <tr>
                                  <th style="width: 65%;">{{$memberbenefitgroup['groupname']}}</th>
                                  <th>Members</th>
                                  <th>Non-Members</th>
                                </tr>
                              </thead>

                              @foreach ($memberbenefitgroup['benefits'] as $memberbenefit)
                                <tr>
                                  <td style="width: 65%;">
                                    {{$memberbenefit['name']}}
                                    @if (!empty($memberbenefit['comment']))
                                      <a tabindex="0" class="text-primary" data-toggle="popover" data-container="body" data-placement="right" data-trigger="focus" data-content="{{$memberbenefit['comment']}}"><span>&#9432;</span></a>
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if ($memberbenefit['member']==1)
                                      <span class="text-success">✔︎</span>
                                    @endif
                                    @if (!empty($memberbenefit['member_comment']))
                                      <a tabindex="0" class="text-primary" data-toggle="popover" data-container="body" data-placement="right" data-trigger="focus" data-content="{{$memberbenefit['member_comment']}}"><span>&#9432;</span></a>
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if ($memberbenefit['non_member']==1)
                                      <span class="text-success">✔︎</span>
                                    @else
                                      <span class="text-danger text-bold">X</span>
                                    @endif
                                    @if (!empty($memberbenefit['non_member_comment']))
                                      <a tabindex="0" class="text-primary" data-toggle="popover" data-container="body" data-placement="right" data-trigger="focus" data-content="{{$memberbenefit['non_member_comment']}}"><span>&#9432;</span></a>
                                    @endif
                                  </td>
                                </tr>
                              @endforeach
                            </table>
                          @endforeach


                      </div>

                    </div>
                    <hr>

                    <div class="row pb-3">
                      <div class="col">
                        <a href="https://place2book.com/en/choose_ticket_sales_workflow?seccode=8bba08ea7e" class="btn btn-lg btn-danger">OK, I'm convinced, sign me up!</a>
                      </div>
                    </div>


                  </div>
              </div>
          </div>
      </div>



  </div>


@endsection
