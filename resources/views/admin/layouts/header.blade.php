<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="index.html" class="logo">
            <span>
                    <img src="{{ asset('admin/assets/images/logo-light.png') }}" alt="" height="18">
                </span>
            <i>
                    <img src="{{ asset('admin/assets/images/logo-sm.png') }}" alt="" height="22">
                </i>
        </a>
    </div>

    <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">

            <!-- full screen -->
            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="mdi mdi-fullscreen noti-icon"></i>
                </a>
            </li>
            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset(Auth::user()->profile_image) }}" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <a class="dropdown-item text-danger" href="{{ route('auth.logout') }}"><i class="mdi mdi-power text-danger"></i> Logout</a>
                    </div>
                </div>
            </li>

        </ul>
    </nav>

</div>
<!-- Top Bar End -->