@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card light-transparency">


                <div class="card-header">

                  <h1>Suggestion & Feedback Form</h1>
                  <p class="mt-3">Please enter the details of your suggestion or feedback here.</p>
                  <p>You can choose if you want your suggestion to be published on the suggestions board, where all members can read it – or not, in which case only the committee will see it.</p>

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
                  </div>

                  <form action="{{ route('posts.store') }}" method="post">

                    {{ csrf_field() }}

                    <input type="hidden" name="person_id" value="{{$user->id}}">
                    <input type="hidden" name="posttype_id" value="5">

                    {{-- Subject --}}
                    <div class="form-group">
                      <label for="subject">Title</label>
                      <input type="text" name="title" class="form-control form-control-lg" id="subject" aria-describedby="subject" placeholder="Enter suggestion title" required>
                    </div>

                    {{-- Body --}}
                    <div class="form-group">
                      <label for="body">Details</label>
                      <textarea name="body" class="form-control form-control-lg" id="body" rows="15" placeholder="Enter suggestion details" required></textarea>
                    </div>

                    {{-- Body --}}
                    <div class="form-group">
                      <label for="body">Who can read your suggestion?</label>
                      <div class="form-check pl-4">
                        <input class="form-check-input" type="radio" name="is_anonymous" id="all_members" value="0" checked>
                        <label class="form-check-label pl-2" for="all_members">
                          Please publish it on the suggestions board for all members to read.
                        </label>
                      </div>
                      <div class="form-check pl-4">
                        <input class="form-check-input" type="radio" name="is_anonymous" id="committee_only" value="1">
                        <label class="form-check-label pl-2" for="committee_only">
                          I only want the committee to read it.
                        </label>
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
