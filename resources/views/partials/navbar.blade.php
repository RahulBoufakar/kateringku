<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 position-relative">
    <div class="container">
        {{-- Toggler for mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Logo --}}
        <a class="navbar-brand mx-lg-auto" href="/">
            <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="img-fluid" style="height: 50px;">
        </a>

        {{-- Collapsing menu (wrap left & right navs together) --}}
        <div class="collapse navbar-collapse justify-content-between" id="mainNavbar">
            {{-- Left nav --}}
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('menu') }}">Menu</a></li>
            </ul>

            {{-- Right nav --}}
            <ul class="navbar-nav ms-auto align-items-lg-center">
                @guest
                    <li class="nav-item me-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.show') }}">
                            <i class="bi bi-cart-fill"></i>
                            Keranjang
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="badge bg-danger rounded-pill">{{ count(session('cart')) }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('order.index') }}">Pesanan Saya</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            @if(auth()->user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>