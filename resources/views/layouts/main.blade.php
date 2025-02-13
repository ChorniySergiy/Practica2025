<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" 
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Laravel Auth')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  </head>
  <body>

  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      @if (Route::has('login'))
        @auth
          <a class="navbar-brand" href="{{ route('dashboard') }}">Logo ({{ auth()->user()->name }})</a>
        @else
          <a class="navbar-brand" href="{{ route('home') }}">Logo</a>
        @endif
      @endif

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('home') }}">{{ __('messages.home') }}</a>
          </li>

          @if (Route::has('login'))
            @auth
              <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a></li>
              <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="nav-link btn btn-link">{{ __('messages.logout') }}</button>
                </form>
              </li>
            @else
              <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
            @endif
          @endif
        </ul>

        <!-- Перемикач мови -->
        <ul class="navbar-nav mb-2 mb-lg-0 langs">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  🌐 {{ strtoupper(app()->getLocale()) }} <!-- Відображення поточної мови -->
              </a>
              <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                  <li><a class="dropdown-item" href="{{ route('switchLang', ['locale' => 'en']) }}">🇬🇧 English</a></li>
                  <li><a class="dropdown-item" href="{{ route('switchLang', ['locale' => 'uk']) }}">🇺🇦 Українська</a></li>
              </ul>
          </li>
      </ul>

        <!--
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown">
                {{ __('messages.language') }}
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('switchLang', ['locale' => 'en']) }}">🇬🇧 English</a></li>
                <li><a class="dropdown-item" href="{{ route('switchLang', ['locale' => 'uk']) }}">🇺🇦 Українська</a></li>
            </ul>
        </li>
        -->
      </div>
    </div>
  </nav>

  <main class="main my-3">
    <div class="container">
      @yield('content')
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
