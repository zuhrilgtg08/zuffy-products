<!-- Navigation -->
<nav id="navbarExample" class="navbar navbar-expand-lg fixed-top navbar-light" aria-label="Main navigation">
    <div class="container">
        <a class="navbar-brand text-decoration-none" href="/home">
            <img src="{{ asset('assets/frontend/images/master-logo.png') }}" alt="alternative" width="42" height="42">
            Zuffy Store
        </a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ms-auto navbar-nav-scroll">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('popular') ? 'active' : '' }}" href="/popular">Popular</a>
                </li>
                <li class="nav-item {{ auth()->user() ? '' : 'd-none' }}">
                    <a class="nav-link {{ Request::is('list-cart') ? 'active' : '' }}" href="{{ route('keranjang.list') }}">
                        <i class="fas fa-fw fa-shopping-cart"></i> My Cart
                        @if (!empty($cart))
                            <span class="badge rounded-pill badge-notification bg-danger ms-1">
                                {{ $cart->count() }}
                            </span>
                        @endif
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome, {{ auth()->user()->username }}
                    
                            @if (auth()->user()->image_profile)
                                <img src="{{ asset('storage/' . auth()->user()->image_profile) }}" alt="profile" class="rounded-circle"
                                    width="40" height="40" />
                            @else
                                <img src="{{ asset('assets/frontend/images/profile.svg') }}" alt="profile" class="rounded-circle" width="40" height="30"/>
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            @if (auth()->user()->status_type === 'admin' )
                                @can('admin')
                                    <li>
                                        <a class="dropdown-item text-center fs-6" href="{{ url('/admin/manage_dashboard') }}">
                                           <i class="fas fa-fw fa-database"></i> Dashboard
                                        </a>
                                    </li>
                                @endcan
                            @else
                                <li>
                                    <a class="dropdown-item text-center fs-6" href="{{ route('customer.profile.edit', auth()->user()->username) }}">
                                        <i class="fas fa-fw fa-user-circle"></i> My Profile
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item text-center fs-6" href="">
                                        <i class="fas fa-fw fa-list-alt"></i> My History
                                    </a>
                                </li>
                            @endif
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item text-center" href="#">
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger text-center rounded-pill w-100">
                                            <i class="fas fa-fw fa-arrow-alt-circle-right"></i>
                                            Logout
                                        </button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth
                
                @guest
                    <span class="nav-item">
                        <a class="btn-solid-sm" href="{{ route('login') }}">
                            Sign in
                        </a>
                    </span>
                @endguest
            </ul>
        </div>
    </div> 
</nav> 