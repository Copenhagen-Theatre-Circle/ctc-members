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
                    <div class="column is-3 has-background-white-bis" v-if="!save">
                        @include('jubilee_book/sidebar', ['person' => $person, 'sidebardata' => $sidebardata, 'type' => 'show', 'id'=>$this_project->id])
                    </div>
                    <div class="column is-3 has-background-white-bis" v-if="save" v-cloak>
                        @include('jubilee_book/sidebar_deactivated', ['person' => $person, 'sidebardata' => $sidebardata, 'type' => 'show', 'id'=>$this_project->id])
                    </div>
                    <div class="column" style="padding-left:2rem;padding-right:2rem;">
                        <div class="columns">
                            <div class="column">
                                <h3 class="title is-3">{{$this_project->name}}</h3>
                                <h4 class="subtitle is-4">{{$this_project->year}}</h4>
                            </div>
                            <div class="column">
                                <h3 class="title is-4 is-pulled-right has-text-danger" style="margin-bottom: 0.5rem;" v-if="save" v-cloak>Remember to save when done!</h3>
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
                                  <input type="checkbox" value="1" name="completed" @if($projectmemory->completed == 1) checked @endif @click="changed()">
                                  My entry for this show is complete.
                                </label>
                              </div>
                            </div>
                            <br>
                            <a href="javascript:window.location.href=window.location.href" class="button is-outlined is-danger is-pulled-left" v-if="save" v-cloak>
                                <span class="icon">
                                    <i class="fas fa-ban"></i>
                                </span>
                                &nbsp; cancel changes
                            </a>

                            <button type="submit" class="button is-danger is-pulled-right" >
                                <span class="icon">
                                    <i class="far fa-save"></i>
                                </span>
                                &nbsp; save form entry
                            </button>
                        </form>
                        <br><br>
                        <hr>


                        <div>
                          <h4 class="subtitle is-4">Pictures, Documents and Scans</h4>
                          @if ($photographs->count()>0)
                          <div class="field">
                            <label class="label">You have uploaded the following files:</label>
                            <table class="table is-bordered">
                              @foreach ($photographs as $photograph)
                                <tr>
                                  <td>{{$photograph->original_file_name}}</td>
                                  <td>
                                    @if (strpos($photograph->file_name, '.jpg') or strpos($photograph->file_name, '.png') or strpos($photograph->file_name, '.gif') or strpos($photograph->file_name, '.bmp') )
                                      <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph->file_name}}">
                                      {{strpos($photograph->file_name, '.png')}}
                                    @else
                                      <img src="/files/fileicon.png">
                                    @endif
                                  </td>
                                  <td>
                                    <a class="button" href="/files/{{$photograph->file_name}}" target="_blank">view</a>
                                  </td>
                                </tr>
                              @endforeach
                            </table>
                          </div>
                          <br>
                          @endif
                          <div class="field">
                            <label class="label">Please upload any @if ($photographs->count()>0) other @endif relevant photographs, scans or documents here (max 5 MB).</label>
                          </div>
                          <form action="/upload-file" class="dropzone" id="upload-file-form" name="upload-file-form" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="person_id" value="{{$person->id}}">
                            <input type="hidden" name="project_id" value="{{$this_project->id}}">
                              {{csrf_field()}}
                              <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </div>


</div>

<div class="modal" v-bind:class="{'is-active': showmodal}">
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
<script type="text/javascript">
    Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('#upload-file-form', {
            // paramName: "files",
            url: '/upload-file',
            method: 'post',
            maxFilesize: 5,
            maxFiles: 4,
            parallelUploads: 4,
            uploadMultiple: false,
            autoProcessQueue: true,
            acceptedFiles: ".png, .jpg, .jpeg, .csv, .txt, .pdf, .doc",
            addRemoveLinks: false,
        });
        $('#btnUpload').on('click', function(){
            myDropzone.processQueue();
        });
</script>
@endsection

