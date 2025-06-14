<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Suara Mahasiswa UMRAH</title>
    <meta name="description" content="Forum diskusi mahasiswa Indonesia">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    @yield('inline-style')
</head>

<body>
    <!-- Navbar -->
    @include('partials.navbar')

    @yield('content')

    <!-- Footer -->
    @include('partials.footer')

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @yield('script-file')
</body>

</html>
