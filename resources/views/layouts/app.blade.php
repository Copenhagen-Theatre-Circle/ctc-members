<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CTC Members') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>

</head>
<body>
    <div id="app">

      <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #222;">
        <div class="container">


        {{-- <a class="navbar-brand" href="#">CTC Members</a> --}}

        <a class="navbar-brand" href="@guest {{url('/home')}} @else {{url('/home') }} @endguest">
          <img src="/media/logo_dark.png" style="display: inline; width: 37px;"/>
            &nbsp; {{ config('app.name', 'CTC Members') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">

            <!-- Authentication Links -->
            @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="/membership">
                    The Network
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="http://ctc-members.dk/a6de1850-21c1-4ca2-87e0-253c61bee591/seasons/" target="_blank">
                    Accounts
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Bulletin Board</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/handbooks">Handbooks</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/projects">CTCDB+</a>
              </li>
              <li class="nav-item">
                <!-- Display only to admins -->
                @if (Auth::user()->person->is_superuser == 1 || Auth::user()->person->is_admin == 1)
                  <a class="nav-link" href="/rebate-codes">Rebate Codes</a>
                @endif
              </li>
              <li class="nav-item dropdown">

                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="/profile">
                              Edit Profile
                          </a>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                              Logout
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>

                  </div>
              </li>

              @endguest

            </ul>
          </div>

          </div>

        </nav>


        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')

</body>
</html>
