<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height: 100%;">
<head>
    <!-- Title -->
    <title>CTC Members – @yield('title')</title>
    <!-- Head -->
    <script src="{{ mix('/js/app_project_spa.js') }}" defer></script>
    <link href="{{ asset('css/bulma_app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master_bulma.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Wrap everything in 'app' for Vue -->
    <div id="app">
      <!-- Navbar -->
      @include('layouts.partials.navbar')
      <!-- Container -->
      <div class="container" style="max-width: 1140px;">
        <!-- Breadcrumb -->
        <div class="card light-transparency" style="border-radius: 5px; padding: 10px; margin-bottom: 10px;">
          <nav class="breadcrumb" aria-label="breadcrumbs">
            <ul>
             <li><a href="/home">Home</a></li>
             <li><a href="/projects">CTCDB+</a></li>
             <li class="is-active"><a href="#">{{$project->name}}</a></li>
             @if (user_can_edit_ctcdb())
                 <a class="button is-small is-danger is-outlined" href="https://trello.com/b/XHtATnxU/ctcdb" target="_blank" style="margin-left: 35%;">report bugs / feature requests (Trello)</a>
             @endif
            </ul>
          </nav>
        </div>
        <!-- Content Box -->
        {{-- <div class="row"> --}}
            <div class="card light-transparency" style="border-radius: 5px;">
              @yield('content')
            </div>
        {{-- </div> --}}
      </div>
    </div>

    <!-- Scripts injected in individual views -->
    @yield('scripts')

</body>
</html>
