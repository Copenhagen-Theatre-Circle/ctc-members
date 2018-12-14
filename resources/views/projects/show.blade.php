@extends('layouts.master')

@section('title',$project->name)

@section('breadcrumb')
    <li><a href="/home">Home</a></li>
    <li><a href="/projects">CTCDB+</a></li>
    <li class="is-active"><a href="#">{{$project->name}}</a></li>
@endsection

@section('content')

  <div class="section" style="padding: 10px; padding-top: 20px;">

     <section class="section" style="padding: 10px;">
        <div class="columns">
          <div class="column is-2" style="padding-left: 20px;">
            <img src="http://balletmecanique.eu/ctc/media/145_medium.jpg" >
          </div>
          <div class="column" >
            <h1 class="title is-1" style="margin-bottom: 10px;">{{$project->name}}</h1>
            <h4 class="title is-5" style="margin-bottom: 10px;">by {{implode(', ', $all_authors)}}</h4>
            <h4 class="title is-5" style="margin-bottom: 10px;">{{date('d M Y',strtotime($project->date_start))}} to {{date('d M Y', strtotime($project->date_end))}}</h4>
            <h4 class="title is-5" style="margin-bottom: 10px;">{{$project->venue->name}}</h4>
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
            new_castmembers: [],
            new_crewmembers: [],
            new_videos: [],
        },
        methods:{
          changeActivePanel(selection){
            this.activePanel = selection
          },
          addCastMember() {
            this.new_castmembers.push({});
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
{{-- <script type="text/javascript">
    $('.js-basic-single').select2({
        tags: true
    });
</script> --}}

@endsection


