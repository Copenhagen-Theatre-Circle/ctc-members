<div class="field">
  <label class="label">Year</label>
  <div class="control">
    <input class="input" type="text" placeholder="Text input" value="{{$project->year}}" name="year">
  </div>
</div>

<div class="field">
  <label class="label">Number of Performances</label>
  <div class="control">
    <input class="input" type="text" placeholder="Text input" value="{{$project->number_of_performances}}" name="number_of_performances">
  </div>
</div>

<div class="field">
  <label class="label">Date Start (YYYY-MM-DD)</label>
  <div class="control">
    <input class="input" type="text" placeholder="Text input" value="{{$project->date_start}}" name="date_start">
  </div>
</div>

<div class="field">
  <label class="label">Date End (YYYY-MM-DD)</label>
  <div class="control">
    <input class="input" type="text" placeholder="Text input" value="{{$project->date_end}}" name="date_end">
  </div>
</div>

<div class="field">
  <label class="label">Season</label>
  <div class="control">
    <div class="select">
      <select name="season_id">
        <option disabled selected></option>
        @foreach ($seasons as $season)
            <option value={{$season->id}} @if($season->id == $project->season_id) selected @endif >{{$season->year_start}} / {{$season->year_start+1}}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>

<div class="field">
  <label class="label">Venue</label>
  <div class="control">
        <div class="select">
            <select name="venue_id">
                <option disabled selected></option>
                @foreach ($venues as $venue)
                    <option value={{$venue->id}} @if($venue->id == $project->venue_id) selected @endif >{{$venue->name}}</option>
                @endforeach
            </select>
        </div>
  </div>
</div>

@foreach ($project->projects_plays as $projects_play)
    @if(count($project->projects_plays)>1)
        <h5 class="title is-4" style="padding-top:20px;"><u>{{$projects_play->play->title}}</u></h5>
    @endif
    <div class="field">
      <label class="label">
        @if(count($project->projects_plays)>1)
          Synopsis: {{$projects_play->play->title}}
        @else
          Synopsis
        @endif
      </label>
      <div class="control">
        <textarea class="textarea" placeholder="Textarea" rows=10 name="projects_plays[{{$projects_play->id}}][synopsis_programme]">{{$projects_play->synopsis_programme}}</textarea>
      </div>
    </div>

    <div class="field">
      <label class="label">
        @if(count($project->projects_plays)>1)
          Director's Statement: {{$projects_play->play->title}}
        @else
          Director's Statement
        @endif
      </label>
      <div class="control">
        <textarea class="textarea" placeholder="Textarea" rows=10 name="projects_plays[{{$projects_play->id}}][directors_statement]">{{$projects_play->directors_statement}}</textarea>
      </div>
    </div>
@endforeach

<div class="field">
    <label class="label">Publication Settings</label>
  <div class="control">
    <label class="checkbox">
      <input type="checkbox" @if($project->publish_online) checked @endif name="publish_online" value=1>
      publish online
    </label>
  </div>
</div>

<div class="field">
  <div class="control">
    <label class="checkbox">
      <input type="checkbox" @if($project->publish_book) checked @endif name="publish_book" value=1>
      publish in book
    </label>
  </div>
</div>

<div class="field">
  <div class="control">
    <label class="checkbox">
      <input type="checkbox" @if($project->publish_members) checked @endif name="publish_members" value=1>
      publish to CTC Members
    </label>
  </div>
</div>
<hr>
<div class="field is-grouped">
  <div class="control">
    <button class="button is-link">Submit</button>
  </div>
</div>
