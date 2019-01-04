@extends('layouts.master')

@section('title',$essay->name)

@section('breadcrumb')
    <li><a href="/home">Home</a></li>
    <li><a href="/essays">Book Essays</a></li>
    <li class="is-active"><a href="#">{{$essay->name}}</a></li>
@endsection

@section('content')

  <div class="section" style="padding: 10px; padding-top: 20px;">

     <section class="section" style="padding: 10px;">
        <div class="columns">
            <div class="column is-2" style="padding-left: 20px;">
                <img src="/media/book_50.png" class="img-fluid">
            </div>
          <div class="column" >
            <h1 class="title is-1" style="padding-top: 1.8rem; margin-bottom: 10px;">{{$essay->name}}</h1>
          </div>
        </div>
        <div class="card">
            <div class="card-content" style="padding: 0.8rem !important;">
                <div class="columns">
                    <div class="column is-2-widescreen is-3-desktop is-3-tablet has-background-white-bis">
                        @include('essays.partials.sidebar')
                    </div>
                    <div class="column" style="padding-left:2%;padding-right:2%;" {{-- :class="{ 'tinted-background': mode=='edit' }" --}}>
                      {{-- show panels --}}
                      <form action="{{$essay->id}}" method="post" id="form">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <input name="project_id" type="hidden" value="{{$essay->id}}">
                        @foreach ($panels as $key=>$panel)
                          <div v-show="activePanel=='{{$key}}'" v-cloak >@include('essays.partials.show.'.$key)</div>
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
            activePanel: '{{request()->input('panel') ?? 'testimonies'}}',
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
<script src="{{ asset('js/dropzone.js') }}"></script>

@endsection


