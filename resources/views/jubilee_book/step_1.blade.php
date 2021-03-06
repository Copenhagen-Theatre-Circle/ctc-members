@extends('layouts.master')

@section('title','50th Jubilee Book')

@section('content')



  <div class="section" style="padding-top: 20px;">
     @include ('jubilee_book/step_counter', ['step'=>1])
     <form action="{{ route ('jubilee.step1.store', $person->uniqid) }}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
       <div class="columns">
         <div class="column">
          <div class="card">
            <div class="card-content">
              <div class="columns">
                <div class="column">
                  <h3 class="title is-5">Please select your decades.</h3>
                   <p class="is-size-7">In step 2 you will be able to select the shows you would like to talk about. To narrow this list down, please select the decades you were active in the CTC (be it as a cast or crew member or audience member):</p>
                    <br>
                  @foreach ($decades_selectable as $decade_checkbox)
                    <div class="field">
                      <div class="control">
                        <label class="checkbox">
                          <input type="checkbox" name="decades[]" value="{{$decade_checkbox}}" @if( in_array ( $decade_checkbox , $decades_selected )) checked @endif >
                          {{$decade_checkbox}}
                        </label>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div class="column">
                  <h3 class="title is-5">Please select your special series.</h3>
                    <p class="is-size-7">In the history of the CTC, we have done a number of shows within a series. We want to celebrate these traditions, so we have chosen to give each series an extended spread. Please select the ones you would like to share your memories about:</p>
                    <br>
                  @foreach ($series as $serie)
                    <div class="field">
                      <div class="control">
                        <label class="checkbox">
                          <input type="checkbox" name="series[]" value="{{$serie->id}}" @if( in_array ( $serie->id , $series_selected )) checked @endif >
                          {{$serie->name}}
                        </label>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div class="column">
                  <h3 class="title is-5">Please select your essay topics.</h3>
                    <p class="is-size-7">
                      In addition to featuring 50 productions and production series, this book will include four short essays. The topics are listed below, and we hope you'll share your thoughts so we can incorporate them as well. Please select the topics you would like to contribute your thoughts to:
                    </p>
                    <br>
                  @foreach ($essaytopics as $essaytopic)
                    <div class="field">
                      <div class="control">
                        <label class="checkbox">
                          <input type="checkbox" name="essays[]" value="{{$essaytopic->id}}" @if( in_array ( $essaytopic->id , $essays_selected )) checked @endif >
                          {{$essaytopic->name}}
                        </label>
                        <p style="padding-left: 15px;" class="help">{{$essaytopic->description}}</p>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="field">
            <div class="control">
              <button type="submit" class="button is-danger is-pulled-right">Continue</button>
            </div>
          </div>
         </div>
       </div>
     </form>

  </div>






@endsection

