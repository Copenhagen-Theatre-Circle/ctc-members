

        {{-- If the guest name is passed on in the controller,  --}}
        {{-- even though the user is not logged in (e.g. through deep link) --}}
        @if(!empty($guest_name))
            <div class="navbar-start" style="padding-top: 5px;">
                <a class="navbar-item">
                  {{$navbar_title ?? ''}}
                </a>
            </div>
            <div class="navbar-end" style="padding-top: 5px;">
                <div class="navbar-item has-dropdown is-hoverable">
                  <a class="navbar-link">
                    {{$guest_name}}
                  </a>
                  <div class="navbar-dropdown">
                    <a href="{{ route('register') }}" class="navbar-item">
                      Register
                    </a>
                    <a href="{{ route('login') }}" class="navbar-item">
                      Login
                    </a>
                  </div>
                </div>
            </div>

        {{-- Default Scenario for Guest  --}}
        @else
            <div class="navbar-end" style="padding-top: 5px;">
                <a href="{{ route('register') }}" class="navbar-item">
                  Register
                </a>
                <a href="{{ route('login') }}" class="navbar-item">
                  Login
                </a>
            </div>
        @endif

  </div>
