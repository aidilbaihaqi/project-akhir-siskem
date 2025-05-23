<?php
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil semua kategori
$categories_result = $conn->query("SELECT * FROM categories ORDER BY name ASC");

if (!$categories_result) {
    die("Gagal mengambil kategori: " . $conn->error);
}
?>

<div class="container my-5">
    <h2>Semua Kategori Diskusi</h2>

    <?php while ($category = $categories_result->fetch_assoc()): ?>
        <div class="my-4 p-4 border rounded shadow-sm">
            <h4><?= htmlspecialchars($category['name']) ?></h4>

            <?php
            // Ambil maksimal 3 topik terbaru dari kategori ini
            $stmt = $conn->prepare("SELECT t.*, u.name AS author_name 
                                    FROM topics t
                                    JOIN users u ON t.author_id = u.id 
                                    WHERE t.category_id = ?
                                    ORDER BY t.created_at DESC
                                    LIMIT 3");
            $stmt->bind_param("i", $category['id']);
            $stmt->execute();
            $topics_result = $stmt->get_result();
            ?>

            <?php if ($topics_result->num_rows > 0): ?>
                <ul class="list-unstyled">
                    <?php while ($topic = $topics_result->fetch_assoc()): ?>
                        <li class="mb-2">
                            <a href="discussion.php?id=<?= $topic['id'] ?>">
                                <?= htmlspecialchars($topic['title']) ?>
                            </a>
                            <br><small>Oleh: <?= htmlspecialchars($topic['author_name']) ?> | <?= $topic['created_at'] ?></small>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <a href="kategori.php?id=<?= $category['id'] ?>" class="btn btn-sm btn-outline-primary">Lihat Semua Diskusi</a>
            <?php else: ?>
                <p class="text-muted">Belum ada topik dalam kategori ini.</p>
            <?php endif; ?>

        </div>
    <?php endwhile; ?>
</div>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Diskusi - SURAM</title>
    <meta name="description" content="Daftar kategori forum diskusi mahasiswa">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .category-card {
            transition: all 0.3s ease;
            border-left: 4px solid #0d6efd;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="categories.php">Categories</a>
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

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                    </ol>
                </nav>
                <h1 class="h2">Kategori Diskusi</h1>
                <p class="lead">Pilih kategori yang sesuai dengan topik yang ingin Anda diskusikan</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Category 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="card category-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-book text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                            <h3 class="h5 mb-0">Akademik</h3>
                        </div>
                        <p class="card-text">Diskusi seputar perkuliahan, tugas, mata kuliah, dan segala hal terkait akademik di kampus.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary rounded-pill">142 Diskusi</span>
                            <a href="akademik.php" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="card category-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-people text-success" style="font-size: 1.5rem;"></i>
                            </div>
                            <h3 class="h5 mb-0">Organisasi</h3>
                        </div>
                        <p class="card-text">Berbagi pengalaman dan informasi seputar organisasi kemahasiswaan, BEM, UKM, dan lainnya.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary rounded-pill">87 Diskusi</span>
                            <a href="organisasi.php" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="card category-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-award text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                            <h3 class="h5 mb-0">Beasiswa</h3>
                        </div>
                        <p class="card-text">Informasi beasiswa dalam dan luar negeri, tips mendapatkan beasiswa, dan pengalaman penerima beasiswa.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary rounded-pill">65 Diskusi</span>
                            <a href="beasiswa.php" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="card category-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-briefcase text-info" style="font-size: 1.5rem;"></i>
                            </div>
                            <h3 class="h5 mb-0">Karir</h3>
                        </div>
                        <p class="card-text">Diskusi seputar dunia kerja, magang, CV, interview, dan persiapan karir setelah lulus kuliah.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary rounded-pill">120 Diskusi</span>
                            <a href="karir.php" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category 5 -->
            <div class="col-md-6 col-lg-4">
                <div class="card category-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-danger bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-laptop text-danger" style="font-size: 1.5rem;"></i>
                            </div>
                            <h3 class="h5 mb-0">Teknologi</h3>
                        </div>
                        <p class="card-text">Diskusi seputar teknologi terbaru, pemrograman, gadget, dan solusi teknologi untuk mahasiswa.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary rounded-pill">76 Diskusi</span>
                            <a href="teknologi.php" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category 6 -->
            <div class="col-md-6 col-lg-4">
                <div class="card category-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-secondary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-heart text-secondary" style="font-size: 1.5rem;"></i>
                            </div>
                            <h3 class="h5 mb-0">Kesehatan</h3>
                        </div>
                        <p class="card-text">Tips menjaga kesehatan selama kuliah, mengatasi stress, dan informasi kesehatan penting untuk mahasiswa.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary rounded-pill">53 Diskusi</span>
                            <a href="kesehatan.php" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
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