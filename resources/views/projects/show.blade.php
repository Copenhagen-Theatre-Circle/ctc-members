@extends('layouts.master')

@section('title',$project->name)

@section('breadcrumb')
    <li><a href="/home">Home</a></li>
    <li><a href="/projects">CTCDB+</a></li>
    <li class="is-active"><a href="#">{{$project->name}}+</a></li>
@endsection

@section('content')

  <div class="section" style="padding: 10px; padding-top: 20px;">

     <section class="section" style="padding: 10px;">
        <div class="columns">
          <div class="column is-2" style="padding-left: 20px;">
            <img src="http://balletmecanique.eu/ctc/media/145_medium.jpg" >
          </div>
          <div class="column" >
            <h1 class="title is-1">{{$project->name}}</h1>
            <h4 class="title is-4">{{$project->date_start}} to {{$project->date_end}}</h4>
          </div>
        </div>
        <div class="card">
            <div class="card-content" style="padding: 0.8rem !important;">
                <div class="columns">
                    <div class="column is-2 has-background-white-bis">
                        @include('projects.partials.sidebar')
                    </div>
                    <div class="column" style="padding-left:2rem;padding-right:2rem;">
                      {{-- show panels --}}
                      @foreach ($panels as $key=>$panel)
                        <div v-if="mode=='show' && activePanel=='{{$key}}'" @if($key!='basics') v-cloak @endif >@include('projects.partials.show.'.$key)</div>
                      @endforeach
                      {{-- edit panels --}}
                      <form action="{{$project->id}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        @foreach ($panels as $key=>$panel)
                          <div v-show="mode=='edit' && activePanel=='{{$key}}'" v-cloak>@include('projects.partials.edit.'.$key)</div>
                        @endforeach
                      </form>
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
            activePanel: 'basics',
        },
        methods:{
          changeActivePanel(selection){
            this.activePanel = selection
          }
        }
    });
</script>
@endsection


