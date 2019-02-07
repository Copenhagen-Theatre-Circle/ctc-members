@extends('layouts.master')

@section('title','CTC Jubilee Book')

@section('content')

  <div class="section" style="padding: 10px; padding-top: 20px;">

     @include ('jubilee_book/step_counter', ['step'=>3])

     <section class="section" style="padding: 0px;">
        <div class="card">
            <div class="card-content">
                <div class="columns">
                    <div class="column is-3 has-background-white-bis" v-if="!save">
                        @include('jubilee_book/sidebar', ['person' => $person, 'sidebardata' => $sidebardata, 'type' => 'essay', 'id'=>$this_essay->id])
                    </div>
                    <div class="column is-3 has-background-white-bis" v-if="save" v-cloak>
                        @include('jubilee_book/sidebar_deactivated', ['person' => $person, 'sidebardata' => $sidebardata, 'type' => 'essay', 'id'=>$this_essay->id])
                    </div>
                    <div class="column" style="padding-left:2rem;padding-right:2rem;">
                      <div class="columns">
                          <div class="column is-7">
                              <h3 class="title is-3">{{$this_essay->name}}</h3>
                          </div>
                          <div class="column">
                              <h3 class="title is-4 is-pulled-right has-text-danger" style="margin-bottom: 0.5rem;" v-if="save" v-cloak>Remember to save when done!</h3>
                              <p class="help is-pulled-right">last changes saved: {{$essaytopicanswer->updated_at}}</p>
                          </div>
                      </div>

                      @if ($this_essay->description) <p> {{$this_essay->description}} </p><br> @endif

                      <form action="{{ route ('jubilee.step3_essay.store', [$person->uniqid,$this_essay->id]) }}" method="post" enctype="multipart/form-data">

                            {{csrf_field()}}

                            @if ($this_essay->question_1)

                              <div class="field">
                                <label class="label">{{$this_essay->question_1}}</label>

                                  @if ($this_essay->question_1_is_checkbox)
                                  @foreach (explode (';',$this_essay->question_1_checkbox_values) as $checkbox)
                                    <div class="control">
                                      <label class="checkbox">
                                        <input
                                          type="checkbox"
                                          name="answer_question_1[]"
                                          value="{{$checkbox}}"
                                          @if( in_array ( $checkbox , explode (';',$essaytopicanswer->answer_question_1) )) checked @endif
                                          @click="changed()"
                                        >
                                        {{$checkbox}}
                                      </label>
                                    </div>
                                  @endforeach
                                  @else
                                  <div class="control">
                                    <textarea class="textarea" placeholder="your answer" name="answer_question_1" @keydown="changed()">{{$essaytopicanswer->answer_question_1}}</textarea>
                                  </div>
                                  @endif

                              </div>
                              <br>

                            @endif

                            @if ($this_essay->question_2)

                              <div class="field">
                                <label class="label">{{$this_essay->question_2}}</label>
                                <div class="control">
                                  <textarea class="textarea" placeholder="your answer" name="answer_question_2" @keydown="changed()">{{$essaytopicanswer->answer_question_2}}</textarea>
                                </div>
                              </div>
                              <br>

                            @endif

                            @if ($this_essay->question_3)

                              <div class="field">
                                <label class="label">{{$this_essay->question_3}}</label>
                                <div class="control">
                                  <textarea class="textarea" placeholder="your answer" name="answer_question_3" @keydown="changed()">{{$essaytopicanswer->answer_question_3}}</textarea>
                                </div>
                              </div>
                              <br>

                            @endif

                            @if ($this_essay->question_4)

                              <div class="field">
                                <label class="label">{{$this_essay->question_4}}</label>
                                <div class="control">
                                  <textarea class="textarea" placeholder="your answer" name="answer_question_4" @keydown="changed()">{{$essaytopicanswer->answer_question_4}}</textarea>
                                </div>
                              </div>
                              <br>

                            @endif

                            <div class="field">
                            <label class="label">You can return to the form to edit your entry later on. However, if your entry is complete, please indicate so here.</label>
                              <div class="control">
                                <label class="checkbox">
                                  <input type="checkbox" value="1" name="completed" @if($essaytopicanswer->completed == 1) checked @endif @click="changed()">
                                  My entry for this essay is complete.
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

                            <button type="submit" class="button is-danger is-pulled-right">
                                <span class="icon">
                                    <i class="far fa-save"></i>
                                </span>
                                &nbsp; save
                            </button>

                        </form>

                        <br><br>
                        <hr>


                        <div>
                          <h4 class="subtitle is-4">Pictures, Documents and Scans</h4>
                          @if ($photographs->count()>0)
                          <div class="field">
                            <label class="label">The following files have already been uploaded for this show:</label>
                            <table class="table is-bordered">
                              @foreach ($photographs as $photograph)
                                <tr>
                                  <td>{{$photograph->original_file_name}}</td>
                                  <td>
                                    @if (is_thumbnailable($photograph->file_name))
                                      <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph->file_name}}">
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
                            <label class="label">Please upload any @if ($photographs->count()>0) other @endif relevant photographs, scans or documents here (max 10 MB). Please note that you are restricted to uploading 10 documents. If you have more than 10 documents for this show that you would like to share, please let us know on membership@ctcircle.dk.</label>
                          </div>
                          <form action="/upload-photo" class="dropzone" id="upload-file-form" name="upload-file-form" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="person_id" value="{{$person->id}}">
                            <input type="hidden" name="essaytopic_id" value="{{$this_essay->id}}">
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

<div class="modal" v-bind:class="{'is-active': showmodal}">
  <div class="modal-background"></div>
  <div class="modal-content">
    <div class="message">
        <div class="message-body">
            <p>Please save the entered text or cancel your entry before selecting another show or topic.</p>
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
<script src="{{ asset('js/dropzone.js') }}"></script>
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
            url: '/upload-photo',
            method: 'post',
            maxFilesize: 10,
            maxFiles: 10,
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

