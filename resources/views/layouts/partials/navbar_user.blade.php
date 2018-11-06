<div class="navbar-start" style="padding-top: 5px;">
    <a class="navbar-item is-tab {{ Request::segment(1) === 'people' ? 'is-active' : null }} " href="/people">
      The Network
    </a>
    <a class="navbar-item is-tab {{ Request::segment(1) === 'accounts' ? 'is-active' : null }} " href="http://ctc-members.dk/a6de1850-21c1-4ca2-87e0-253c61bee591/seasons/" target="_blank">
      Accounts
    </a>
    <a class="navbar-item is-tab {{ Request::segment(1) === 'jubilee-book' ? 'is-active' : null }} " href="/jubilee-book">
      50th Anniversary Book
    </a>
    <a class="navbar-item is-tab {{ Request::segment(1) === 'handbooks' ? 'is-active' : null }} " href="/handbooks">
      Handbooks
    </a>
</div>
<div class="navbar-end" style="padding-top: 5px;">
    <div class="navbar-item has-dropdown is-hoverable">
      <a class="navbar-link">
        {{ Auth::user()->name }}
      </a>
      <div class="navbar-dropdown">
        <a href="/profile" class="navbar-item">
          Edit Profile
        </a>
        <a
          href="{{ route('logout') }}"
          class="navbar-item"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </div>
    </div>
</div>




