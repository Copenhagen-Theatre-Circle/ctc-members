<form action="/upload-photo" class="dropzone" id="{{$id}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="uploader_person_id" value="{{$uploader_person_id ?? null}}">
    <input type="hidden" name="phototype_id" value={{$phototype_id ?? null}}>
    <input type="hidden" name="project_id" value="{{$project_id ?? null}}">
    {{csrf_field()}}
    <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
</form>

