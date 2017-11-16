@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">


                <div class="card-header">

                  <h1>Contact Form</h1>

                </div>

                <div class="card-body">

                  <div class="row">
                    <div class="col">
                      <div class="alert alert-success" role="alert">
                        Your message has been sent!
                      </div>
                    </div>
                  </div>

                  <hr>
                  {{-- Buttons --}}
                  <a class="btn btn-lg btn-primary float-right" href="/membership">OK</a>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
