@extends('layouts.app_simple_bulma')

@section('content')

<div class="container">

  @include('jubilee_book/navbar')

  <div class="section" style="padding-top: 20px;">
     @include ('jubilee_book/step_counter', ['step'=>3])
  </div>

</div>

@endsection

