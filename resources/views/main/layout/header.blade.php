<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="container mt-5">
        <h1 class="text-center">Push Notification Example</h1>
        <div class="text-center">
            <button id="enable-notifications" class="btn btn-primary">Enable Notifications</button>
        </div>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <style>
                .bold {
                    font-weight: bold;
                    background-color: white; /* Background for new notifications */
                }

                .normal {
                    font-weight: normal;
                    background-color: #f0f0f0; /* Darker background for seen notifications */
                }

                .preview-item {
                    padding: 10px; /* Adjust padding as needed */
                }

                .preview-item:hover {
                    background-color: #e5caca; /* Optional: Change background on hover */
                }

                .unseen {
                    font-weight: bold;
                    background-color: white; /* White background for unseen notifications */
                }

                .seen {
                    font-weight: normal;
                    background-color: #e0e0e0; /* Darker background for seen notifications */
                }
            </style>

            <!-- Notification -->
                @if (in_array(Auth::user()->role, [1, 2]))
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class="bx bx-bell" style="font-size: 2rem"></i>
                        <span class="count text-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                    </a>
                    <script>
                        document.querySelectorAll('.dropdown-item').forEach(item => {
                            item.addEventListener('click', function() {
                                let countElement = document.querySelector('.count.text-danger');
                                let currentCount = parseInt(countElement.innerText);

                                if (currentCount > 0) {
                                    countElement.innerText = currentCount - 1;
                                }
                            });
                        });
                    </script>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-header">Notifications</li>
                        @foreach (Auth::user()->notifications->take(10) as $notification)
                            <a href="{{ route('notifications.read', $notification->id) }}"
                            class="dropdown-item preview-item {{ $notification->read_at ? 'seen' : 'unseen' }}">
                                <div class="preview-item-content">
                                    <h6 class="preview-subject">{{ $notification->data['message'] }}</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                        <li class="dropdown-footer">
                            <a href="{{ route('notifications.index') }}" class="dropdown-item text-center">See more</a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('asset') }}/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('asset') }}/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                    <small class="text-muted">{{ Auth::user()->role }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('setting.index') }}">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>

