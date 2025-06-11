<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo -->

        <a class="navbar-logo" href="#">
            <img class="logo-image" src="{{ asset('img/logo.svg') }}" alt="Logo">
            <span class="logo-text">Medlink</span>
        </a>

        <!-- Main Navigation Menu -->
        <ul class="navbar-menu">
            <li class="navbar-item dropdown">
                <a class="navbar-link" href="#">
                    Phòng khám
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="navbar-subtitle">Bệnh viện, cơ sở y tế</div>
            </li>

            <li class="navbar-item dropdown">
                <a class="navbar-link" href="#">
                    Dịch vụ
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="navbar-subtitle">Danh sách các dịch vụ</div>
            </li>

            <li class="navbar-item">
                <a class="navbar-link" href="#">Đặt lịch</a>
                <div class="navbar-subtitle">Tư vấn bác sĩ trực tuyến</div>
            </li>

            <li class="navbar-item">
                <a class="navbar-link" href="#">Nhà thuốc</a>
                <div class="navbar-subtitle">Mua thuốc trực tuyến</div>
            </li>

            <li class="navbar-item dropdown">
                <a class="navbar-link" href="#">
                    Hỗ trợ
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="navbar-subtitle">Bác sĩ, CTV, phòng khám</div>
            </li>
        </ul>

        <!-- Search Bar -->
        <div class="navbar-search">
            <div class="search-container">
                <input class="search-input" type="text" placeholder="Search by name">
                <button class="search-button" type="submit">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Auth Buttons -->
        <div class="navbar-auth">
            @guest
                <a class="auth-button" href="{{ route('splash') }}">Đăng ký / Đăng nhập</a>
                <div class="auth-subtitle">Đăng nhập để xem kết quả</div>
            @else
                <!-- Hiển thị khi đã đăng nhập -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="auth-button" type="submit">Đăng xuất</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
