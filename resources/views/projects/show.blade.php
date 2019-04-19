@extends('layouts.master')

@section('title',$project->name)

@section('breadcrumb')
    <li><a href="/home">Home</a></li>
    <li><a href="/projects">CTCDB+</a></li>
    <li class="is-active"><a href="#">{{$project->name}}</a></li>
    @if (user_can_edit_ctcdb())
        <a class="button is-small is-danger is-outlined" href="https://trello.com/b/XHtATnxU/ctcdb" target="_blank" style="margin-left: 35%;">report bugs / feature requests (Trello)</a>
    @endif

@endsection

@section('content')

  <script src="{{ asset('js/dropzone.js') }}"></script>

  <div class="section" style="padding: 10px; padding-top: 20px;">

     <section class="section" style="padding: 10px;">
        <div class="columns">
          <div class="column is-2" style="padding-left: 20px;">
            @if($photographs['poster']??null)
                <a href="/files/{{$photographs['poster'][0]}}" target="_blank">
                  <img src="https://res.cloudinary.com/ctcircle/image/fetch/w_200/https://ctc-members.dk/files/{{$photographs['poster'][0]}}">
                </a>
              <br>
              <br>
            @endif
          </div>
          <div class="column" >
            <h1 class="title is-1" style="margin-bottom: 10px;">{{$project->name}}</h1>
            @if ($all_authors)
              <h4 class="title is-5" style="margin-bottom: 10px;">by {{implode(', ', $all_authors)}}</h4>
            @endif
            <h4 class="title is-5" style="margin-bottom: 10px;">{{date('d M Y',strtotime($project->date_start))}} to {{date('d M Y', strtotime($project->date_end))}}</h4>
            <h4 class="title is-5" style="margin-bottom: 10px;">{{$project->venue->name ?? ''}}</h4>
          </div>
        </div>
        <div class="card">
            <div class="card-content" style="padding: 0.8rem !important;">
                <div class="columns">
                    <div class="column is-2-widescreen is-3-desktop is-3-tablet has-background-white-bis">
                        @include('projects.partials.sidebar')
                    </div>
                    <div class="column" style="padding-left:2%;padding-right:2%;" {{-- :class="{ 'tinted-background': mode=='edit' }" --}}>
                      {{-- show panels --}}
                      <form action="{{$project->id}}" method="post" id="form">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <input name="project_id" type="hidden" value="{{$project->id}}">
                        @foreach ($panels as $key=>$panel)
                          <div v-show="activePanel=='{{$key}}'" v-cloak >@include('projects.partials.show.'.$key)</div>
                        @endforeach
                      </form>
                      {{-- edit panels --}}

{{--                         @foreach ($panels as $key=>$panel)
                          <div v-show="mode=='edit' && activePanel=='{{$key}}'" v-cloak>@include('projects.partials.edit.'.$key)</div>
                        @endforeach --}}

                    </div>
                </div>
            </div>
        </div>
     </section>

  </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        const app = new Vue({
            el: '#app',
            data:{
                mode: 'show',
                activePanel: '{{request()->input('panel') ?? 'basics'}}',
                actors: {!! json_encode($actors) !!},
                crewmembers: {!! json_encode($crewmembers) !!},
                @foreach ($project->projects_plays as $project_play)
                  new_castmembers_{{$project_play->id}}: [],
                @endforeach
                new_crewmembers: [],
                new_videos: [],
            },
            methods:{
              changeActivePanel(selection){
                this.activePanel = selection
              },
              addCastMember(projectplay_id) {
                objectName = 'new_castmembers_' + projectplay_id;
                this[objectName].push({});
                $(document).ready(function() {
                        $('.js-basic-single').select2({
                            tags: true
                        });
                    });
              },
              addCrewMember() {
                this.new_crewmembers.push({});
                $(document).ready(function() {
                        $('.js-basic-single').select2({
                            tags: true
                        });
                        $('.js-basic-single-notags').select2({
                            tags: false
                        });
                    });
              },
              addVideo() {
                this.new_videos.push({});
              },
              submitForm(){
                document.getElementById("form").submit();
              },
              deleteActor: function(project_play_id, actor_id, row){
                axios
                  .delete('/actors/'+actor_id)
                  .then(document.getElementById(project_play_id).deleteRow(row-1));
              },
              deleteNewActor: function(projectplay_id, index){
                objectName = 'new_castmembers_' + projectplay_id;
                this.$delete(this[objectName], index);
              },
              deleteCrewmember: function(id, key){
                axios
                  .delete('/crewmembers/'+ id)
                  .then(this.$delete(this.crewmembers, key));
              },
              deleteNewCrewmember: function(index){
                this.$delete(this.new_crewmembers, index);
              }
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-basic-single').select2({
                tags: true
            });
        });
    </script>

    {{-- include a Dropzone Instantiation for each image Dropzone --}}
    @foreach($phototypes as $phototype)
        @include('components.dropzone_image_scriptblock',['id'=>'upload-'.$phototype->slug])
    @endforeach

    {{-- include a Dropzone Instantiation for each document Dropzone --}}
    @foreach($documenttypes as $documenttype)
        @include('components.dropzone_document_scriptblock',['id'=>'upload-'.$documenttype->slug])
    @endforeach

@endsection


