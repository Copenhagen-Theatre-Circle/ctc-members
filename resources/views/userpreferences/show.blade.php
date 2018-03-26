@extends('layouts.app_simple')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">

                <div class="card light-transparency">

                    <div class="card-body">

                        <h1>{{$person->first_name}} {{$person->last_name}}</h1>
                        <h2>Visibility and Mail Settings</h2>
                        <hr class="mt-4">
                        @if ( app('request')->input('msg')=="ok" )
                          <div class="alert alert-success" role="alert">
                            Your changes have been saved!
                          </div>
                        @endif


                        <form action="{{ route('preferences.store') }}" method="post">

                          {{ csrf_field() }}
                          <input type="hidden" name="person_id" value="{{$person->id}}">
                          <input type="hidden" name="uniqid" value="{{$person->uniqid}}">
                          <h3 class="pt-2">Profile Visibility</h3>
                            <p class="pt-3 mb-3">Who can see your profile?</p>
                            <div class="form-check">
                              <input class="form-check-input ml-0" type="radio" name="visibility" id="all_members" value="all" v-model="visibility">
                              <label class="form-check-label" for="all_members">
                                all CTC members
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input ml-0" type="radio" name="visibility" id="committee_only" value="committee only" v-model="visibility">
                              <label class="form-check-label" for="committee_only">
                                only the CTC committee, plus active directors and production managers
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input ml-0" type="radio" name="visibility" id="directors_only" value="directors only" v-model="visibility">
                              <label class="form-check-label" for="directors_only">
                                only directors of shows I have applied for
                              </label>
                            </div>
                            <div class="form-check pb-3">
                              <input class="form-check-input ml-0" type="radio" name="visibility" id="nobody" value="nobody" v-model="visibility">
                              <label class="form-check-label" for="nobody">
                                I don't want my profile to be published at all
                              </label>
                            </div>

                        <hr>

                          <h3 class="pt-2">Bulletin Board Mails</h3>
                            <p class="pt-3 mb-3">How frequently do you want to receive mails with the latest CTC Bulletin Board posts?</p>

                            <div class="form-check">
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


                            <div id="posttypes" v-if="frequency!=='never'">
                                <p class="pt-4 mb-3">Which type of bulletin board posts do you want to receive per mail?</p>

                                <div class="form-check">
                                  <input type="hidden" name="send_CTC_help_bulletins" value="0">
                                  <input class="form-check-input ml-0" type="checkbox" name="send_CTC_help_bulletins" id="send_CTC_help_bulletins" value="1" v-model="send_CTC_help_bulletins">
                                  <label class="form-check-label" for="send_CTC_help_bulletins">
                                    Cast & crew wanted
                                  </label>
                                </div>

                                <div class="cast_crew" v-if="send_CTC_help_bulletins==1">
                                  <div class="ml-4">
                                      <div class="form-check">
                                        <input class="form-check-input ml-0" type="radio" name="help_bulletin_scope" id="all areas" value="all areas" v-model="help_bulletin_scope">
                                        <label class="form-check-label" for="all areas">
                                          all areas
                                        </label>
                                      </div>
                                  </div>

                                  <div class="ml-4">
                                      <div class="form-check">
                                        <input class="form-check-input ml-0" type="radio" name="help_bulletin_scope" id="interest only" value="interest only" v-model="help_bulletin_scope">
                                        <label class="form-check-label" for="interest only">
                                          only for areas where I indicated an interest in the <a href="https://ctc-members.dk/questionnaire/?p={{$person->uniqid}}" target="_blank">questionnaire</a>
                                        </label>
                                      </div>
                                  </div>
                                </div>


                                <div class="form-check">
                                  <input type="hidden" name="send_membership_news" value="0">
                                  <input class="form-check-input ml-0" type="checkbox" name="send_membership_news" id="send_membership_news" value="1" v-model="send_membership_news">
                                  <label class="form-check-label" for="send_membership_news">
                                    Membership news bulletins (CTC members only)
                                  </label>
                                </div>

                                <div class="form-check">
                                  <input type="hidden" name="send_blog_posts" value="0">
                                  <input class="form-check-input ml-0" type="checkbox" name="send_blog_posts" id="send_blog_posts" value="1" v-model="send_blog_posts">
                                  <label class="form-check-label" for="send_blog_posts">
                                    Blog posts
                                  </label>
                                </div>

                              </div>

                            <div class="mt-4 mb-4 text-danger" id="posttypes" v-if="frequency=='never' && visibility=='nobody'">
                              <hr>
                                <p class="pt-2 mb-3">Given your answers above, it looks like you don't want to be a part of the CTC Network.</p>
                                <p>Do you want us to remove you from our database?</p>
                                <div class="form-check">
                                  <input class="form-check-input ml-0" type="checkbox" name="remove_data" id="remove_data" value="1" v-model="remove_data">
                                  <label class="form-check-label text-dark" for="remove_data">
                                    Please remove me entirely from the CTC database.
                                  </label>
                                </div>



                            </div>

                                <hr class="mt-3 pb-2">
                                <button type="submit" class="btn btn-primary col-1">Save</button>


                            </form>



                          </div>

                    </div>
                </div>
            </div>
        </div>



    </div>


    <script>

    var app = new Vue({
          el: '#app',
          data: {
            visibility: '{{$userpreference->visibility or 'all'}}',
            frequency: '{{$userpreference->bulletin_mail_frequency or 'immediately'}}',
            send_CTC_help_bulletins: {{$userpreference->send_CTC_help_bulletins or 1}},
            send_membership_news: {{$userpreference->send_membership_news or 1}},
            send_blog_posts: {{$userpreference->send_blog_posts or 1}},
            help_bulletin_scope: '{{$userpreference->help_bulletin_scope or 'interest only'}}',
            remove_data: {{$userpreference->remove_data or 0}},
          }
      })


    </script>


@endsection
