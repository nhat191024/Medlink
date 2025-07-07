<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo -->

        <a class="navbar-logo" href="#">
            <img class="logo-image" src="{{ asset('img/logo.svg') }}" alt="Logo">
            <span class="logo-text">Medlink</span>
        </a>

        <!-- Main Navigation Menu -->
        <ul class="navbar-menu">
            <li class="navbar-item nav-dropdown">
                <a class="navbar-link" href="#">{{ __('client/navbar.menu.home') }}</a>
                <div class="navbar-subtitle">{{ __('client/navbar.subtitle.home') }}</div>
            </li>

            <li class="navbar-item nav-dropdown">
                <a class="navbar-link" href="#">
                    {{ __('client/navbar.menu.services') }}
                    <span class="nav-dropdown-arrow">
                        @svg('heroicon-o-chevron-down', 'nav-dropdown-icon', ['style' => 'width: 16px; height: 16px; color: #888;'])
                    </span>
                </a>
                <div class="navbar-subtitle">
                    {{ __('client/navbar.subtitle.services') }}
                </div>
            </li>

            <li class="navbar-item">
                <a class="navbar-link" href="#">{{ __('client/navbar.menu.doctor_consultation') }}</a>
                <div class="navbar-subtitle">{{ __('client/navbar.subtitle.doctor_consultation') }}</div>
            </li>

            <li class="navbar-item">
                <a class="navbar-link" href="#">{{ __('client/navbar.menu.pharmacy') }}</a>
                <div class="navbar-subtitle">
                    {{ __('client/navbar.subtitle.pharmacy') }}
                </div>
            </li>

            <li class="navbar-item nav-dropdown">
                <a class="navbar-link" href="#">
                    {{ __('client/navbar.menu.support') }}
                    <span class="nav-dropdown-arrow">
                        @svg('heroicon-o-chevron-down', 'nav-dropdown-icon', ['style' => 'width: 16px; height: 16px; color: #888;'])
                    </span>
                </a>
                <div class="navbar-subtitle">{{ __('client/navbar.subtitle.support') }}</div>
            </li>
        </ul>

        <!-- Auth Buttons -->
        <div class="navbar-auth">
            @guest
                <a class="auth-button" href="{{ route('splash') }}">{{ __('client/navbar.button.login') }} /
                    {{ __('client/navbar.button.register') }}</a>
            @else
                <!-- Hiển thị khi đã đăng nhập -->
                <form method="POST" action="#">
                    @csrf
                    <button class="auth-button" type="submit">{{ __('client/navbar.button.logout') }}</button>
                </form>
            @endguest
        </div>
    </div>
</nav>