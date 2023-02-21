  <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <a href="{{route('admin')}}" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                    <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Trang admin</span>
                </a>
                <a href="{{ route('users.index') }}" class="{{ Request::routeIs('users.*') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple"><i
                        class="fas fa-users fa-fw me-3"></i><span>Quản lý người dùng</span></a>
                <a href="{{ route('roles.index') }}" class="{{ Request::routeIs('roles.*') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                    <i class="fa-solid fa-user-secret"></i><span>Quản lý vai trò</span></a>
                <a href="{{ route('permissions.index') }}" class="{{ Request::routeIs('permissions.*') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                    <i class="fa-solid fa-user-gear"></i><span>Quản lý quyền</span></a>
                <a href="{{ route('products.index') }}" class="{{ Request::routeIs('products.*') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                    <i class="fa-brands fa-product-hunt"></i> <span>Quản lý sản phẩm</span></a>
                <a href="{{ route('categories.index') }}" class="{{ Request::routeIs('categories.*') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                    <i class="fa-solid fa-list"></i></i><span>Quản lý danh mục sản phẩm</span></a>
                <a href="{{ route('orders.index') }}" class="{{ Request::routeIs('orders.*') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-chart-bar fa-fw me-3"></i><span>Quản lý đơn hàng</span></a>

                <a href="{{ route('news.index') }}" class="{{ Request::routeIs('news.*') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                    <i class="fa-solid fa-newspaper"></i><span>Quản lý tin tức</span></a>

            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top mx-3">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="{{route('index')}}">
                <h4 class="heading-section text-success">
                    TShop
                </h4>
            </a>
            <!-- Search form -->
            <form class="d-none d-md-flex input-group w-auto my-auto">
                <input autocomplete="off" type="search" class="form-control rounded" placeholder='Tìm kiếm'
                    style="min-width: 225px;" />
                <button type="submit" class="input-group-text border-0"><i class="fas fa-search"></i></button>
            </form>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row ">
                <!-- Avatar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
                            height="22" alt="Avatar" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        @guest
                            @if (Route::has('login'))
                                <a class="dropdown-item " href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                            @endif
                            @if (Route::has('register'))
                                <a class="dropdown-item " href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                            @endif
                        @else
                            <a class=" dropdown-item " href="#">
                                {{ Auth::user()->name }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Đăng xuất') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->