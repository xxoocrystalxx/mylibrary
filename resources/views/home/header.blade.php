@php
$route = Route::current()->getName();
$user = Auth::user();
@endphp

<header id="page-topbar">
    <div class="navbar-header menu__area">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo/logo_black.png') }}" alt="logo-sm" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/logo/logo_black.png') }}" alt="logo-dark" height="48">
                    </span>
                </a>

                <a href="{{ route('home') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo/logo_white.png') }}" alt="logo-sm-light" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/logo/logo_white.png') }}" alt="logo-light" height="48">
                    </span>
                </a>
            </div>

            <div class="app-menu main__menu d-none d-lg-block"">
                <ul class="navigation">
                    <li class="{{ $route == 'home' ? 'active' : '' }} "><a href="{{ route('home') }}"><i
                                class="fas fa-home-lg"></i>Home</a></li>
                    <li class="{{ $route == 'book.rank' ? 'active' : '' }}"><a href="{{ route('book.rank') }}"><i
                                class="fas fa-chart-bar"></i>Rank</a></li>
                    <li class="{{ $route == 'genre.list' ? 'active' : '' }}"><a href="{{ route('genre.list') }}"><i
                                class="fas fa-list-ul"></i>Genres</a></li>
                    <li class="{{ $route == 'author.list' ? 'active' : '' }}"><a href="{{ route('author.list') }}"><i
                                class="fas fa-book-user"></i>Authors</a></li>
                </ul>
            </div>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block" method="POST" action="{{ route('search') }}">
                @csrf
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search book name or author" name="q">
                    <span class="ri-search-line"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mobile__nav__toggler"><i class="fas fa-bars"></i></div>

            <!-- Mobile Menu  -->
            <div class="mobile__menu">
                <nav class="menu__box">
                    <div class="close__btn"><i class="fal fa-times"></i></div>
                    <div class="nav-logo">
                        <a href="index.html" class="logo__black"><img src="{{ asset('images/logo/logo_white.png') }}"
                                alt=""></a>
                        <a href="index.html" class="logo__white"><img src="{{ asset('images/logo/logo_white.png') }}"
                                alt=""></a>
                    </div>

                    <div class="menu__outer">
                        @if ($user)
                            <div class="userMenu">
                                <div class="userInfo">
                                    <img class="rounded-circle header-profile-user"
                                        src="{{ !empty($user->profile_image) ? url('upload/admin_images/' . $user->profile_image) : url('upload/no_image.jpg') }}"
                                        alt="Header Avatar">
                                    <span>Hello, {{ $user->name }}</span>
                                </div>
                            </div>
                        @endif
                        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                    </div>
                </nav>
            </div>
            <div class="menu__backdrop"></div>
            <!-- End Mobile Menu -->

            @if ($user)
                <div class="dropdown d-inline-block user-dropdown d-none d-lg-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                            src="{{ !empty($user->profile_image) ? url('upload/admin_images/' . $user->profile_image) : url('upload/no_image.jpg') }}"
                            alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1">{{ $user->name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" id="userMenuContent">
                        <div class="userMenuItems">
                            <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                    class="fas fa-user align-middle me-1"></i>Profile</a>
                            @if ($user->type == 'user')
                                <a class="dropdown-item" href="{{ route('my.library') }}"><i
                                        class="fas fa-book-reader align-middle me-1"></i>My Library</a>
                                <a class="dropdown-item" href="{{ route('my.reviews') }}"><i
                                        class="fas fa-comment-edit align-middle me-1"></i>My Reviews</a>
                                <div class="dropdown-divider"></div>
                            @endif

                            <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                                    class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="register-menu header-item d-lg ms-2">
                    <button type="button" class="btn btn-secondary btn-rounded waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                </div>
            @endif

        </div>
    </div>
</header>

<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt-3" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <input class="form-control" name="username" type="text" required=""
                                placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <input class="form-control" id="password" name="password" type="password"
                                required="" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox">

                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3 text-center row mt-3 pt-1">
                        <div class="col-12">
                            <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Log
                                In</button>
                        </div>
                    </div>

                    <div class="form-group mb-0 row mt-2">
                        <div class="col-sm-7 mt-3">
                            <a href={{ route('password.request') }} class="text-muted"><i class="mdi mdi-lock"></i>
                                Forgot
                                your password?</a>
                        </div>
                        <div class="col-sm-5 mt-3">
                            <a href={{ route('register') }} class="text-muted"><i class="mdi mdi-account-circle"></i>
                                Create an account</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
