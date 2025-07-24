<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 py-2">
  <div class="container">
    <!-- Logo di kiri -->
    <a class="navbar-brand" href="/">
      <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="img-fluid" style="height: 50px;">
    </a>

    <!-- Toggler untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu collapse -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <!-- Menu kiri -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('menu') }}">Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Kontak Kami</a></li>
      </ul>

      <!-- Menu kanan -->
      <ul class="navbar-nav ms-auto align-items-lg-center">
        @guest
          <li class="nav-item me-2">
            <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
          </li>
        @endguest

        @auth
          <li class="nav-item">
            <a class="nav-link" href="{{route('cart.show')}}">
              <i class="bi bi-cart-fill"></i> Keranjang
              <span class="badge bg-danger rounded-pill">{{ session('cart') ? count(session('cart')) : 0 }}</span>
            </a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ route('order.index') }}">Pesanan Saya</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> {{ Auth::user()->name ?? 'Nama Pengguna' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              @if(Auth::user()->role == 'admin')
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard Admin</a></li>
              @endif
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
