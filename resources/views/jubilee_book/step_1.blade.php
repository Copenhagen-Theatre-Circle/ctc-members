@extends('layouts.app_simple_bulma')

@section('content')

<div class="container">

  @include('jubilee_book/navbar')

  <div class="section" style="padding-top: 20px;">
     @include ('jubilee_book/step_counter', ['step'=>1])
     <form action="{{ route ('jubilee.step1.store', $person->uniqid) }}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
       <div class="columns">
         <div class="column is-half is-offset-one-quarter">
          <div class="card">
            <div class="card-content">
              <h3 class="title is-5">Please select the decades you were active in the CTC.</h3>

              @foreach ($decades_selectable as $decade_checkbox)
                <div class="field">
                  <div class="control">
                    <label class="checkbox">
                      <input type="checkbox" name="decade[]" value="{{$decade_checkbox}}" @if( in_array ( $decade_checkbox , $decades_selected )) checked @endif >
                      {{$decade_checkbox}}
                    </label>
                  </div>
                </div>
              @endforeach

            </div>
          </div>
          <br>
          <div class="field">
            <div class="control">
              <button type="submit" class="button is-ctc is-pulled-right">Continue</button>
            </div>
          </div>
         </div>
       </div>
     </form>

  </div>


</div>



@endsection

