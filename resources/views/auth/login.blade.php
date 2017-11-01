@extends('layouts.app')

@section('content')
<div>
  <div class="container mt-5">
      <div class="row center-vertically">
          <div class="col-lg-6 col-md-8 mx-auto">
              <div class="card">
                  <div class="card-header">
                    <div class="col">
                      Login
                    </div>
                  </div>

                  <div class="card-body">
                      <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label for="email" class="col control-label">E-Mail Address</label>

                              <div class="col">
                                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                  @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                              <label for="password" class="col control-label">Password</label>

                              <div class="col">
                                  <input id="password" type="password" class="form-control" name="password" required>

                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                      </label>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col">
                                  <button type="submit" class="btn btn-primary">
                                      Login
                                  </button>

                                  <a class="btn btn-link" href="{{ route('password.request') }}">
                                      Forgot Your Password?
                                  </a>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
