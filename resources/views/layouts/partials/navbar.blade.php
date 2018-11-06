<nav class="navbar is-dark is-fixed-top" style="background-color: #222; height: 75px;">

  <div class="container" style="max-width: 1140px; padding-left: 10px;">

    {{-- Brand and Burger --}}
    <div class="navbar-brand">
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



  {{-- <div class="container">

    <a class="navbar-brand" href="@guest {{url('/home')}} @else {{url('/home') }} @endguest">
      <img src="/media/logo_dark.png" style="display: inline; width: 37px;"/>
        &nbsp; CTC Members
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @guest
          @include('layouts.partials.navbar_guest')
        @else
          @include('layouts.partials.navbar_user')
        @endguest
        </ul>
    </div>

  </div> --}}

</nav>
