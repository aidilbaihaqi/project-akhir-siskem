@extends('layouts.main')

@section('inline-style')
    <style>
        .mission-card {
            transition: all 0.3s ease;
            border-left: 4px solid #0d6efd;
        }

        .mission-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .team-member {
            transition: all 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .team-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #f8f9fa;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="container my-5">
        <div class="row mb-5">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tentang</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-4">Tentang SURAM</h1>
                <p class="lead">Platform diskusi mahasiswa Universitas Maritim Raja Ali Haji</p>
            </div>
        </div>

        <!-- About Section -->
        <div class="row mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="h3 mb-4">Apa itu SURAM?</h2>
                <p>SURAM (Suara Mahasiswa) adalah platform diskusi online yang didedikasikan untuk mahasiswa UMRAH. Kami
                    hadir sebagai wadah bagi mahasiswa untuk berbagi informasi, pengalaman, dan gagasan.</p>
                <p>Didirikan pada tahun 2020, SURAM telah berkembang menjadi komunitas mahasiswa terbesar dengan ribuan
                    anggota aktif dari seluruh fakultas Universitas Maritim Raja Ali Haji. Kami percaya bahwa setiap
                    mahasiswa memiliki suara yang berharga dan layak untuk didengar.</p>
                <p>Dengan berbagai kategori diskusi yang tersedia, mulai dari akademik, organisasi, beasiswa, hingga karir,
                    SURAM menjadi tempat yang tepat untuk menemukan solusi, berbagi pengalaman, dan membangun jaringan.</p>
            </div>
            <div class="col-lg-6">
                <img src="img/about.jpg" alt="About SURAM" class="img-fluid rounded shadow">
            </div>
        </div>

        <!-- Mission Section -->
        <div class="row mb-5">
            <div class="col-12 mb-4">
                <h2 class="h3 text-center">Misi Kami</h2>
                <p class="text-center lead">Memberdayakan mahasiswa melalui diskusi yang konstruktif</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 mission-card">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded d-inline-block mb-3">
                            <i class="bi bi-chat-square-text text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="h5">Wadah Diskusi</h3>
                        <p class="card-text">Menyediakan platform yang aman dan nyaman untuk berdiskusi tentang berbagai
                            topik yang relevan dengan mahasiswa.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 mission-card">
                    <div class="card-body text-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded d-inline-block mb-3">
                            <i class="bi bi-lightbulb text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="h5">Berbagi Pengetahuan</h3>
                        <p class="card-text">Memfasilitasi pertukaran pengetahuan dan pengalaman antar mahasiswa dari
                            berbagai disiplin ilmu.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 mission-card">
                    <div class="card-body text-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded d-inline-block mb-3">
                            <i class="bi bi-people text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="h5">Membangun Komunitas</h3>
                        <p class="card-text">Menciptakan komunitas mahasiswa yang solid, saling mendukung, dan berdaya saing
                            tinggi.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="row mb-5">
            <div class="col-12 mb-4">
                <h2 class="h3 text-center">Tim Kami</h2>
                <p class="text-center lead">Orang-orang di balik SURAM</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 text-center team-member">
                    <div class="card-body">
                        <img src="img/about aidil.jpg" alt="Team Member" class="team-img mb-3">
                        <h3 class="h5">Aidil Baihaqi</h3>
                        <p class="text-muted">Product Manager & Security Analyst 2</p>
                        <p>Mengarahkan pengembangan produk dengan fokus pada keamanan dan inovasi untuk menciptakan solusi
                            yang andal dan terpercaya.</p>
                        <div>
                            <a href="#" class="text-primary me-2"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 text-center team-member">
                    <div class="card-body">
                        <img src="img/about ferdy.jpg" alt="Team Member" class="team-img mb-3">
                        <h3 class="h5">Ferdy Mulyadi Reo Goran</h3>
                        <p class="text-muted">Frontend Dev</p>
                        <p>Menciptakan pengalaman digital yang menarik dan membangun koneksi kuat antara pengguna dan
                            komunitas.</p>
                        <div>
                            <a href="#" class="text-primary me-2"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 text-center team-member">
                    <div class="card-body">
                        <img src="img/about farel.jpg" alt="Team Member" class="team-img mb-3">
                        <h3 class="h5">Farrel Razan Aryaputra</h3>
                        <p class="text-muted">Backend Dev 1</p>
                        <p>Membangun sistem backend yang andal dan efisien untuk mendukung pengalaman pengguna yang mulus
                            dan scalable.</p>
                        <div>
                            <a href="#" class="text-primary me-2"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 text-center team-member">
                    <div class="card-body">
                        <img src="img/about widuri.jpg" alt="Team Member" class="team-img mb-3">
                        <h3 class="h5">Widuri Eka Febriyanti</h3>
                        <p class="text-muted">Backend Dev 2</p>
                        <p>Mengembangkan arsitektur backend yang kuat dan scalable untuk mendukung performa aplikasi dan
                            pengalaman pengguna optimal.</p>
                        <div>
                            <a href="#" class="text-primary me-2"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 text-center team-member">
                    <div class="card-body">
                        <img src="img/about ulva.jpg" alt="Team Member" class="team-img mb-3">
                        <h3 class="h5">Laila Amelia Ulva</h3>
                        <p class="text-muted">Security Analyst 1</p>
                        <p>Mengawal keamanan sistem dan data dengan pendekatan proaktif untuk menjaga kepercayaan pengguna
                            dan integritas aplikasi.</p>
                        <div>
                            <a href="#" class="text-primary me-2"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 text-center team-member">
                    <div class="card-body">
                        <img src="img/about olip.jpg" alt="Team Member" class="team-img mb-3">
                        <h3 class="h5">Raja Olivia Erika Ramadhani</h3>
                        <p class="text-muted">Testing & Evaluator</p>
                        <p>Menjamin kualitas produk melalui pengujian menyeluruh dan evaluasi yang detail demi pengalaman
                            pengguna terbaik.</p>
                        <div>
                            <a href="#" class="text-primary me-2"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="row mb-5">
            <div class="col-12 mb-4">
                <h2 class="h3 text-center">SURAM dalam Angka</h2>
            </div>
            <div class="col-md-4 col-6 mb-4">
                <div class="card border-0 shadow-sm text-center py-4">
                    <div class="card-body">
                        <h3 class="display-5 text-primary mb-1">{{ $totalUser }}</h3>
                        <p class="text-muted mb-0">Anggota</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-6 mb-4">
                <div class="card border-0 shadow-sm text-center py-4">
                    <div class="card-body">
                        <h3 class="display-5 text-primary mb-1">{{ $totalTopic }}</h3>
                        <p class="text-muted mb-0">Diskusi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-6 mb-4">
                <div class="card border-0 shadow-sm text-center py-4">
                    <div class="card-body">
                        <h3 class="display-5 text-primary mb-1">{{ $totalComment }}</h3>
                        <p class="text-muted mb-0">Komentar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-file')
@endsection
