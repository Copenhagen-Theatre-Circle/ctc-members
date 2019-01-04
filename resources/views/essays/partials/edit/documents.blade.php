</form>

@foreach($documenttypes as $documenttype)

    {{-- Title --}}
    <h4 class="title is-5" style="margin-bottom:10px;">{{$documenttype->name}}(s):</h4>

    {{-- Gallery of Uploads --}}
    @if($documents[$documenttype->slug]??null)
      @foreach ($documents[$documenttype->slug] as $document)
        {{$document['original_file_name']}}
      @endforeach
      <br>
      <br>
    @endif

    {{-- Dropzone Component --}}
    @component('components.dropzone_document', [
        'id'=>'upload-'.$documenttype->slug,
        'documenttype_id'=>$documenttype->id,
        'essaytopic_id'=>$essay->id,
        'uploader_person_id'=>auth_person(),
        ])
    @endcomponent

    <br>

@endforeach
