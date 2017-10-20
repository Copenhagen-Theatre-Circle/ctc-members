
  <div class="container alert alert-secondary" style="max-width: 100%; background-color: #efefef; margin-bottom: 0px; padding: 30px;">
      <div class="row">
        <div class="col-sm-4 col-5">
          <img src="https://ctc-members.dk/media/{{$portrait}}" alt="" style="max-width: 100%; border: lightgrey solid 2px; border-radius: 8%;">
        </div>
        <div class="col-sm-8 col-7">
          <h1 class="display-4">{{$first_name}}</h1><h1 class="display-4">{{$last_name}}</h1>
        </div>
      </div>

      @if (! empty($biography))
      <div class="row">
        <div class="col-xs-12">
          <br/>
          <blockquote class="blockquote" style="padding-right: 40px; padding-left: 0px; margin-bottom: 0px;">
            <p style="font-size: 16px; margin-bottom: 0px; text-align: justify;">
            "{!! nl2br(e($biography)) !!}"
            </p>
          </blockquote>
        </div>
      </div>
      @endif

      @if (! empty($general_interests))

        <div class="row">
          <div class="col-xs-12" style="line-height: 36px;">

                <h3>General Interests:</h3>

                @foreach ($general_interests as $general_interest)

                  <span class='badge badge-primary' style='font-size: 18px; background-color:#{{$general_interest['color_hex']}}'>{{$general_interest['name']}}</span> &nbsp;

                @endforeach

              <br/>

          </div>
        </div>

      @endif

      @if (! empty($experience))

        <div class="row">
          <div class="col-xs-12" style="line-height: 180%;">

                <h3>Experience:</h3>

                @foreach ($experience as $crewfunction)

                  <span class='badge badge-pill badge-primary' style='font-size: 15px; background-color:#{{$crewfunction['color_hex']}}'>{{$crewfunction['name']}}</span> &nbsp;

                @endforeach

              <br/>

          </div>
        </div>

      @endif

      @if (! empty($wants_to_learn))

        <div class="row">
          <div class="col-xs-12" style="line-height: 180%;">

                <h3>Wants to Learn:</h3>

                @foreach ($wants_to_learn as $crewfunction)

                  <span class='badge badge-pill badge-light' style='font-size: 15px;background-color:#dddddd;color:black;'>{{$crewfunction['name']}}</span> &nbsp;

                @endforeach

              <br/>

          </div>
        </div>

      @endif


  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
