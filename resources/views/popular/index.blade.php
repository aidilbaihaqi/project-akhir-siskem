@extends('layouts.main')

@section('inline-style')
  <style>
        .discussion-card {
            transition: all 0.3s ease;
            border-left: 4px solid #0d6efd;
        }
        .discussion-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .popular-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #ffc107;
            color: #000;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container my-5">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Populer</li>
                </ol>
            </nav>
            <h1 class="h2">Diskusi Populer</h1>
            <p class="lead">Topik yang sedang banyak dibicarakan oleh mahasiswa</p>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Filter -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="sortBy" class="form-label">Urutkan</label>
                            <select class="form-select" id="sortBy" name="sort" onchange="this.form.submit()">
                                <option value="populer" {{ $sort == 'populer' ? 'selected' : '' }}>Paling Populer</option>
                                <option value="komentar" {{ $sort == 'komentar' ? 'selected' : '' }}>Paling Banyak Komentar</option>
                                <option value="terbaru" {{ $sort == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="timeRange" class="form-label">Rentang Waktu</label>
                            <select class="form-select" id="timeRange" name="time" onchange="this.form.submit()">
                                <option value="all" {{ $time == 'all' ? 'selected' : '' }}>Semua Waktu</option>
                                <option value="today" {{ $time == 'today' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="week" {{ $time == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="month" {{ $time == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="categoryFilter" class="form-label">Kategori</label>
                            <select class="form-select" id="categoryFilter" name="category" onchange="this.form.submit()">
                                <option value="all" {{ $cat == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{ $cat == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Popular Discussions -->
            <div class="list-group mb-5 mt-4">
                @foreach($topics as $idx => $topic)
                <a href="{{ route('topics.show', $topic->id) }}"
                   class="list-group-item list-group-item-action discussion-card mb-3 position-relative">
                    @if($idx < 3)
                    <div class="popular-badge">{{ $idx + 1 }}</div>
                    @endif
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $topic->title }}</h5>
                        <small class="text-muted">{{ $topic->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ \Illuminate\Support\Str::limit(strip_tags($topic->content), 140) }}</p>
                    <div class="d-flex justify-content-between mt-2">
                        <small class="text-muted">
                            Oleh: <strong>{{ $topic->user->name }}</strong> di <strong>{{ $topic->category->name ?? '-' }}</strong>
                        </small>
                        <div>
                            <span class="badge bg-primary rounded-pill me-1"><i class="bi bi-chat"></i> {{ $topic->comments_count }}</span>
                            <span class="badge bg-success rounded-pill"><i class="bi bi-eye"></i> {{ number_format($topic->view_count) }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            {{ $topics->links() }}
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Trending This Week -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Trending Minggu Ini</h5>
                    <div class="list-group list-group-flush">
                        @foreach($trending as $trend)
                        <a href="{{ route('topics.show', $trend->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $trend->title }}</h6>
                                <small class="text-muted">{{ $trend->created_at->diffForHumans() }}</small>
                            </div>
                            <small class="text-muted">Oleh: {{ $trend->user->name }}</small>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Popular Categories -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Kategori Populer</h5>
                    <div class="list-group list-group-flush">
                        @foreach($categories as $c)
                        <a href="{{ route('categories.show', $c->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $c->name }}
                            <span class="badge bg-primary rounded-pill">{{ $c->topics_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Statistik Forum</h5>
                    <div class="row">
                        <div class="col-6">
                            <div class="p-3">
                                <h3 class="text-primary">{{ number_format($totalTopics) }}</h3>
                                <small>Diskusi</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3">
                                <h3 class="text-success">{{ number_format($totalComments) }}</h3>
                                <small>Komentar</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-file')
    
@endsection