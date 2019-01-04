<div v-show="mode=='show'">

  @foreach($phototypes as $phototype)

    @if($photographs[$phototype->slug]??null)

      {{-- Title --}}
      <h4 class="title is-5" style="margin-bottom:10px;">{{$phototype->name}}s:</h4>

      {{-- Gallery of Uploads --}}
      @foreach ($photographs[$phototype->slug] as $photograph)
        <a href="/files/{{$photograph}}" target="_blank">
          <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
        </a>
      @endforeach
      <br>
      <br>

    @endif

  @endforeach

</div>


<div v-show="mode=='edit'">
  @include('essays.partials.edit.pictures')
</div>

