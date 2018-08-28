<div class="steps">

  @php (
    $step_text_array = array(
              'Select the decades you were active.',
              'Select the shows you were active in.',
              'Tell us about your experiences in each show.'
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
