<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{ route('dashboard.index') }}" class="waves-effect">
                        <i class="ti-home"></i><span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('category.index') }}" class="waves-effect"><i class="ti-menu-alt"></i><span> Quản lý danh mục </span></a>
                </li>

                <li>
                    <a href="{{ route('food.index') }}" class="waves-effect"><i class="ti-menu-alt"></i><span> Quản lý món ăn </span></a>
                </li>

                <li>
                    <a href="{{ route('order.index') }}" class="waves-effect"><i class="ti-clipboard"></i><span> Quản lý đặt hàng </span></a>
                </li>
                
                @if(Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('user.index') }}" class="waves-effect"><i class="ti-clipboard"></i><span> Quản lý người dùng </span></a>
                </li>
                @endif
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>