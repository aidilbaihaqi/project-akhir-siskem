<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="Forum diskusi mahasiswa Indonesia">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
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
    @yield('content')

    <script src="{{ asset("js/bootstrap.bundle.min.js") }}"></script>
</body>
</html>