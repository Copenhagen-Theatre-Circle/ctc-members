@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card light-transparency">


                <div class="card-header">

                  <h1>Bulletin Board Post Form</h1>
                  <p class="mt-3">Please enter the details of your bulletin board post here.</p>

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
                  </div>

                  <form action="{{ route('posts.store') }}" method="post">

                    {{ csrf_field() }}

                    <input type="hidden" name="person_id" value="{{auth_person()}}">
                    <input type="hidden" name="posttype_id" value="1">

                    {{-- Subject --}}
                    <div class="form-group">
                      <label for="posttype">Post Type</label>
                        <select class="form-control" id="posttype" name="posttype_id">
                            @foreach ($posttypes as $posttype)
                                <option value="{{$posttype->id}}">{{$posttype->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Subject --}}
                    <div class="form-group">
                      <label for="subject">Title</label>
                      <input type="text" name="title" class="form-control form-control-lg" id="subject" aria-describedby="subject" placeholder="Enter post title" required>
                    </div>

                    {{-- Body --}}
                    <div class="form-group">
                      <label for="lead">Lead Paragraph</label>
                      <textarea name="lead" class="form-control form-control-lg" id="lead" rows="5" placeholder="Enter lead paragraph or summary here" required></textarea>
                    </div>

                    {{-- Body --}}
                    <div class="form-group">
                      <label for="body">Details</label>
                      <textarea name="body" class="form-control form-control-lg" id="body" rows="15" placeholder="Enter post details" required></textarea>
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
