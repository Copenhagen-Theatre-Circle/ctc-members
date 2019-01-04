<div v-show="mode=='show'">

  @foreach($documenttypes as $documenttype)
    @if($documents[$documenttype->slug]??null)

      {{-- Title --}}
      <h4 class="title is-5" style="margin-bottom:10px;">{{$documenttype->name}}(s):</h4>

      {{-- Gallery of Uploads --}}
      @foreach ($documents[$documenttype->slug] as $document)
        <a href="/files/{{$document['file_name']}}" target="_blank">
          {{$document['original_file_name']}}
        </a>
      @endforeach
      <br>
      <br>

    @endif

  @endforeach

</div>


<div v-show="mode=='edit'">
  @include('essays.partials.edit.documents')
</div>

