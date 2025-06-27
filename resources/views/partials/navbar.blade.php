<nav class="navbar navbar-expand-lg bg-transparent text-white fw-bold position-relative mt-2">
    <div class="container text-white fw-bold d-flex justify-content-center gap-5 align-items-center position-relative">

      <!-- Left Menu -->
      <ul class="navbar-nav flex-row gap-3">
        <li class="nav-item">
          <a class="nav-link text-white fw-bold" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fw-bold" href="#">About</a>
        </li>
      </ul>

      <!-- Center Logo -->
      <a class="navbar-brand navbar-center d-flex align-items-center" href="#">
        <img src="{{asset('logo.jpeg')}}" style="width: 80px" alt="">
      </a>

      <!-- Right Menu + User Dropdown -->
      <div class="d-flex align-items-center gap-3">
        <a class="nav-link" href="#">Contact</a>
        @auth
          <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle text-white" type="button" data-bs-toggle="dropdown">
              User
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
          </div>
        </div>
        @endauth
        @guest
          <a href="{{route('login')}}" class="btn btn-outline-secondary text-white">Login</a>
        @endguest
    </div>
  </nav>