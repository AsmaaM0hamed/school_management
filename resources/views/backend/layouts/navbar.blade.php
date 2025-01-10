<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">{{ __('messages.home') }}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Language Switcher -->
      <li class="nav-item dropdown language-selector">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button">
          <i class="fas fa-language fa-lg"></i>
          <span class="mx-1">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
            <i class="fas fa-globe-americas"></i>
            English
          </a>
          <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
            <i class="fas fa-globe-africa"></i>
            العربية
          </a>
        </div>
      </li>

      <!-- Sign Out Button -->
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger nav-link" style="color: white; margin: 5px;">
                <i class="fas fa-sign-out-alt"></i> {{ __('messages.logout') }}
            </button>
        </form>
      </li>
    </ul>
</nav>