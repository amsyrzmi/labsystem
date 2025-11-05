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
  <header class="hide-on-load">
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

          <div class="nav-right">
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
      <div id="loader">
          <img src="{{ asset('images/Authloading.gif') }}" alt="Loading..." style="width:250px;">
      </div>
    {{ $slot }}
  </main>

</body>
</html>
