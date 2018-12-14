<div v-show="mode=='show'">
  <h4 class="title is-5">Show Stills:</h4>
  @foreach ($photographs['show_still'] as $photograph)
    <a href="/files/{{$photograph}}" target="_blank">
      <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
    </a>
  @endforeach
</div>

