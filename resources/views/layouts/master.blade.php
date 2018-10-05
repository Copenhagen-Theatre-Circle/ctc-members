<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height: 100%;">
<head>
    <!-- Title -->
    <title>CTC Members @yield('title')</title>
    <!-- Head -->
    @include('layouts.partials.head')
</head>
<body>
    <!-- Wrap everything in 'app' for Vue -->
    <div id="app">
      <!-- Navbar -->
      @include('layouts.partials.navbar')
      <!-- Container -->
      <div class="container" style="max-width: 1140px;">
        <!-- Breadcrumb -->
        @if (empty($suppress_breadcrumb))
          @include('layouts.partials.breadcrumb')
        @endif
        <!-- Content Box -->
        <div class="row scrollbox">
          <div class="col-md-12 col-md-offset-0">
            <div class="card light-transparency" style="border-radius: 5px;">
              @yield('content')
            </div>
          </div>
        </div>
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
