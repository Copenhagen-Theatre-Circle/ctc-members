@extends('layouts.app_simple_bulma')

@section('content')

<div class="section">
    <div class="steps">
      <div class="step-item is-completed is-success">
        <div class="step-marker">
            <span class="icon">
                <i class="fa fa-check"></i>
            </span>
        </div>
        <div class="step-details">
          {{-- <p class="step-title">Step 1:</p> --}}
          <p>Select the decades you were active.</p>
        </div>
      </div>
      <div class="step-item is-active">
        <div class="step-marker">2</div>
        <div class="step-details">
          {{-- <p class="step-title">Step 2: </p> --}}
          <p>Select the shows you were active in.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-marker">3</div>
        <div class="step-details">
          {{-- <p class="step-title">Step 3:</p> --}}
          <p>Tell us about your experiences in each show.</p>
        </div>
      </div>
    </div>
</div>

@endsection

