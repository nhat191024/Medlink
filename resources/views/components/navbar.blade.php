<nav class="navbar">
    <div class="navbar-container">
        <!-- Main Navigation Menu -->
        <div class="navbar-menu">
            <div class="navbar-item dropdown">
                <a class="navbar-link" href="#">
                    Phòng khám
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="navbar-subtitle">Bệnh viện, cơ sở y tế</div>
            </div>

            <div class="navbar-item dropdown">
                <a class="navbar-link" href="#">
                    Dịch vụ
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="navbar-subtitle">Danh sách các dịch vụ</div>
            </div>

            <div class="navbar-item">
                <a class="navbar-link" href="#">Đặt lịch</a>
                <div class="navbar-subtitle">Tư vấn bác sĩ trực tuyến</div>
            </div>

            <div class="navbar-item">
                <a class="navbar-link" href="#">Nhà thuốc</a>
                <div class="navbar-subtitle">Mua thuốc trực tuyến</div>
            </div>

            <div class="navbar-item dropdown">
                <a class="navbar-link" href="#">
                    Hỗ trợ
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="navbar-subtitle">Bác sĩ, CTV, phòng khám</div>
            </div>
        </div>

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
                <a class="auth-button login-btn" href="{{ route('login') }}">Đăng ký / Đăng nhập</a>
                <div class="auth-subtitle">Đăng nhập để xem kết quả</div>
            @else
                <!-- Hiển thị khi đã đăng nhập -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="auth-button login-btn">Đăng xuất</button>
                </form>
            @endguest
        </div>
    </div>
</nav>