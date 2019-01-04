</form>

@foreach($phototypes as $phototype)

    {{-- Title --}}
    <h4 class="title is-5" style="margin-bottom:10px;">{{$phototype->name}}s:</h4>

    {{-- Gallery of Uploads --}}
    @if($photographs[$phototype->slug]??null)
        @foreach ($photographs[$phototype->slug] as $photograph)
            <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
        @endforeach
        <br>
        <br>
    @endif

    {{-- Dropzone Component --}}
    @component('components.dropzone_image', [
        'id'=>'upload-'.$phototype->slug,
        'phototype_id'=>$phototype->id,
        'project_id'=>$project->id,
        'uploader_person_id'=>auth_person(),
        ])
    @endcomponent

    <br>

@endforeach
