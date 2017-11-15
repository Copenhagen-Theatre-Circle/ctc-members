@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="row scrollbox">
        <div class="col-md-8 mx-auto">
            <div class="card">


                <div class="card-header">

                  <h1>Contact Form</h1>
                  <p class="mt-3">You can send the selected person a message with the following form.
                  <br>
                  Your email address will be revealed in the message, and the person can answer you directly.</p>

                </div>



                <div class="card-body">

                  {{-- From --}}

                  <div class="row">
                    <div class="col-2">
                      <label>From</label>
                    </div>
                  </div>

                  <div class="form-row mb-3">
                    <div class="col">
                    <table style="width: 100%;">
                      <tr class="align-middle">
                        <td style="width: 60px;">
                          <img class="img-fluid" src="https://ctc-members.dk/media/unisex_silhouette.png" alt="" style="display: inline; object-fit: cover; height: 49px; width: 49px; border-radius: 5px; border: solid rgba(0, 0, 0, 0.14902) 1px; ">
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-lg" id="subject" aria-describedby="subject" placeholder="From Name" readonly>
                        </td>
                      </tr>
                    </table>
                    </div>
                  </div>

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
                          <img class="img-fluid" src="https://ctc-members.dk/media/unisex_silhouette.png" alt="" style="display: inline; object-fit: cover; height: 49px; width: 49px; border-radius: 5px; border: solid rgba(0, 0, 0, 0.14902) 1px; ">
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-lg" id="subject" aria-describedby="subject" placeholder="To Name" readonly>
                        </td>
                      </tr>
                    </table>
                    </div>
                  </div>

                  <form>

                    {{-- Subject --}}
                    <div class="form-group">
                      <label for="subject">Subject</label>
                      <input type="text" class="form-control form-control-lg" id="subject" aria-describedby="subject" placeholder="Enter subject">
                    </div>

                    {{-- Body --}}
                    <div class="form-group">
                      <label for="body">Message</label>
                      <textarea class="form-control form-control-lg" id="body" rows="8" placeholder="Enter message"></textarea>
                    </div>
                    <hr>
                    {{-- Buttons --}}
                      <button type="button" class="btn btn-lg btn-secondary float-left">Cancel</button>
                      <button type="submit" class="btn btn-lg btn-primary float-right">Send</button>

                  </form>




                </div>
            </div>
        </div>
    </div>
</div>

@endsection
