@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card light-transparency">


                <div class="card-header">

                  <h1>Member Contact Form</h1>
                  <p class="mt-3">You can send a message to members with the following form.
                  <br>
                  Your email address will be revealed in the message, and the person can answer you directly.</p>

                </div>



                <div class="card-body">

                  <form action="{{ route('membermessage.store') }}" method="post">

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
                            @if (!empty(auth_person('portrait')))
                              <img src="https://ctc-members.dk/media/{{auth_person('portrait')}}" alt="" style="display: inline; object-fit: cover; height: 50px; width: 50px; border-radius: 5px; border: solid rgba(0, 0, 0, 0.14902) 1px; ">
                            @else
                              <img src="https://ctc-members.dk/media/unisex_silhouette.png" alt="" style="display: inline; object-fit: cover; height: 50px; width: 50px; border-radius: 5px; border: solid rgba(0, 0, 0, 0.14902) 1px; ">
                            @endif
                          </td>
                          <td>
                              <input type="text" class="form-control form-control-lg" id="subject" aria-describedby="subject" value="{{auth_person('first_name')}} {{auth_person('last_name')}}" readonly>
                          </td>
                        </tr>
                      </table>
                      </div>

                      <input type="hidden" name="id_from" value="{{auth_person()}}">

                    </div>

                    <hr>

                    {{-- To --}}

                    <div class="row">

                      <div class="col-2">
                        <label >To</label>
                      </div>

                      <div class="col">

                        <label >all Members</label>

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
                        <small class="form-text text-muted">NB: You can use &lt;&lt;FIRST_NAME&gt;&gt; as a merge variable, e.g. 'Dear &lt;&lt;FIRST_NAME&gt;&gt;'</small>
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
