@extends('layouts.main')

@section('inline-style')
<style>
        .category-card {
            transition: all 0.3s ease;
            border-left: 4px solid #0d6efd;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
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
                        <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                    </ol>
                </nav>
                <h1 class="h2">Kategori Diskusi</h1>
                <p class="lead">Pilih kategori yang sesuai dengan topik yang ingin Anda diskusikan</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach ($categories as $cat)
                <div class="col-md-6 col-lg-4">
                    <div class="card category-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                {{-- 
                        Jika ingin icon dinamis, tambahkan field 'icon' di tabel kategori (misal: 'bi-book', 'bi-people') 
                        atau ganti default jika tidak ada
                        --}}
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi {{ $cat->icon ?? 'bi-tag' }} text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                                <h3 class="h5 mb-0">{{ $cat->name }}</h3>
                            </div>
                            {{-- Deskripsi kategori: kalau belum ada field deskripsi di db, tampilkan default --}}
                            <p class="card-text">
                                {{ $cat->deskripsi ?? 'Diskusi dalam kategori ' . $cat->name }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary rounded-pill">{{ $cat->topics_count }} Diskusi</span>
                                <a href="" {{-- {{ route('categories.show', $cat->id) }} --}}
                                    class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script-file')
@endsection
