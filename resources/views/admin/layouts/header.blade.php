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

            <!-- notification -->
            <li class="dropdown notification-list list-inline-item">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell-outline noti-icon"></i>
                    <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                    <!-- item-->
                    <h6 class="dropdown-item-text">
                            Notifications (258)
                        </h6>
                    <div class="slimscroll notification-item-list">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                            <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning"><i class="mdi mdi-message-text-outline"></i></div>
                            <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                            <p class="notify-details">Your item is shipped<span class="text-muted">It is a long established fact that a reader will</span></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                            <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                            <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                        </a>
                    </div>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                            View all <i class="fi-arrow-right"></i>
                        </a>
                </div>
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