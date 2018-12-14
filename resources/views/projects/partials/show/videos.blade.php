<div class="columns is-multiline" v-show="mode=='show'">
    @foreach($project->videos as $video)
        @if ($video->publish_members)
            <div class="column is-6">
                <div class="card">
                  <div class="card-image">
                    <div class="media">
                        {!!LaravelVideoEmbed::parse($video->url);!!}
                    </div>
                  </div>
                  <div class="card-content">
                    <div class="media">
                      <div class="media-content">
                        <p class="title is-4">{{$video->name}}</p>
                        @if($video->author)
                        <p class="subtitle is-6">Filmed by {{$video->author}}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<div v-show="mode=='edit'">
    @include('projects.partials.edit.videos')
</div>

