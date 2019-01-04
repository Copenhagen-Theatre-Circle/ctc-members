<form action="/upload-document" class="dropzone" id="{{$id}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="uploader_person_id" value="{{$uploader_person_id ?? null}}">
    <input type="hidden" name="documenttype_id" value={{$documenttype_id ?? null}}>
    <input type="hidden" name="project_id" value="{{$project_id ?? null}}">
    <input type="hidden" name="essaytopic_id" value="{{$essaytopic_id ?? null}}">
    {{csrf_field()}}
    <div class="dz-message" data-dz-message><span>Drop files here or click to upload.</span></div>
</form>

