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

    <style>
        /* Custom scrollbar for notification dropdown */
        .notification-dropdown::-webkit-scrollbar {
            width: 4px;
        }

        .notification-dropdown::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .notification-dropdown::-webkit-scrollbar-thumb {
            background: #e53e3e;
            border-radius: 4px;
        }

        .notification-dropdown::-webkit-scrollbar-thumb:hover {
            background: #c53030;
        }

        /* Line clamp for notification text */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Animation for notification badge */
        .notification-badge {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }
    </style>

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
            {{-- notification bell --}}
            <div id="notification-dropdown" class="dropdown dropdown-end">
                <button id="notification-bell" class="btn btn-ghost btn-circle" tabindex="0" role="button">
                    <div class="indicator">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span id="unread-count" class="badge badge-xs indicator-item notification-badge bg-red-600 text-white" style="display: none;"></span>
                    </div>
                </button>

                <div id="notification-dropdown-content" class="dropdown-content bg-base-100 rounded-box z-50 mt-3 w-96 border border-red-600 shadow-lg" tabindex="0">
                    <!-- Header -->
                    <div class="border-b border-gray-200 p-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ __('client/navbar.notifications.title') }}
                            </h3>
                            <button id="mark-all-read" class="text-sm font-medium text-red-600 hover:text-red-700" style="display: none;">
                                {{ __('client/navbar.notifications.mark_all_read') }}
                            </button>
                        </div>
                        <p id="unread-message" class="mt-1 text-sm text-gray-600" style="display: none;">
                            <span id="unread-count-text"></span> {{ __('client/navbar.notifications.unread_messages') }}
                        </p>
                    </div>

                    <!-- Notifications List -->
                    <div id="notifications-list" class="notification-dropdown max-h-96 overflow-y-auto">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                </div>
            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements (some exist only when user is authenticated)
        const notificationBell = document.getElementById('notification-bell');
        const dropdownContent = document.getElementById('notification-dropdown-content');
        const unreadCountBadge = document.getElementById('unread-count');
        const unreadCountText = document.getElementById('unread-count-text');
        const unreadMessage = document.getElementById('unread-message');
        const markAllReadBtn = document.getElementById('mark-all-read');
        const notificationsList = document.getElementById('notifications-list');

        // If bell not present (guest) exit early to avoid JS errors that break later hydration.
        if (!notificationBell || !dropdownContent) {
            return;
        }

        let loading = false;
        let notifications = [];
        let unreadCount = 0;

        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        }

        function updateUnreadCount(count) {
            unreadCount = count;
            if (count > 0) {
                unreadCountBadge.textContent = count;
                unreadCountBadge.style.display = 'inline';
                unreadCountText.textContent = count;
                unreadMessage.style.display = 'block';
                markAllReadBtn.style.display = 'inline';
            } else {
                unreadCountBadge.style.display = 'none';
                unreadMessage.style.display = 'none';
                markAllReadBtn.style.display = 'none';
            }
        }

        function showLoading() {
            notificationsList.innerHTML = `
            <div class="p-4 text-center">
                <div class="loading loading-spinner loading-md text-red-600"></div>
                <p class="mt-2 text-gray-600">{{ __('client/navbar.notifications.loading') }}</p>
            </div>
        `;
        }

        function showNoNotifications() {
            notificationsList.innerHTML = `
            <div class="p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <p class="mt-2 text-gray-600">{{ __('client/navbar.notifications.no_notifications') }}</p>
            </div>
        `;
        }

        function getNotificationIcon(iconColor) {
            const iconClasses = {
                danger: {
                    containerClass: 'bg-red-100',
                    iconClass: 'text-red-600',
                    svg: '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>'
                },
                success: {
                    containerClass: 'bg-green-100',
                    iconClass: 'text-green-600',
                    svg: '<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>'
                },
                warning: {
                    containerClass: 'bg-yellow-100',
                    iconClass: 'text-yellow-600',
                    svg: '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>'
                },
                default: {
                    containerClass: 'bg-blue-100',
                    iconClass: 'text-blue-600',
                    svg: '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>'
                }
            };

            const iconConfig = iconClasses[iconColor] || iconClasses.default;

            return `
            <div class="flex h-8 w-8 items-center justify-center rounded-full ${iconConfig.containerClass}">
                <svg class="h-4 w-4 ${iconConfig.iconClass}" fill="currentColor" viewBox="0 0 20 20">
                    ${iconConfig.svg}
                </svg>
            </div>
        `;
        }

        function getNotificationData(notification) {
            try {
                if (notification.data) {
                    const data = typeof notification.data === 'string' ?
                        JSON.parse(notification.data) :
                        notification.data;

                    return {
                        title: data.title || 'Notification',
                        body: data.body || data.message || '',
                        iconColor: data.iconColor || data.color || 'info',
                        icon: data.icon || 'heroicon-o-bell'
                    };
                }

                return {
                    title: notification.title || 'Notification',
                    body: notification.body || notification.message || '',
                    iconColor: notification.iconColor || notification.color || 'info',
                    icon: notification.icon || 'heroicon-o-bell'
                };
            } catch (error) {
                return {
                    title: 'Notification',
                    body: '',
                    iconColor: 'info',
                    icon: 'heroicon-o-bell'
                };
            }
        }

        function formatDate(dateString) {
            try {
                const date = new Date(dateString);
                const now = new Date();
                const diffInMinutes = Math.floor((now - date) / (1000 * 60));

                if (diffInMinutes < 1) {
                    return 'Just now';
                } else if (diffInMinutes < 60) {
                    return `${diffInMinutes}m ago`;
                } else if (diffInMinutes < 1440) {
                    const hours = Math.floor(diffInMinutes / 60);
                    return `${hours}h ago`;
                } else {
                    const days = Math.floor(diffInMinutes / 1440);
                    return `${days}d ago`;
                }
            } catch (error) {
                return '';
            }
        }

        function renderNotifications() {
            if (notifications.length === 0) {
                showNoNotifications();
                return;
            }

            const notificationsHtml = notifications.map(notification => {
                const data = getNotificationData(notification);
                const isUnread = notification.read_at === null;

                return `
                <div class="cursor-pointer border-b border-gray-100 p-4 transition-colors hover:bg-gray-50 ${isUnread ? 'bg-blue-50' : ''}"
                     onclick="markAsRead('${notification.id}')">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            ${getNotificationIcon(data.iconColor)}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">${data.title}</p>
                                <div class="flex items-center space-x-2">
                                    ${isUnread ? '<span class="h-2 w-2 rounded-full bg-red-600"></span>' : ''}
                                    <span class="text-xs text-gray-500">${formatDate(notification.created_at)}</span>
                                </div>
                            </div>
                            <p class="mt-1 text-sm text-gray-600">${data.body}</p>
                        </div>
                    </div>
                </div>
            `;
            }).join('');

            notificationsList.innerHTML = notificationsHtml;
        }

        async function fetchNotifications() {
            loading = true;
            showLoading();

            try {
                const response = await fetch('/notifications', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    credentials: 'same-origin'
                });

                if (response.ok) {
                    const data = await response.json();
                    notifications = data;
                    renderNotifications();
                } else {
                    console.error('Failed to fetch notifications:', response.status);
                    showNoNotifications();
                }
            } catch (error) {
                console.error('Error fetching notifications:', error);
                showNoNotifications();
            } finally {
                loading = false;
            }
        }

        async function fetchUnreadCount() {
            try {
                const response = await fetch('/notifications/unread-count', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    credentials: 'same-origin'
                });

                if (response.ok) {
                    const data = await response.json();
                    updateUnreadCount(data.unread_count || 0);
                } else {
                    console.error('Failed to fetch unread count:', response.status);
                }
            } catch (error) {
                console.error('Error fetching unread count:', error);
            }
        }

        window.markAsRead = async function(notificationId) {
            try {
                const response = await fetch(`/notifications/mark-as-read/${notificationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    credentials: 'same-origin'
                });

                if (response.ok) {
                    // Update the notification in the list
                    notifications = notifications.map(notification => {
                        if (notification.id === notificationId) {
                            return {
                                ...notification,
                                read_at: new Date().toISOString()
                            };
                        }
                        return notification;
                    });

                    renderNotifications();
                    fetchUnreadCount();
                } else {
                    console.error('Failed to mark notification as read:', response.status);
                }
            } catch (error) {
                console.error('Error marking notification as read:', error);
            }
        };

        async function markAllAsRead() {
            try {
                const response = await fetch('/notifications/mark-all-as-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    credentials: 'same-origin'
                });

                if (response.ok) {
                    // Mark all notifications as read
                    notifications = notifications.map(notification => ({
                        ...notification,
                        read_at: new Date().toISOString()
                    }));

                    renderNotifications();
                    updateUnreadCount(0);
                } else {
                    console.error('Failed to mark all notifications as read:', response.status);
                }
            } catch (error) {
                console.error('Error marking all notifications as read:', error);
            }
        }

        // Event listeners
        if (!notificationBell.dataset.bound) {
            notificationBell.addEventListener('click', function(e) {
                e.stopPropagation();
                // DaisyUI handles dropdown toggle, just load notifications if needed
                if (notifications.length === 0) {
                    fetchNotifications();
                }
            });
            notificationBell.dataset.bound = '1';
        }
        if (markAllReadBtn) {
            markAllReadBtn.addEventListener('click', markAllAsRead);
        }

        // Initialize
        fetchNotifications();
        fetchUnreadCount();

        // Fetch unread count every 30 seconds
        setInterval(() => {
            fetchNotifications();
            fetchUnreadCount();
        }, 30000);
    });
</script>
