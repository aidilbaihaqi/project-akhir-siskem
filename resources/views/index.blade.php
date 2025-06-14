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
                <div class="position-relative mb-4">
                    <form class="input-group" autocomplete="off"
                        onsubmit="event.preventDefault(); window.location.href='/?q=' + encodeURIComponent(document.getElementById('topicSearchInput').value);">
                        <input type="text" class="form-control" id="topicSearchInput" placeholder="Kata kunci..."
                            autocomplete="off">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                    <div id="searchSuggestion" class="list-group position-absolute w-100"
                        style="z-index: 1000; display:none"></div>
                </div>


                <!-- Categories -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Kategori Populer</h6>
                        @foreach ($categories as $cat)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>{{ $cat->name }}</span>
                                <span class="badge bg-primary rounded-pill">{{ $cat->topics_count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>


                <!-- Trending Discussions -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Trending Minggu Ini</h6>
                        @foreach ($trendingTopics as $trend)
                            <div class="mb-2">
                                <a href="" {{-- {{ route('topics.show', $trend->id) }} --}} class="fw-semibold">{{ $trend->title }}</a>
                                <div class="text-muted small">
                                    Oleh: {{ $trend->user->name }}
                                    <span class="ms-1">• {{ $trend->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <!-- Statistics -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h6 class="card-title mb-3">Statistik Forum</h6>
                        <div class="d-flex justify-content-around">
                            <div>
                                <div class="fw-bold text-primary" style="font-size: 1.3rem;">
                                    {{ number_format($totalTopics) }}</div>
                                <div class="small text-muted">Diskusi</div>
                            </div>
                            <div>
                                <div class="fw-bold text-success" style="font-size: 1.3rem;">
                                    {{ number_format($totalComments) }}</div>
                                <div class="small text-muted">Komentar</div>
                            </div>
                            <div>
                                <div class="fw-bold text-warning" style="font-size: 1.3rem;">
                                    {{ number_format($totalUsers) }}</div>
                                <div class="small text-muted">Anggota</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script-file')
    <script>
        const searchInput = document.getElementById('topicSearchInput');
        const suggestionBox = document.getElementById('searchSuggestion');

        // Close suggestion when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionBox.contains(e.target)) {
                suggestionBox.style.display = 'none';
            }
        });

        // Show suggestions on input
        searchInput.addEventListener('input', function() {
            const keyword = this.value.trim();
            if (keyword.length < 2) {
                suggestionBox.style.display = 'none';
                suggestionBox.innerHTML = '';
                return;
            }
            fetch(`/topics/autocomplete?q=${encodeURIComponent(keyword)}`)
                .then(r => r.json())
                .then(data => {
                    if (data.length === 0) {
                        suggestionBox.innerHTML =
                            `<div class="list-group-item text-muted">Tidak ada hasil</div>`;
                    } else {
                        suggestionBox.innerHTML = data.map(item =>
                            `<a href="/topics/${item.id}" class="list-group-item list-group-item-action">${item.title}</a>`
                        ).join('');
                    }
                    suggestionBox.style.display = 'block';
                });
        });

        // Hide suggestion when input loses focus (but delay for link click)
        searchInput.addEventListener('blur', function() {
            setTimeout(() => {
                suggestionBox.style.display = 'none';
            }, 200);
        });

        // Optional: Enter keyboard to go to first suggestion
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowDown') {
                const first = suggestionBox.querySelector('.list-group-item-action');
                if (first) first.focus();
            }
        });
    </script>
@endsection
