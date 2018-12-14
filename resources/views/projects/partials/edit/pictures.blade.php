</form>
<h4 class="title is-5">Show Stills:</h4>
<form action="/upload-file" class="dropzone" id="upload-showpic-form" name="upload-showpic-form" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="person_id" value="{{auth_person()}}">
    <input type="hidden" name="phototype_id" value=1>
    <input type="hidden" name="project_id" value="{{$project->id}}">
    {{csrf_field()}}
    <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
</form>
<br>
<h4 class="title is-5">Behind the Scenes:</h4>
<form action="/upload-file" class="dropzone" id="upload-behindscenes-form" name="upload-behindscenes-form" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="person_id" value="{{auth_person()}}">
    <input type="hidden" name="phototype_id" value=2>
    <input type="hidden" name="project_id" value="{{$project->id}}">
    {{csrf_field()}}
    <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
</form>
<br>
<h4 class="title is-5">Poster:</h4>
<form action="/upload-file" class="dropzone" id="upload-poster-form" name="upload-poster-form" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="person_id" value="{{auth_person()}}">
    <input type="hidden" name="phototype_id" value=3>
    <input type="hidden" name="project_id" value="{{$project->id}}">
    {{csrf_field()}}
    <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
</form>
<br>
<h4 class="title is-5">Banner:</h4>
<form action="/upload-file" class="dropzone" id="upload-banner-form" name="upload-banner-form" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="person_id" value="{{auth_person()}}">
    <input type="hidden" name="phototype_id" value=4>
    <input type="hidden" name="project_id" value="{{$project->id}}">
    {{csrf_field()}}
    <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
</form>

