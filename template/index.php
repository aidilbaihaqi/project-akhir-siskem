<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SURAM - Suara Mahasiswa</title>
    <meta name="description" content="Forum diskusi mahasiswa Indonesia">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://picsum.photos/1920/600?random=1');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .category-icon {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        .discussion-card {
            border-left: 4px solid #0d6efd;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">SURAM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="popular.php">Popular</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="login.php" class="btn btn-outline-light me-2">Login</a>
                    <a href="register.php" class="btn btn-light">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Suara Mahasiswa</h1>
            <p class="lead mb-5">Platform diskusi mahasiswa Universitas Maritim Raja Ali Haji</p>
            <a href="create-topic.php" class="btn btn-primary btn-lg px-4 me-2">Buat Diskusi Baru</a>
            <a href="#trending" class="btn btn-outline-light btn-lg px-4">Lihat Trending</a>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mb-5">
        <div class="row">
            <!-- Main Discussions -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4">Diskusi Terbaru</h2>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown">
                            Urutkan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Terbaru</a></li>
                            <li><a class="dropdown-item" href="#">Populer</a></li>
                            <li><a class="dropdown-item" href="#">Paling Banyak Komentar</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Discussion List -->
                <div class="list-group mb-5">
                    <a href="discussion.php" class="list-group-item list-group-item-action discussion-card mb-3 card-hover">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Bagaimana menyikapi kenaikan harga BBM untuk mahasiswa?</h5>
                            <small class="text-muted">3 jam lalu</small>
                        </div>
                        <p class="mb-1">Dengan kenaikan harga BBM baru-baru ini, bagaimana sebaiknya mahasiswa menyikapi hal ini? Apakah ada solusi kreatif yang bisa dilakukan?</p>
                        <div class="d-flex justify-content-between mt-2">
                            <small class="text-muted">Oleh: <strong>Andi Pratama</strong> di <strong>Ekonomi</strong></small>
                            <div>
                                <span class="badge bg-primary rounded-pill me-1"><i class="bi bi-chat"></i> 24</span>
                                <span class="badge bg-success rounded-pill"><i class="bi bi-eye"></i> 156</span>
                            </div>
                        </div>
                    </a>

                    <a href="discussion.php" class="list-group-item list-group-item-action discussion-card mb-3 card-hover">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Tips mengatur waktu antara organisasi dan akademik</h5>
                            <small class="text-muted">5 jam lalu</small>
                        </div>
                        <p class="mb-1">Saya sering kesulitan membagi waktu antara kegiatan organisasi dan kuliah. Ada yang punya pengalaman atau tips?</p>
                        <div class="d-flex justify-content-between mt-2">
                            <small class="text-muted">Oleh: <strong>Siti Rahayu</strong> di <strong>Mahasiswa</strong></small>
                            <div>
                                <span class="badge bg-primary rounded-pill me-1"><i class="bi bi-chat"></i> 18</span>
                                <span class="badge bg-success rounded-pill"><i class="bi bi-eye"></i> 98</span>
                            </div>
                        </div>
                    </a>

                    <a href="discussion.php" class="list-group-item list-group-item-action discussion-card mb-3 card-hover">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Review laptop untuk mahasiswa teknik dengan budget 10 juta</h5>
                            <small class="text-muted">1 hari lalu</small>
                        </div>
                        <p class="mb-1">Saya butuh rekomendasi laptop untuk kuliah teknik dengan budget sekitar 10 juta. Spesifikasi minimal apa yang harus dipenuhi?</p>
                        <div class="d-flex justify-content-between mt-2">
                            <small class="text-muted">Oleh: <strong>Budi Santoso</strong> di <strong>Teknologi</strong></small>
                            <div>
                                <span class="badge bg-primary rounded-pill me-1"><i class="bi bi-chat"></i> 32</span>
                                <span class="badge bg-success rounded-pill"><i class="bi bi-eye"></i> 210</span>
                            </div>
                        </div>
                    </a>

                    <a href="discussion.php" class="list-group-item list-group-item-action discussion-card mb-3 card-hover">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Pengalaman magang di perusahaan startup</h5>
                            <small class="text-muted">2 hari lalu</small>
                        </div>
                        <p class="mb-1">Ada yang punya pengalaman magang di startup? Bagaimana lingkungan kerjanya dan skill apa yang paling dibutuhkan?</p>
                        <div class="d-flex justify-content-between mt-2">
                            <small class="text-muted">Oleh: <strong>Dewi Anggraeni</strong> di <strong>Karir</strong></small>
                            <div>
                                <span class="badge bg-primary rounded-pill me-1"><i class="bi bi-chat"></i> 45</span>
                                <span class="badge bg-success rounded-pill"><i class="bi bi-eye"></i> 312</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Search Box -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Cari Diskusi</h5>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Kata kunci...">
                            <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Kategori Populer</h5>
                        <div class="list-group list-group-flush">
                            <a href="categories.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Akademik
                                <span class="badge bg-primary rounded-pill">142</span>
                            </a>
                            <a href="categories.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Organisasi
                                <span class="badge bg-primary rounded-pill">87</span>
                            </a>
                            <a href="categories.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Beasiswa
                                <span class="badge bg-primary rounded-pill">65</span>
                            </a>
                            <a href="categories.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Karir
                                <span class="badge bg-primary rounded-pill">120</span>
                            </a>
                            <a href="categories.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Teknologi
                                <span class="badge bg-primary rounded-pill">76</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Trending Discussions -->
                <div class="card mb-4" id="trending">
                    <div class="card-body">
                        <h5 class="card-title">Trending Minggu Ini</h5>
                        <div class="list-group list-group-flush">
                            <a href="discussion.php" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Protes Uang Pangkal Mahasiswa Baru</h6>
                                    <small class="text-muted">3 hari lalu</small>
                                </div>
                                <small class="text-muted">Oleh: Rudi Hermawan</small>
                            </a>
                            <a href="discussion.php" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Kritik Sistem Pembelajaran Daring</h6>
                                    <small class="text-muted">5 hari lalu</small>
                                </div>
                                <small class="text-muted">Oleh: Siti Aisyah</small>
                            </a>
                            <a href="discussion.php" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Gerakan Mahasiswa Tolak Kenaikan UKT</h6>
                                    <small class="text-muted">1 minggu lalu</small>
                                </div>
                                <small class="text-muted">Oleh: BEM Universitas</small>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Statistik Forum</h5>
                        <div class="row">
                            <div class="col-4">
                                <div class="p-3">
                                    <h3 class="text-primary">1,245</h3>
                                    <small>Diskusi</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-3">
                                    <h3 class="text-success">5,678</h3>
                                    <small>Komentar</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-3">
                                    <h3 class="text-warning">3,210</h3>
                                    <small>Anggota</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-uppercase mb-4">Tentang SURAM</h5>
                    <p>SURAM (Suara Mahasiswa) adalah platform diskusi online untuk mahasiswa UMRAH. Wadah untuk berbagi informasi, pengalaman, dan gagasan.</p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Tautan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php" class="text-white">Home</a></li>
                        <li class="mb-2"><a href="categories.php" class="text-white">Kategori</a></li>
                        <li class="mb-2"><a href="popular.php" class="text-white">Populer</a></li>
                        <li class="mb-2"><a href="about.php" class="text-white">Tentang</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Akun</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="login.php" class="text-white">Login</a></li>
                        <li class="mb-2"><a href="register.php" class="text-white">Register</a></li>
                        <li class="mb-2"><a href="profile.php" class="text-white">Profil</a></li>
                        <li class="mb-2"><a href="settings.php" class="text-white">Pengaturan</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-uppercase mb-4">Newsletter</h5>
                    <p>Dapatkan update diskusi terbaru langsung ke email Anda.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email Anda">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2025 SURAM. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="public/js/bootstrap.bundle.min.js"></script>
</body>
</html>