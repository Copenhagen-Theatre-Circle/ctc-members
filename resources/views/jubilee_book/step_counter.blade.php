<div class="steps">

  @php (
    $step_text_array = array(
              'Select your decades, series and essay topics.',
              'Select the shows you would like to talk about.',
              'Tell us your thoughts and memories.'
            )
  )

  @for ($i = 1; $i < 4; $i++)
    <div class="step-item @if($i == $step) is-active @elseif ($i < $step) is-completed @endif ">
      <div class="step-marker">
        @if($i < $step)
          <span class="icon">
                <i class="fa fa-check"></i>
            </span>
        @else
          {{$i}}
        @endif
      </div>
      <div class="step-details">
        <p class="step-title">Step {{$i}}:</p>
        <p>{{ $step_text_array[$i-1]}}</p>
      </div>
    </div>
  @endfor

</div>
