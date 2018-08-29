@extends('layouts.app_simple_bulma')

@section('title','CTC Jubilee Book')

@section('content')

<div class="container">

  @include('jubilee_book/navbar')

  <div class="section" style="padding: 10px; padding-top: 20px;">
     @include ('jubilee_book/step_counter', ['step'=>3])

     <section class="section" style="padding: 0px;">
        <div class="card">
            <div class="card-content">
                <div class="columns">
                    <div class="column is-3 has-background-white-bis">
                        <nav class="menu">
                            <ul class="menu-list">
                                <li>
                                    <a href="../../step-3">
                                        <span class="icon">
                                            <i class="fas fa-align-justify"></i>
                                        </span>
                                        Instructions for Step 3
                                    </a>
                                </li>
                                <hr>
                                <p class="menu-label">
                                    Select a Show:
                                </p>
                                @foreach ($projects as $project)
                                    <li>
                                        <a href="../{{$project->id}}/edit" @if ($project->id == $this_project->id) class='is-active' @endif v-if="!save">
                                            <span class="icon @if ($project->id != $this_project->id) has-text-success @endif ">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            {{$project->name}}
                                        </a>
                                        <a @if ($project->id == $this_project->id) class='is-active' @endif v-if="save" @click="modal()">
                                            <span class="icon @if ($project->id != $this_project->id) has-text-success @endif ">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            {{$project->name}}
                                        </a>
                                    </li>
                                @endforeach
                                <hr>

                            </ul>
                        </nav>
                    </div>
                    <div class="column" style="padding-left:2rem;padding-right:2rem;">
                        <div class="columns">
                            <div class="column">
                                <h3 class="title is-3">{{$this_project->name}}</h3>
                                <h4 class="subtitle is-4">{{$this_project->year}}</h4>
                            </div>
                            <div class="column">
                                <h3 class="title is-4 is-pulled-right has-text-danger" style="margin-bottom: 0.5rem;" v-if="save">Remember to save when done!</h3>
                                <p class="is-pulled-right">last changes saved: {{$projectmemory->updated_at}}</p>
                            </div>
                        </div>

                    <form action="{{ route ('jubilee.step3.store', [$person->uniqid,$this_project->id]) }}" method="post" enctype="multipart/form-data">

                        {{csrf_field()}}

                        <div class="field">
                          <label class="label">What was your level of participation in this show (cast, crew, audience, other)?</label>
                          <div class="control">
                            <textarea class="textarea" placeholder="your answer" name="participation_level" @keydown="changed()">{{$projectmemory->participation_level}}</textarea>
                          </div>
                        </div>
                        <br>

                        <div class="field">
                          <label class="label">What do you remember most about putting this production together? Why did we choose to do this show? What was it like backstage? What were some challenges the production faced?</label>
                          <p class="help">(Please be specific and share detailed stories.)</p>
                          <div class="control">
                            <textarea class="textarea" placeholder="your answer" name="production_memories" @keydown="changed()">{{$projectmemory->production_memories}}</textarea>
                          </div>
                        </div>
                        <br>

                        <div class="field">
                          <label class="label">What do you remember most about the performance(s)? Do any particular performers, scenes, songs, etc. stand out to you now and why? How did you feel on opening night? What about on closing night?</label>
                          <div class="control">
                            <textarea class="textarea" placeholder="your answer" name="performance_memories" @keydown="changed()">{{$projectmemory->performance_memories}}</textarea>
                          </div>
                        </div>
                        <br>

                        <div class="field">
                        <label class="label">You can return to the form to edit your entry later on. However, if your entry is complete, please indicate so here.</label>
                          <div class="control">
                            <label class="checkbox">
                              <input type="checkbox" name="completed" @if($projectmemory->completed == 1) checked @endif >
                              My entry for this show is complete.
                            </label>
                          </div>
                        </div>

                        <hr>

                        <a href="javascript:window.location.href=window.location.href" class="button is-outlined is-danger is-pulled-left" v-if="save">
                            <span class="icon">
                                <i class="far fa-ban"></i>
                            </span>
                            &nbsp; cancel changes
                        </a>

                        <button type="submit" class="button is-danger is-pulled-right">
                            <span class="icon">
                                <i class="far fa-save"></i>
                            </span>
                            &nbsp; save
                        </button>

                    </form>
                    <br>
                </div>
                </div>
            </div>
        </div>
    </section>

  </div>


</div>

<div class="modal is-active" v-if="showmodal">
  <div class="modal-background"></div>
  <div class="modal-content">
    <div class="message">
        <div class="message-body">
            <p>Please save the entered text or cancel your entry before selecting another show.</p>
            <br>
            <a class="button is-pulled-left" @click="modal()">OK</a>
            <br>
            <br>
        </div>
    </div>
  </div>
  <button class="modal-close is-large"></button>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    const app = new Vue({
        el: '#app',
        data:{
            save: false,
            showmodal: false,
        },
        methods:{
          changed(){
            this.save = true
          },
          modal(){
            this.showmodal = !this.showmodal
          }
        }
    });
</script>
@endsection

