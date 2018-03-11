@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card light-transparency">


                <div class="card-header">

                  <h1>Group Contact Form</h1>
                  <p class="mt-3">You can send a message to a group of people with the following form.
                  <br>
                  Your email address will be revealed in the message, and the person can answer you directly.</p>

                </div>



                <div class="card-body">

                  <form action="{{ route('groupmessage.store') }}" method="post">

                    {{ csrf_field() }}

                    {{-- From --}}

                    <div class="row mb-3">

                      <div class="col-2 pt-2">
                        <label>From</label>
                      </div>

                      <div class="col">
                      <table style="width: 100%;">
                        <tr class="align-middle">
                          <td style="width: 60px;">
                            @if (!empty($user->main_portrait()))
                              <img src="https://ctc-members.dk/media/{{$user->main_portrait()}}" alt="" style="display: inline; object-fit: cover; height: 50px; width: 50px; border-radius: 5px; border: solid rgba(0, 0, 0, 0.14902) 1px; ">
                            @else
                              <img src="https://ctc-members.dk/media/unisex_silhouette.png" alt="" style="display: inline; object-fit: cover; height: 50px; width: 50px; border-radius: 5px; border: solid rgba(0, 0, 0, 0.14902) 1px; ">
                            @endif
                          </td>
                          <td>
                              <input type="text" class="form-control form-control-lg" id="subject" aria-describedby="subject" value="{{$user['first_name']}} {{$user['last_name']}}" readonly>
                          </td>
                        </tr>
                      </table>
                      </div>

                      <input type="hidden" name="id_from" value="{{$user->id}}">

                    </div>

                    <hr>

                    {{-- To --}}

                    <div class="row">

                      <div class="col-2">
                        <label >To (activities)</label>
                      </div>

                      <div class="col">

                        @foreach ($crewfunctions as $key=>$functiongroup)
                          <div class="row mb-2">
                            <div class="col-3">
                              <label>{{$key}}</label>
                            </div>
                            <div class="col">
                              @foreach ($functiongroup as $key => $value)
                                <div class="form-check pl-3">
                                  <input type="checkbox" class="form-check-input" id="function_{{$key}}" value="{{$key}}" name="crewfunction[]">
                                  <label class="form-check-label pl-1" for="function_{{$key}}">{{$value}}</label>
                                </div>
                              @endforeach
                            </div>

                          </div>

                          @if(!($loop->last))
                               <hr>
                          @endif


                        @endforeach

                      </div>

                    </div>

                    <hr>

                    {{-- experience --}}

                    <div class="row">
                      <div class="col-2">
                        <label>Experience</label>
                      </div>
                      <div class="col">
                        <div class="form-group pl-4">

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="experience" id="experience" value="experience">
                            <label class="form-check-label pl-1" for="experience">
                              has experience
                            </label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="experience" id="learn" value="learn">
                            <label class="form-check-label pl-1" for="learn">
                              wants to learn
                            </label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="experience" id="both" value="both" checked>
                            <label class="form-check-label pl-1" for="both">
                              either has experience or wants to learn
                            </label>
                          </div>

                        </div>
                      </div>
                    </div>

                    <hr>


                    {{-- Subject --}}
                    <div class="row mb-3">
                      <div class="col-2 pt-2">
                        <label for="subject">Subject</label>
                      </div>
                      <div class="col">
                        <input type="text" name="subject" class="form-control form-control-lg" id="subject" aria-describedby="subject" placeholder="Enter subject" required>
                      </div>
                    </div>



                    {{-- Body --}}
                    <div class="row mb-3">
                      <div class="col-2 pt-2">
                        <label for="body">Message</label>
                      </div>
                      <div class="col">
                        <textarea name="body" class="form-control form-control-lg" id="body" rows="15" placeholder="Enter message" required></textarea>
                      </div>
                    </div>


                    <hr>
                    {{-- Buttons --}}
                      <input type="button" value="Cancel" onclick="history.back()" class="btn btn-lg btn-secondary float-left">
                      <button type="submit" class="btn btn-lg btn-primary float-right">Send</button>

                  </form>




                </div>
            </div>
        </div>
    </div>
</div>

@endsection
