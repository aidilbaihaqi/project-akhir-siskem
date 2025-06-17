<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">SURAM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("categories.index") }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("popular.index") }}">Popular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("about.index") }}">About</a>
                </li>
            </ul>

            @guest
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-light">Register</a>
                </div>
            @endguest

            @auth
                <div class="d-flex align-items-center">
                    <div class="dropdown me-3">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser" data-bs-toggle="dropdown">
                            <img src="https://picsum.photos/40?random=70" alt="Profile" width="32" height="32"
                                class="rounded-circle me-2">
                            <span>{{ Auth::user()->nim }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href=""><i class="bi bi-person me-2"></i>Profil</a>
                            </li>
                            <li><a class="dropdown-item" href=""><i
                                        class="bi bi-clock-history me-2"></i>Aktivitas</a></li>
                            <li><a class="dropdown-item" href=""><i class="bi bi-gear me-2"></i>Pengaturan</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </button>
                                </form>
                            </li>

                            </li>
                        </ul>
                    </div>
                    <a href="{{ route("topics.create") }}" class="btn btn-light">Buat Diskusi</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
