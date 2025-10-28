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
            <li role="none"><a role="menuitem" href="{{ route('teacher.index') }}" class="nav-link {{ request()->routeIs('teacher.index') ? 'active' : '' }}">Home</a></li>
            <li role="none"><a role="menuitem" href="{{ route('teacher.requests.list') }}" class="nav-link {{ request()->routeIs('teacher.requests.list') ? 'active' : '' }}">Request</a></li>
            <li role="none"><a role="menuitem" href="{{ route('teacher.history') }}" class="nav-link {{ request()->routeIs('teacher.history') ? 'active' : '' }}">History</a></li>
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
    {{ $slot }}
  </main>

</body>
</html>
