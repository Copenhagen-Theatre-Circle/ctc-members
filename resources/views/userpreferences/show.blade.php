@extends('layouts.app_simple')

@section('content')

    <div class="container" id="app">
        <div class="row scrollbox">
            <div class="col-md-12 col-md-offset-0">

                <div class="card light-transparency">

                    <div class="card-body">

                        <h1>{{$person->first_name}} {{$person->last_name}}</h1>
                        <h2>Visibility and Mail Settings</h2>
                        <hr>

                        <form action="{{ route('preferences.store') }}" method="post">

                          {{ csrf_field() }}
                          <h3 class="pt-2">Profile Visibility</h3>
                            <p class="pt-3 mb-3">Who can see your profile?</p>
                            <div class="form-check">
                              <input class="form-check-input ml-0" type="radio" name="visibility" id="all_members" value="all" checked>
                              <label class="form-check-label" for="all_members">
                                all CTC members
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input ml-0" type="radio" name="visibility" id="committee_only" value="committee only">
                              <label class="form-check-label" for="committee_only">
                                only the CTC committee, plus active directors and production managers
                              </label>
                            </div>
                            <div class="form-check pb-3">
                              <input class="form-check-input ml-0" type="radio" name="visibility" id="nobody" value="nobody">
                              <label class="form-check-label" for="nobody">
                                I don't want my profile to be published at all
                              </label>
                            </div>

                        <hr>

                          <h3 class="pt-2">Bulletin Board Mails</h3>
                            <p class="pt-3 mb-3">How frequently do you want to receive mails with the latest CTC Bulletin Board posts?</p>

                            <div class="form-check">
                              <input type="text" name="" value="" v-model="frequency">
                              <input class="form-check-input ml-0" type="radio" name="bulletin_mail_frequency" id="immediately" v-model="frequency" value="immediately">
                              <label class="form-check-label" for="immediately">
                                as soon as they are written
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input ml-0" type="radio" name="bulletin_mail_frequency" id="weekly" v-model="frequency" value="weekly">
                              <label class="form-check-label" for="weekly">
                                once a week
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input ml-0" type="radio" name="bulletin_mail_frequency" id="never" v-model="frequency" value="never">
                              <label class="form-check-label" for="never">
                                I don't want to receive any bulletin board mails
                              </label>
                            </div>

                            @{{frequency}}


                            <div id="posttypes" v-if="frequency!=='never'">
                                <p class="pt-4 mb-3">Which type of bulletin board posts do you want to receive per mail?</p>

                                <div class="form-check">
                                  <input class="form-check-input ml-0" type="checkbox" name="send_CTC_help_bulletins" id="send_CTC_help_bulletins" value="1" checked>
                                  <label class="form-check-label" for="send_CTC_help_bulletins">
                                    Cast & crew wanted
                                  </label>
                                </div>

                                <div class="ml-4">
                                    <div class="form-check">
                                      <input class="form-check-input ml-0" type="radio" name="help_bulletin_scope" id="all areas" value="all areas" checked>
                                      <label class="form-check-label" for="all areas">
                                        all areas
                                      </label>
                                    </div>
                                </div>

                                <div class="ml-4">
                                    <div class="form-check">
                                      <input class="form-check-input ml-0" type="radio" name="help_bulletin_scope" id="interest only" value="interest only">
                                      <label class="form-check-label" for="interest only">
                                        only for areas where I indicated an interest in the questionnaire
                                      </label>
                                    </div>
                                </div>
                            </div>


                              {{-- <div class="form-check">
                                <input class="form-check-input ml-0" type="checkbox" name="bulletin_mail_frequency" id="weekly" value="weekly">
                                <label class="form-check-label" for="weekly">
                                  Production help wanted (non-CTC productions)
                                </label>
                              </div> --}}


                              <div class="form-check">
                                <input class="form-check-input ml-0" type="checkbox" name="send_membership_news" id="send_membership_news" value="1">
                                <label class="form-check-label" for="send_membership_news">
                                  Membership news bulletins (CTC members only)
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input ml-0" type="checkbox" name="send_blog_posts" id="send_blog_posts" value="1">
                                <label class="form-check-label" for="send_blog_posts">
                                  Blog posts
                                </label>
                              </div>
                              <div>
                                <h3>radio buttons</h3>
                                <input type="radio" v-model="color" value="0">red
                                <input type="radio" v-model="color" value="1">blue
                                <input type="radio" v-model="color" value="2">yellow
                                <br />
                                <span>value: @{{color}}</span>
                              </div>
                                <hr>
                                <button type="submit" class="btn btn-primary col-1">Save</button>



                            </form>

                          </div>

                    </div>
                </div>
            </div>
        </div>



    </div>


    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>

    var app = new Vue({
          el: '#app',
          data: {
            frequency: 'immediately',
          }
      })


    </script>


@endsection
