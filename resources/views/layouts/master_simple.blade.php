<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height: 100%;">
<head>
    <!-- Title -->
    <title>Copenhagen Theatre Circle</title>
    <!-- Head -->
    @include('layouts.partials.head')
</head>
<body>
    <!-- Wrap everything in 'app' for Vue -->
    <div id="app">
      <!-- Navbar -->


      <nav class="navbar is-dark is-fixed-top" style="background-color: #222; height: 75px;">

        <div class="container" style="max-width: 600px; padding-left: 10px;">

          {{-- Brand and Burger --}}
          <div class="navbar-brand" style="margin-right: 20px;">
            <a class="navbar-item" href="http://ctcircle.dk">
              <img src="/media/logo_dark.png">
              <h2 class="subtitle is-4 has-text-white">&nbsp;&nbsp;Copenhagen Theatre Circle</h2>
            </a>
          </div>

          {{-- Menu Items: Partials depending on login status --}}
         {{--  <div id="ctc_navbar" class="navbar-menu">
            @guest
              @include('layouts.partials.navbar_guest')
            @else
              @include('layouts.partials.navbar_user')
            @endguest
          </div> --}}

        </div>

      </nav>

      <!-- Container -->
      <div class="container" style="max-width: 600px;">

        <!-- Content Box -->
        {{-- <div class="row"> --}}
            <div class="card light-transparency" style="border-radius: 15px;">
              @yield('content')
            </div>
        {{-- </div> --}}
      </div>
    </div>

    <!-- Scripts -->
    <!-- a) Scripts packed into app.js via webpack -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- b) Scripts that should run through entire application -->
    @include('layouts.partials.footer_scripts')
    <!-- c) Scripts injected in individual views -->
    @yield('scripts')

</body>
</html>
