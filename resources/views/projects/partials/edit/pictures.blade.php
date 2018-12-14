</form>
<h4 class="title is-5" style="margin-bottom:10px;">Show Stills:</h4>
@if($photographs['show_still']??null)
    @foreach ($photographs['show_still'] as $photograph)
        <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
    @endforeach
    <br>
    <br>
@endif
<form action="/upload-file" class="dropzone" id="upload-showpic-form" name="upload-showpic-form" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="person_id" value="{{auth_person()}}">
    <input type="hidden" name="phototype_id" value=1>
    <input type="hidden" name="project_id" value="{{$project->id}}">
    {{csrf_field()}}
    <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
</form>
<br>

<h4 class="title is-5" style="margin-bottom:10px;">Behind the Scenes:</h4>
@if($photographs['behind_the_scenes']??null)
    @foreach ($photographs['behind_the_scenes'] as $photograph)
        <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
    @endforeach
    <br>
    <br>
@endif
<form action="/upload-file" class="dropzone" id="upload-behindscenes-form" name="upload-behindscenes-form" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="person_id" value="{{auth_person()}}">
    <input type="hidden" name="phototype_id" value=2>
    <input type="hidden" name="project_id" value="{{$project->id}}">
    {{csrf_field()}}
    <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
</form>
<br>

<h4 class="title is-5" style="margin-bottom:10px;">Poster:</h4>
@if($photographs['poster']??null)
    @foreach ($photographs['poster'] as $photograph)
        <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
    @endforeach
    <br>
    <br>
@else
<form action="/upload-file" class="dropzone" id="upload-poster-form" name="upload-poster-form" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="person_id" value="{{auth_person()}}">
    <input type="hidden" name="phototype_id" value=3>
    <input type="hidden" name="project_id" value="{{$project->id}}">
    {{csrf_field()}}
    <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
</form>
<br>
@endif


<h4 class="title is-5" style="margin-bottom:10px;">Banner:</h4>
@if($photographs['banner']??null)
    @foreach ($photographs['banner'] as $photograph)
        <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
    @endforeach
    <br>
    <br>
@else
<form action="/upload-file" class="dropzone" id="upload-banner-form" name="upload-banner-form" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="person_id" value="{{auth_person()}}">
    <input type="hidden" name="phototype_id" value=4>
    <input type="hidden" name="project_id" value="{{$project->id}}">
    {{csrf_field()}}
    <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
</form>
@endif

