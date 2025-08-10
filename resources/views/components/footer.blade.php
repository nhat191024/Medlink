<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h4 class="footer-title">{{ __('client/footer.menu.service') }}</h4>
            <ul>
                <li>{{ __('client/footer.menu.services.service1') }}</li>
                <li>{{ __('client/footer.menu.services.service2') }}</li>
                <li>{{ __('client/footer.menu.services.service3') }}</li>
                <li>{{ __('client/footer.menu.services.service4') }}</li>
            </ul>
        </div>
        <div class="footer-section">
            <h4 class="footer-title">{{ __('client/footer.menu.information') }}</h4>
            <ul>
                <li>{{ __('client/footer.menu.informations.information1') }}</li>
                <li>{{ __('client/footer.menu.informations.information2') }}</li>
                <li>{{ __('client/footer.menu.informations.information3') }}</li>
            </ul>
        </div>
        <div class="footer-section">
            <h4 class="footer-title">{{ __('client/footer.menu.extra') }}</h4>
            <ul>
                <li>{{ __('client/footer.menu.extras.extra1') }}</li>
                <li>{{ __('client/footer.menu.extras.extra2') }}</li>
                <li>{{ __('client/footer.menu.extras.extra3') }}</li>
                <li>{{ __('client/footer.menu.extras.extra4') }}</li>
            </ul>
        </div>
        <div class="footer-section footer-connect">
            <h4 class="footer-title">{{ __('client/footer.menu.connect_with_us') }}</h4>
            <div class="footer-social">
                <x-bi-facebook class="footer-icon" style="font-size: 2rem; color: #1877f3;" />
                <x-bi-youtube class="footer-icon" style="font-size: 2rem; color: #ff0000ff;" />
            </div>
            <div class="footer-apps">
                <img class="footer-app-img" src="{{ asset('img/AppStore.png') }}" alt="App Store" />
                <img class="footer-app-img" src="{{ asset('img/GooglePlay.png') }}" alt="Google Play" />
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div>
            <strong>{{ __('client/footer.menu.contact') }}</strong><br>
            {{ __('client/footer.menu.email') }}: hotro@medlink.vn<br>
            {{ __('client/footer.menu.hotline') }}: 1900 100ó
        </div>
        <div>
            <strong>{{ __('client/footer.menu.headquarters') }}</strong><br>
            {{ __('client/footer.menu.address.address1') }}
        </div>
        <div>
            <strong>{{ __('client/footer.menu.branches.branch2') }}</strong><br>
            {{ __('client/footer.menu.address.address3') }}
        </div>
        <div>
            <strong>{{ __('client/footer.menu.branches.branch1') }}</strong><br>
            {{ __('client/footer.menu.address.address2') }}
        </div>
    </div>
    <div class="footer-company">
        {{ __('client/footer.menu.company') }}
        <img class="footer-dangky" src="{{ asset('img/bocongthuong.png') }}" alt="Đã đăng ký bộ công thương" />
    </div>
</footer>
