@extends('layout.main')

@section('title')
  Suram
@endsection

@section('inline-style')
    
@endsection

@section('content')
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="hero-section text-center mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Suara Mahasiswa</h1>
            <p class="lead mb-5">Platform diskusi mahasiswa Universitas Maritim Raja Ali Haji</p>
            <a href="create-topic.html" class="btn btn-primary btn-lg px-4 me-2">Buat Diskusi Baru</a>
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
                    <a href="discussion.html" class="list-group-item list-group-item-action discussion-card mb-3 card-hover">
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

                    <a href="discussion.html" class="list-group-item list-group-item-action discussion-card mb-3 card-hover">
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

                    <a href="discussion.html" class="list-group-item list-group-item-action discussion-card mb-3 card-hover">
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

                    <a href="discussion.html" class="list-group-item list-group-item-action discussion-card mb-3 card-hover">
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
                            <a href="categories.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Akademik
                                <span class="badge bg-primary rounded-pill">142</span>
                            </a>
                            <a href="categories.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Organisasi
                                <span class="badge bg-primary rounded-pill">87</span>
                            </a>
                            <a href="categories.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Beasiswa
                                <span class="badge bg-primary rounded-pill">65</span>
                            </a>
                            <a href="categories.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Karir
                                <span class="badge bg-primary rounded-pill">120</span>
                            </a>
                            <a href="categories.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
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
                            <a href="discussion.html" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Protes Uang Pangkal Mahasiswa Baru</h6>
                                    <small class="text-muted">3 hari lalu</small>
                                </div>
                                <small class="text-muted">Oleh: Rudi Hermawan</small>
                            </a>
                            <a href="discussion.html" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Kritik Sistem Pembelajaran Daring</h6>
                                    <small class="text-muted">5 hari lalu</small>
                                </div>
                                <small class="text-muted">Oleh: Siti Aisyah</small>
                            </a>
                            <a href="discussion.html" class="list-group-item list-group-item-action">
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
    @include('partials.footer')
@endsection