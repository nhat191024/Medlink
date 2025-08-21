<div class="navbar bg-base-100 sticky top-0 z-50 shadow-sm">
    <div class="navbar-start">
        <a class="flex items-center gap-2 text-2xl font-bold text-red-600" href="/">
            <img class="hover:animate-shake animate__animated animate__wobble h-10 w-10 transition-transform duration-300 hover:-translate-y-2" src="{{ asset('storage/assets/site_logo.png') }}" alt="logo" style="transform: rotate(-25deg); animate__wobble;" />
            <style>
                @keyframes shake {
                    0% {
                        transform: rotate(-25deg) translateY(0);
                    }

                    20% {
                        transform: rotate(-20deg) translateY(-2px);
                    }

                    40% {
                        transform: rotate(-30deg) translateY(2px);
                    }

                    60% {
                        transform: rotate(-20deg) translateY(-2px);
                    }

                    80% {
                        transform: rotate(-30deg) translateY(2px);
                    }

                    100% {
                        transform: rotate(-25deg) translateY(0);
                    }
                }

                .hover\:animate-shake:hover {
                    animation: shake 0.5s;
                }
            </style>
            Medlink
        </a>
    </div>

    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="/">{{ __('client/navbar.menu.home') }}</a></li>
            <li><a href="{{ route('medical-specialties.index') }}">{{ __('client/navbar.menu.medical_category') }}</a></li>
            <li><a href="{{ route('appointment.index') }}">{{ __('client/navbar.menu.doctor_consultation') }}</a></li>
            <li><a href="/">{{ __('client/navbar.menu.support') }}</a></li>
        </ul>
    </div>

    <?php
    $user = auth()->user();
    $avatar = $user->avatar ?? '';
    $username = $user->name ?? '';
    ?>

    @if ($user == null)
        <div class="navbar-end gap-2">
            <a class="btn bg-red-600 text-white transition-colors duration-300 hover:bg-red-700" href="#">
                {{ __('client/navbar.button.download') }}
            </a>

            <a class="btn bg-red-600 text-white transition-colors duration-300 hover:bg-red-700" href="{{ route('login') }}">
                {{ __('client/navbar.button.login') }}/{{ __('client/navbar.button.register') }}
            </a>
        </div>
    @else
        <div class="navbar-end gap-2">
            <button class="btn btn-ghost btn-circle">
                <div class="indicator">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="badge badge-xs indicator-item bg-red-600"></span>
                </div>
            </button>
            <div class="dropdown dropdown-end">
                <div class="btn btn-ghost btn-circle avatar" tabindex="0" role="button">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component" src="{{ asset($avatar) }}" />
                    </div>
                </div>
                <ul class="menu menu-lg dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 border border-red-600 p-2 shadow" tabindex="0">
                    <li><a href="{{ route('profile.index') }}">{{ __('client/navbar.button.profile') }}</a></li>
                    <li><a href="{{ route('profile.appointment-history') }}">{{ __('client/navbar.button.history') }}</a></li>
                    <div class="divider my-1"></div>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                            @csrf
                            <button class="w-full text-left" type="submit" style="background: none; border: none; padding: 0.75rem 1rem; cursor: pointer;">
                                {{ __('client/navbar.button.logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
