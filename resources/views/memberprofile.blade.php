{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}


  <div class="container alert-secondary" style="width: 100%; background-color: #efefef; margin-bottom: 0px; padding: 30px; padding-left: 40px;">
      <div class="row">
        <div class="col-sm-4 col-xs-12">
          <img src="https://ctc-members.dk/media/{{$portrait}}" alt="" style="max-width: 100%; border: lightgrey solid 2px; border-radius: 10px;">
        </div>
        <div class="col-sm-8 col-xs-12">
          <h1 class="display-5">{{$first_name}}</h1><h1 class="display-5">{{$last_name}}</h1>
        </div>
      </div>

      @if (! empty($biography))
      <div class="row">
        <div class="col-xs-12">
          <br/>
          <blockquote class="blockquote" style="padding-right: 5%; padding-left: 0px; margin-bottom: 0px;">
            <p style="font-size: 16px; margin-bottom: 0px; text-align: justify;">
            "{!! nl2br(e($biography)) !!}"
            </p>
          </blockquote>
        </div>
      </div>
      <hr/>
      @endif

      @if (! empty($general_interests))

        <div class="row mt-3">
          <div class="col-xs-12">

                <h3>General Interests:</h3>

                @foreach ($general_interests as $general_interest)

                  <span class='badge badge-primary' style='font-size: 18px; margin-right: 5px; margin-bottom: 5px; background-color:#{{$general_interest['color_hex']}}; white-space:normal;'>{{$general_interest['name']}}</span> &nbsp;

                @endforeach

              <br/>

          </div>
        </div>

      @endif

      @if (! empty($experience))

        <div class="row mt-3">
          <div class="col-xs-12">

                <h3>Experience:</h3>

                @foreach ($experience as $crewfunction)

                  <span class='badge badge-pill badge-primary' style='font-size: 15px; white-space:normal; margin-right: 5px; margin-bottom: 5px; background-color:#{{$crewfunction['color_hex']}}'>{{$crewfunction['name']}}</span>

                @endforeach

              <br/>

          </div>
        </div>

      @endif

      @if (! empty($wants_to_learn))

        <div class="row mt-3">
          <div class="col-xs-12">

                <h3>Wants to Learn:</h3>

                @foreach ($wants_to_learn as $crewfunction)

                  <span class='badge badge-pill badge-light' style='font-size: 15px; margin-right: 5px; margin-bottom: 5px; background-color:#dddddd;color:black; white-space:normal;'>{{$crewfunction['name']}}</span>

                @endforeach

              <br/>

          </div>
        </div>

      @endif

  </div>



{{-- @endsection --}}
