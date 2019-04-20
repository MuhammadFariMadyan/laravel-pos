<div class="main-panel">
  <nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">@yield('content-title', 'Title')</a>
      </div>
      <div class="collapse navbar-collapse">
        {{-- <ul class="nav navbar-nav navbar-left">
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <p class="hidden-lg hidden-md">Pesan</p>
            </a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-globe"></i>
              <b class="caret hidden-sm hidden-xs"></b>
              <span class="notification hidden-sm hidden-xs">5</span>
              <p class="hidden-lg hidden-md">
                5 Notifications
                <b class="caret"></b>
              </p>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">Notification 1</a></li>
              <li><a href="#">Notification 2</a></li>
              <li><a href="#">Notification 3</a></li>
              <li><a href="#">Notification 4</a></li>
              <li><a href="#">Another notification</a></li>
            </ul>
          </li>
        </ul> --}}

        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i>
                Account
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              @if (auth()->check())
                <li>
                  <a href="#">Hallo, {{Auth::user()->name}}</a>
                </li>
                <li>
                  <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                  <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                    <i class="fa fa-sign-out"></i>
                  </a>
                </li>
                @elseif(!isset($exception))
                <li>
                  <a href="{{ route('login') }}">
                    <i class="fa fa-sign-in"></i>
                    Login
                  </a>
                </li>
                @endif
              </ul>
          </li>
          <li class="separator hidden-lg hidden-md"></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="card">
    <div class="card-body">
      @yield('breadcrumb')
    </div>
  </div>

  <div class="content">

    @yield('content')

  </div>

  @include('light-bootstrap-dashboard::layouts.main-panel.footer.main')
</div>
