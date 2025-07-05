<nav class="navbar navbar-expand-lg navbar-dark bg-transparent fw-bold">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu') }}">Menu</a>
                </li>
            </ul>

            {{-- Logo in the middle --}}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-none d-lg-block"> {{-- Center on large screens, hide on small --}}
                <li class="nav-item">
                    <a class="navbar-brand p-0" href="/"> {{-- p-0 to remove padding --}}
                        <img src="{{ asset('logo.jpeg') }}" style="width: 70px" alt="Logo KateringKu">
                    </a>
                </li>
            </ul>
            
            {{-- Logo for small screens, usually pushed to the left by default, or you can add mx-auto --}}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-lg-none">
                <li class="nav-item">
                    <a class="navbar-brand p-0" href="/">
                        <img src="{{ asset('logo.jpeg') }}" style="width: 70px" alt="Logo KateringKu">
                    </a>
                </li>
            </ul>


            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                @guest
                    {{-- Tampilan untuk Tamu (Guest) --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
                    </li>
                @else
                    {{-- Tampilan untuk User yang Sudah Login --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.show') }}">
                            <i class="bi bi-cart-fill"></i> 
                            Keranjang
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="badge bg-danger rounded-pill">{{ count(session('cart')) }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.index') }}">Pesanan Saya</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
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