@extends('layouts.master')

@section('title','50th Jubilee Book')

@section('content')

  <div class="section" style="padding-top: 20px;">
     @include ('jubilee_book/step_counter', ['step'=>2])

     <form action="{{ route ('jubilee.step2.store', $person->uniqid) }}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
       <div class="columns is-centered">
         <div class="column is-11">
          <div class="card">
            <div class="card-content">
              <h3 class="title is-5">Please select the shows you were active in from the selected decades or that you watched as an audience member, and would like to talk about:</h3>
              <div style="column-count: 3;">
                @foreach ($projects as $project)
                  <div class="field">
                    <div class="control">
                      <label class="checkbox">
                        <input type="checkbox" name="shows[]" value="{{$project->id}}" @if( in_array ( $project->id , $shows_selected )) checked @endif>
                        {{$project->name}}
                      </label>
                    </div>
                  </div>
                @endforeach
              </div>

            </div>
          </div>
          <br>
          <div class="field">
            <div class="control">
              <button type="submit" class="button is-danger is-pulled-right">Continue</button>
            </div>
            <div class="control">
              <a href="step-1" type="submit" class="button is-outlined is-danger is-pulled-left">back to step 1</a>
            </div>
          </div>
         </div>
       </div>
     </form>

  </div>



@endsection

