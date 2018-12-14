

<nav class="navbar is-dark is-fixed-top" style="background-color: #222; height: 75px;">

  <div class="container" style="max-width: 1140px; padding-left: 10px;">

    {{-- Brand and Burger --}}
    <div class="navbar-brand" style="margin-right: 20px;">
      <a class="navbar-item" href="@guest {{url('/home')}} @else {{url('/home') }} @endguest">
        <img src="/media/logo_dark.png">
        <h2 class="subtitle is-4 has-text-white">&nbsp;&nbsp;CTC Members</h2>
      </a>
      <a role="button" class="navbar-burger burger" data-target="ctc_navbar" style="padding-top: 70px;">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    {{-- Menu Items: Partials depending on login status --}}
    <div id="ctc_navbar" class="navbar-menu">
      @guest
        @include('layouts.partials.navbar_guest')
      @else
        @include('layouts.partials.navbar_user')
      @endguest
    </div>

  </div>

</nav>


