@extends('layouts.app_simple')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <div class="container">
      <div class="row">
          <div class="col-md-12 col-md-offset-0">

              <div class="card light-transparency">

                  <div class="card-body">

                    <div class="row">
                      <div class="col-2">

                      </div>
                      <div class="col-8">
                        <div class="row pb-2">
                          <div class="col-2">
                            <img class="img-fluid" src="/media/logo_dark.png"/>
                          </div>
                          <div class="col-9 pl-0">
                            <h1 class="display-4">Membership Benefits</h1>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-2">

                      </div>

                      <div class="col-8">



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
                                  <td style="width: 65%;">{{$memberbenefit['name']}}</td>
                                  <td class="text-center">@if ($memberbenefit['member']==1)
                                    <span class="text-success">✔︎</span>
                                  @endif
                                  </td>
                                  <td class="text-center">@if ($memberbenefit['non_member']==1)
                                    <span class="text-success">✔︎</span>
                                  {{-- @else
                                    <span class="text-danger">x</span> --}}
                                  @endif</td>
                                </tr>
                              @endforeach
                            </table>
                          @endforeach


                      </div>

                    </div>



                  </div>
              </div>
          </div>
      </div>



  </div>

@endsection
