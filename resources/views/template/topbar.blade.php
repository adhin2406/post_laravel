<nav class="navbar navbar-expand navbar-light bg-white  mb-4 fixed-top shadow">
    <!-- Topbar -->

    <div class="d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100">
        <a class="navbar-brand" href="#">
            <img src={{ asset('assets/img/undraw_rocket.svg') }} width="30px">
        </a>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        @if (Auth::check())
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                    <img class="img-profile rounded-circle"
                        src="{{ Auth::user()->foto? '/storage/user/' . Auth::user()->foto: 'https://ui-avatars.com/api/?background=9AB2E2&color=185ADB&name=' . Auth::user()->nama }}"
                        width="40px">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ url('/tambah_barang') }}">
                        <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                        Tambah Barang
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ url('/logout') }}" id="logout_button">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                        Logout
                    </a>
                </div>
            </li>
        @else
            <li class="nav-item px-3">
                <a class="nav-link text-dark" href="{{ url('/login') }}">Masuk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-primary rounded-pill px-5 text-white"
                    href="{{ url('/daftar') }}">Daftar</a>
            </li>
        @endif
    </ul>

</nav>
