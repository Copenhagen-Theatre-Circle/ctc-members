@foreach ($project->projectmemories as $memory)
    <h3 class="title is-4">{{$memory->person->full_name}}</h3>
    @if($memory->participation_level)
        <h4 class="title is-6" style="margin-bottom: 10px;">Participation Level</h4>
        <p>{!!nl2br($memory->participation_level)!!}</p>
        <br>
    @endif
    @if($memory->production_memories)
        <h4 class="title is-6" style="margin-bottom: 10px;">Memories of the Production</h4>
        <p>{!!nl2br($memory->production_memories)!!}</p>
        <br>
    @endif
    @if($memory->production_memories)
        <h4 class="title is-6" style="margin-bottom: 10px;">Memories of the Performances</h4>
        <p>{!!nl2br($memory->performance_memories)!!}</p>
        <br>
    @endif
    @if($memory->has_more_documents)
        <div class="notification is-danger">
          {{$memory->person->full_name}} has more documents for this show!
        </div>
    @endif
    <br>
    <hr>
@endforeach
