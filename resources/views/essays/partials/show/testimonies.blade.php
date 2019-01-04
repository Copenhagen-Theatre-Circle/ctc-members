@foreach ($essay->essaytopicanswers as $answer)
    <h3 class="title is-4">{{$answer->person->full_name}}</h3>
    @if($answer->answer_question_1)
        <h4 class="title is-6" style="margin-bottom: 10px;">{{$essay->question_1}}</h4>
        @if($essay->question_1_is_checkbox == 1)
        <ul>
            @foreach(explode(';', $answer->answer_question_1) as $subanswer)
            <li>• {{$subanswer}}</li>
            @endforeach
        </ul>
        @else
        <p>{!!nl2br($answer->answer_question_1)!!}</p>
        @endif
        <br>
    @endif
    @if($answer->answer_question_2)
        <h4 class="title is-6" style="margin-bottom: 10px;">{{$essay->question_2}}</h4>
        <p>{!!nl2br($answer->answer_question_2)!!}</p>
        <br>
    @endif
    @if($answer->answer_question_3)
        <h4 class="title is-6" style="margin-bottom: 10px;">{{$essay->question_3}}</h4>
        <p>{!!nl2br($answer->answer_question_3)!!}</p>
        <br>
    @endif
    @if($answer->answer_question_4)
        <h4 class="title is-6" style="margin-bottom: 10px;">{{$essay->question_4}}</h4>
        <p>{!!nl2br($answer->answer_question_4)!!}</p>
        <br>
    @endif
    @if($answer->has_more_documents)
        <div class="notification is-danger">
          {{$answer->person->full_name}} has more documents for this show!
        </div>
    @endif
    <br>
    <hr>
@endforeach
