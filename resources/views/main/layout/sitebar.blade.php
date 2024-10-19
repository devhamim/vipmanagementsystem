<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">
                <img width="50px" src="{{ asset('uploads/setting') }}/{{ $setting->logo }}" alt="">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('dataentry.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Analytics">Data Entry</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('matchmaking.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Analytics">Matchmaking</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('paymentdata.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Analytics">Payment Data</div>
            </a>
        </li>
    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
        <li class="menu-item">
            <a href="{{ route('dailycost.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Analytics">Daily Cost</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('employe.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Analytics">Employ</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('attendance.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Analytics">Attendance</div>
            </a>
        </li>
    @endif
    @if(Auth::user()->role == 1)
        <li class="menu-item">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Analytics">User</div>
            </a>
        </li>
    @endif
    </ul>
</aside>

