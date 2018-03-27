@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card light-transparency">


                <div class="card-header">

                  <h1>Contact Form</h1>
                  <p class="mt-3">You can send the selected person a message with the following form.
                  <br>
                  Your email address will be revealed in the message, and the person can answer you directly.</p>
                  <p class="text-danger">NB: We will not store this message, to protect your privacy. If you want to receive a copy of the message, please check the box at the bottom of the form.</p>

                </div>



                <div class="card-body">



                  {{-- To --}}

                  <div class="row">

                    <div class="col-2">
                      <label>To</label>
                    </div>

                  </div>

                  <div class="form-row mb-3">
                    <div class="col">
                    <table style="width: 100%;">
                      <tr class="align-middle">
                        <td style="width: 60px;">
                          @if (!empty($recipient->main_portrait()))
                            <img src="https://ctc-members.dk/media/{{$recipient->main_portrait()}}" alt="" style="display: inline; object-fit: cover; height: 50px; width: 50px; border-radius: 5px; border: solid rgba(0, 0, 0, 0.14902) 1px; ">
                          @else
                            <img src="https://ctc-members.dk/media/unisex_silhouette.png" alt="" style="display: inline; object-fit: cover; height: 50px; width: 50px; border-radius: 5px; border: solid rgba(0, 0, 0, 0.14902) 1px; ">
                          @endif
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-lg" id="subject" aria-describedby="recipient" value="{{$recipient['first_name']}} {{$recipient['last_name']}}" readonly>
                        </td>
                      </tr>
                    </table>
                    </div>
                  </div>

                  <form action="{{ route('message.store') }}" method="post">

                    {{ csrf_field() }}

                    <input type="hidden" name="id_to" value="{{$recipient->id}}">
                    <input type="hidden" name="id_from" value="{{auth_person()}}">

                    {{-- Subject --}}
                    <div class="form-group">
                      <label for="subject">Subject</label>
                      <input type="text" name="subject" class="form-control form-control-lg" id="subject" aria-describedby="subject" placeholder="Enter subject" required>
                    </div>

                    {{-- Body --}}
                    <div class="form-group">
                      <label for="body">Message</label>
                      <textarea name="body" class="form-control form-control-lg" id="body" rows="8" placeholder="Enter message" required></textarea>
                    </div>

                    {{-- Copy to self --}}
                    <div class="form-group">
                      <input type="hidden" name="self_copy" value="0">
                      <input type="checkbox" name="self_copy" class="form-check-input ml-0" id="self_copy" value="1">
                      <label for="self_copy" class="form-check-label">send copy to {{auth_person('mail')}}</label>
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
