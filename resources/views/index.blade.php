@extends('layouts.main')

@section('inline-style')
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
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-center mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Suara Mahasiswa</h1>
            <p class="lead mb-5">Platform diskusi mahasiswa Universitas Maritim Raja Ali Haji</p>
            <a href="{{ route('topics.create') }}" class="btn btn-primary btn-lg px-4 me-2">Buat Diskusi Baru</a>
            <a href="#trending" class="btn btn-outline-light btn-lg px-4">Lihat Trending</a>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mb-5">
        <div class="row">
            <!-- Main Discussions -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4">
                        @if ($sort == 'populer')
                            Diskusi Populer
                        @elseif($sort == 'banyak-komentar')
                            Diskusi Paling Banyak Komentar
                        @else
                            Diskusi Terbaru
                        @endif
                    </h2>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown"
                            data-bs-toggle="dropdown">
                            Urutkan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ $sort == 'terbaru' ? 'active' : '' }}"
                                    href="{{ url('/?sort=terbaru') }}">Terbaru</a></li>
                            <li><a class="dropdown-item {{ $sort == 'populer' ? 'active' : '' }}"
                                    href="{{ url('/?sort=populer') }}">Populer</a></li>
                            <li><a class="dropdown-item {{ $sort == 'banyak-komentar' ? 'active' : '' }}"
                                    href="{{ url('/?sort=banyak-komentar') }}">Paling Banyak Komentar</a></li>
                        </ul>
                    </div>
                </div>

                <div class="list-group mb-5">
                    @forelse($topics as $topic)
                        <a href="" {{-- {{ route('topics.show', $topic->id) }} --}}
                            class="list-group-item list-group-item-action discussion-card mb-3 card-hover">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $topic->title }}</h5>
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($topic->created_at)->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">{{ \Illuminate\Support\Str::limit(strip_tags($topic->content), 140) }}</p>
                            <div class="d-flex justify-content-between mt-2">
                                <small class="text-muted">
                                    Oleh: <strong>{{ $topic->user->name }}</strong> di
                                    <strong>{{ $topic->category->name ?? '-' }}</strong>
                                </small>
                                <div>
                                    <span class="badge bg-primary rounded-pill me-1">
                                        <i class="bi bi-chat"></i> {{ $topic->comments_count }}
                                    </span>
                                    <span class="badge bg-success rounded-pill">
                                        <i class="bi bi-eye"></i> {{ $topic->view_count }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="alert alert-info">Belum ada diskusi.</div>
                    @endforelse
                </div>

                {{ $topics->links() }}
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
                            <a href="categories.html"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Akademik
                                <span class="badge bg-primary rounded-pill">142</span>
                            </a>
                            <a href="categories.html"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Organisasi
                                <span class="badge bg-primary rounded-pill">87</span>
                            </a>
                            <a href="categories.html"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Beasiswa
                                <span class="badge bg-primary rounded-pill">65</span>
                            </a>
                            <a href="categories.html"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Karir
                                <span class="badge bg-primary rounded-pill">120</span>
                            </a>
                            <a href="categories.html"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
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
@endsection
