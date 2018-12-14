<table class="table is-bordered is-fullwidth">
    <tr>
        <th>URL</th>
        <th>Type</th>
        <th>Name</th>
        <th>filmed by</th>
        <th>publish online</th>
        <th>publish members</th>
        <th></th>
    </tr>
    @foreach ($project->videos as $video)
        <tr>
            <td>{{$video->url}}</td>
            <td>{{$video->hyperlinktype->name}}</td>
            <td>{{$video->name}}</td>
            <td>{{$video->author}}</td>
            <td class="has-text-centered hidden-xs-down">@if($video->publish_online) <i class="fas fa-check"></i> @endif</td>
            <td class="has-text-centered hidden-xs-down">@if($video->publish_members) <i class="fas fa-check"></i> @endif</td>
            <td><button class="button is-danger">delete</button></td>
        </tr>
    @endforeach
</table>
<hr>
{{-- add new video --}}
<div v-for="(new_video, index) in new_videos" v-show="mode=='edit'">

    <div class="field">
        <label class="label">URL:</label>
        <div class="control">
            <input class="input" type="text" :name="'new_videos[' + index +'][url]'" placeholder="URL">
        </div>
    </div>
    <div class="field">
        <label class="label">Type:</label>
        <div class="control">
            <div class="select" style="width:100%;">
              <select :name="'new_videos[' + index +'][hyperlinktype_id]'">
                  <option disabled selected></option>
                @foreach($hyperlinktypes as $hyperlinktype)
                  <option value="{{$hyperlinktype->id}}">{{$hyperlinktype->name}}</option>
                @endforeach
              </select>
            </div>
        </div>
    </div>
    <div class="field">
        <label class="label">Name:</label>
        <div class="control">
            <input class="input" type="name" :name="'new_videos[' + index +'][name]'" placeholder="Name">
        </div>
    </div>
    <div class="field">
        <label class="label">Author:</label>
        <div class="control">
            <input class="input" type="author" :name="'new_videos[' + index +'][author]'" placeholder="Author">
        </div>
    </div>
    <div class="field">
      <div class="control">
        <label class="checkbox">
          <input type="checkbox" :name="'new_videos[' + index +'][publish_online]'" value=1>
          publish online
        </label>
      </div>
    </div>
    <div class="field">
      <div class="control">
        <label class="checkbox">
          <input type="checkbox" :name="'new_videos[' + index +'][publish_members]'" value=1>
          publish to CTC members
        </label>
      </div>
    </div>
    <hr>
</div>

<div>
    <a v-show="mode=='edit'" class="button is-medium" @click="addVideo" class="help">+ add video link</a>
    <button v-show="mode=='edit'" type="submit" class="button is-medium is-danger is-pulled-right" style="margin-right: 15px;">Save</button>
    <div v-show="mode=='edit'" style="height: 200px;"></div>
</div>

