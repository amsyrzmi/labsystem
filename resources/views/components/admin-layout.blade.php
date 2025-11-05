<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'My App')</title>

  <!-- change paths to suit your build (Vite/Mix/public) -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <header>
    <nav class="nav" aria-label="Main navigation">
      <div class="nav-row">
        <a class="brand" href="#">LabCore</a>

        <button id="navToggle"
                class="nav-toggle"
                aria-controls="navMenu"
                aria-expanded="false"
                aria-label="Toggle menu">
          <span class="sr-only">Toggle menu</span>
          <!-- simple hamburger -->
          <svg width="20" height="14" viewBox="0 0 20 14" aria-hidden="true" focusable="false">
            <rect y="0" width="20" height="2"></rect>
            <rect y="6" width="20" height="2"></rect>
            <rect y="12" width="20" height="2"></rect>
          </svg>
        </button>

        <div id="navMenu" class="nav-menu" data-open="false">
          @auth
          <ul class="nav-left" role="menubar" aria-label="Primary">
            <li role="none"><a role="menuitem" href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">Home</a></li>
            <li role="none"><a role="menuitem" href="{{ route('admin.requests') }}" class="nav-link {{ request()->routeIs('admin.requests') ? 'active' : '' }}">Request</a></li>
            <li role="none"><a role="menuitem" href="{{ route('admin.history') }}" class="nav-link {{ request()->routeIs('admin.history') ? 'active' : '' }}">History</a></li>
            <li role="none"><a role="menuitem" href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">Manage Users</a></li>
          </ul>
          @endauth

          <div class="nav-right">
            @auth
              <form action="{{ route('logout') }}" method="POST" class="inline">
              @csrf
              <button type="submit" class="nav-link logout">Logout</button>
            </form>
            @endauth
            @guest
            <a href="{{ route('show.login') }}" class="nav-link">Login</a>
            <a href="{{ route('show.register') }}" class="nav-link">Register</a>
              
            @endguest
            
            
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main class="main">
      <div id="loader"
          style="display: none;
                  position: fixed;
                  z-index: 9999;
                  top: 0; left: 0;
                  width: 100%; height: 100%;
                  background: var(--page-bg);
                  justify-content: center;
                  align-items: center;">
          <img src="{{ asset('images/loading.gif') }}" alt="Loading..." style="width:250px;">
      </div>
    {{ $slot }}
  </main>

</body>
</html>
