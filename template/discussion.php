<?php
session_start();
require_once 'config.php';

if (!isset($_GET['id'])) {
    die("ID diskusi tidak ditemukan.");
}

$topic_id = intval($_GET['id']);

// ambil data topik + kategori + author
$stmt = $conn->prepare("SELECT t.*, c.name AS category_name, u.name AS author_name 
                        FROM topics t 
                        JOIN categories c ON t.category_id = c.id 
                        JOIN users u ON t.author_id = u.id 
                        WHERE t.id = ?");
$stmt->bind_param("i", $topic_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Diskusi tidak ditemukan.");
}

$topic = $result->fetch_assoc();

// update view_count
$conn->query("UPDATE topics SET view_count = view_count + 1 WHERE id = $topic_id");

// ambil komentar dari topik ini
$comments_res = $conn->query("SELECT c.*, u.name AS user_name 
                              FROM comments c 
                              JOIN users u ON c.user_id = u.id 
                              WHERE c.topic_id = $topic_id 
                              ORDER BY c.created_at ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskusi - SURAM</title>
    <meta name="description" content="Halaman diskusi tunggal forum mahasiswa">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .comment-card {
            border-left: 3px solid #dee2e6;
            transition: all 0.3s ease;
        }
        .comment-card:hover {
            border-left-color: #0d6efd;
        }
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .reply-form {
            display: none;
        }
        .like-btn.active {
            color: #0d6efd;
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
                        <a class="nav-link" href="categories.php">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="popular.php">Popular</a></li>
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
                        <li class="breadcrumb-item"><a href="categories.php">Akademik</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Diskusi</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <!-- Discussion Content -->
            <div class="col-lg-8">
                <!-- Discussion Header -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge bg-primary mb-2">Akademik</span>
                                <h1 class="h3 mb-2">Bagaimana menyikapi kenaikan harga BBM untuk mahasiswa?</h1>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="discussionMenu" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-bookmark me-2"></i>Bookmark</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-share me-2"></i>Share</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-flag me-2"></i>Report</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://picsum.photos/50?random=20" alt="User Avatar" class="user-avatar me-3">
                            <div>
                                <h6 class="mb-0">Andi Pratama</h6>
                                <small class="text-muted">Diposting 3 jam lalu · 24 komentar</small>
                            </div>
                        </div>

                        <div class="discussion-content mb-4">
                            <p>Dengan kenaikan harga BBM baru-baru ini, bagaimana sebaiknya mahasiswa menyikapi hal ini? Apakah ada solusi kreatif yang bisa dilakukan?</p>
                            <p>Saya sendiri sebagai mahasiswa di Jakarta merasa sangat terbebani dengan kenaikan harga BBM ini. Biaya transportasi naik signifikan, sementara uang saku dari orang tua tidak bertambah. Bagaimana dengan kalian?</p>
                            <p>Mungkin ada yang punya ide untuk berbagi kendaraan ke kampus, atau alternatif transportasi lain yang lebih murah? Atau mungkin ada yang punya pengalaman mengajukan bantuan transportasi ke pihak kampus?</p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button class="btn btn-sm btn-outline-secondary me-2 like-btn">
                                    <i class="bi bi-hand-thumbs-up"></i> Suka <span class="badge bg-secondary">42</span>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-bookmark"></i> Simpan
                                </button>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-outline-primary" onclick="shareDiscussion()">
                                    <i class="bi bi-share"></i> Bagikan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h2 class="h5 mb-0">24 Komentar</h2>
                    </div>
                    <div class="card-body">

                    <!-- Tampilkan semua komentar -->
                    <?php while ($comment = $comments_res->fetch_assoc()): ?>
                <div class="border rounded p-3 mb-3">
                    <p><strong><?= htmlspecialchars($comment['user_name']) ?></strong> 
                    <small class="text-muted"><?= $comment['created_at'] ?></small></p>
                    <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>

                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment['user_id']): ?>
                    <div class="mt-2">
                        <a href="edit_comment.php?id=<?= $comment['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_comment.php?id=<?= $comment['id'] ?>&topic=<?= $topic_id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus komentar ini?');">Hapus</a>
                    </div>
                <?php endif; ?>

                <div class="mt-2">
                <a href="like_comment.php?id=<?= $comment['id'] ?>&topic=<?= $topic_id ?>" class="btn btn-sm btn-outline-success">👍 Suka</a>

                <?php
                // Ambil jumlah like untuk komentar ini
                $likeStmt = $conn->prepare("SELECT COUNT(*) AS total FROM likes WHERE comment_id = ?");
                $likeStmt->bind_param("i", $comment['id']);
                $likeStmt->execute();
                $likeResult = $likeStmt->get_result();
                $likeCount = $likeResult->fetch_assoc()['total'];
                ?>
                <span class="ms-2 text-muted">👍 <?= $likeCount ?></span>
            </div>

                </div>
            <?php endwhile; ?>


            <!-- Form komentar --> 
             <?php if (isset($_SESSION['user_id'])): ?>
            <form action="actions/add_comment.php" method="POST">
                <input type="hidden" name="topic_id" value="<?= $topic_id ?>">
                <div class="mb-3">
                    <label for="comment" class="form-label">Tulis Komentar:</label>
                    <textarea name="comment" id="comment" rows="4" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>
        <?php else: ?>
            <p><a href="login.php">Login</a> untuk menulis komentar.</p>
        <?php endif; ?>

                        <!-- Comments List -->
                        <div class="comments-list">
                            <!-- Comment 1 -->
                            <div class="comment-card mb-4 p-3">
                                <div class="d-flex mb-3">
                                    <img src="https://picsum.photos/50?random=21" alt="User Avatar" class="user-avatar me-3">
                                    <div>
                                        <h6 class="mb-0">Siti Rahayu</h6>
                                        <small class="text-muted">2 jam lalu</small>
                                    </div>
                                </div>
                                <div class="comment-body mb-3">
                                    <p>Di kampus kami ada program carpooling yang diorganisir oleh BEM. Mahasiswa yang punya kendaraan bisa mendaftar sebagai driver, dan yang tidak punya bisa ikut dengan membayar biaya transport yang lebih murah dari angkot biasa. Mungkin bisa dicoba di kampusmu?</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-sm btn-outline-secondary me-2 like-btn">
                                            <i class="bi bi-hand-thumbs-up"></i> Suka <span class="badge bg-secondary">15</span>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary reply-btn" data-target="replyForm1">
                                            <i class="bi bi-reply"></i> Balas
                                        </button>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-flag"></i> Laporkan
                                        </button>
                                    </div>
                                </div>
                                <!-- Reply Form (Hidden by default) -->
                                <div class="reply-form mt-3" id="replyForm1">
                                    <form>
                                        <div class="mb-2">
                                            <textarea class="form-control" rows="2" placeholder="Tulis balasan..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Kirim Balasan</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm cancel-reply" data-target="replyForm1">Batal</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Comment 2 -->
                            <div class="comment-card mb-4 p-3">
                                <div class="d-flex mb-3">
                                    <img src="https://picsum.photos/50?random=22" alt="User Avatar" class="user-avatar me-3">
                                    <div>
                                        <h6 class="mb-0">Budi Santoso</h6>
                                        <small class="text-muted">1 jam lalu</small>
                                    </div>
                                </div>
                                <div class="comment-body mb-3">
                                    <p>Saya pribadi beralih ke sepeda untuk ke kampus. Selain lebih murah, juga lebih sehat. Memang butuh usaha lebih karena harus bangun lebih awal, tapi sejauh ini cukup membantu menghemat pengeluaran.</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-sm btn-outline-secondary me-2 like-btn">
                                            <i class="bi bi-hand-thumbs-up"></i> Suka <span class="badge bg-secondary">8</span>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary reply-btn" data-target="replyForm2">
                                            <i class="bi bi-reply"></i> Balas
                                        </button>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-flag"></i> Laporkan
                                        </button>
                                    </div>
                                </div>
                                <!-- Reply Form (Hidden by default) -->
                                <div class="reply-form mt-3" id="replyForm2">
                                    <form>
                                        <div class="mb-2">
                                            <textarea class="form-control" rows="2" placeholder="Tulis balasan..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Kirim Balasan</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm cancel-reply" data-target="replyForm2">Batal</button>
                                    </form>
                                </div>

                                <!-- Nested Comment -->
                                <div class="comment-card mt-3 p-3 ms-4" style="background-color: #f8f9fa;">
                                    <div class="d-flex mb-3">
                                        <img src="https://picsum.photos/50?random=23" alt="User Avatar" class="user-avatar me-3">
                                        <div>
                                            <h6 class="mb-0">Dewi Anggraeni</h6>
                                            <small class="text-muted">45 menit lalu</small>
                                        </div>
                                    </div>
                                    <div class="comment-body mb-3">
                                        <p>Setuju dengan Budi. Di kampus kami juga sedang digalakkan gerakan "Bike to Campus". Bahkan ada fasilitas parkir khusus sepeda dan shower untuk yang berkeringat. Mungkin bisa diusulkan ke pihak kampus?</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <button class="btn btn-sm btn-outline-secondary me-2 like-btn">
                                                <i class="bi bi-hand-thumbs-up"></i> Suka <span class="badge bg-secondary">3</span>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary reply-btn" data-target="replyForm3">
                                                <i class="bi bi-reply"></i> Balas
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-flag"></i> Laporkan
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Reply Form (Hidden by default) -->
                                    <div class="reply-form mt-3" id="replyForm3">
                                        <form>
                                            <div class="mb-2">
                                                <textarea class="form-control" rows="2" placeholder="Tulis balasan..."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Kirim Balasan</button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm cancel-reply" data-target="replyForm3">Batal</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Comment 3 -->
                            <div class="comment-card mb-4 p-3">
                                <div class="d-flex mb-3">
                                    <img src="https://picsum.photos/50?random=24" alt="User Avatar" class="user-avatar me-3">
                                    <div>
                                        <h6 class="mb-0">Rudi Hermawan</h6>
                                        <small class="text-muted">30 menit lalu</small>
                                    </div>
                                </div>
                                <div class="comment-body mb-3">
                                    <p>Kami di BEM sedang mengusulkan ke rektorat untuk memberikan subsidi transportasi bagi mahasiswa yang terkena dampak kenaikan BBM. Mungkin bisa dicoba juga di kampus lain. Biasanya kampus memiliki dana untuk bantuan mahasiswa.</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-sm btn-outline-secondary me-2 like-btn">
                                            <i class="bi bi-hand-thumbs-up"></i> Suka <span class="badge bg-secondary">5</span>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary reply-btn" data-target="replyForm4">
                                            <i class="bi bi-reply"></i> Balas
                                        </button>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-flag"></i> Laporkan
                                        </button>
                                    </div>
                                </div>
                                <!-- Reply Form (Hidden by default) -->
                                <div class="reply-form mt-3" id="replyForm4">
                                    <form>
                                        <div class="mb-2">
                                            <textarea class="form-control" rows="2" placeholder="Tulis balasan..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Kirim Balasan</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm cancel-reply" data-target="replyForm4">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Related Discussions -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h2 class="h5 mb-0">Diskusi Terkait</h2>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="discussion.php" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Dampak kenaikan BBM terhadap harga makanan di kantin kampus</h6>
                                    <small class="text-muted">1 hari lalu</small>
                                </div>
                                <small class="text-muted">Oleh: Fitriani</small>
                            </a>
                            <a href="discussion.php" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Usulan transportasi gratis untuk mahasiswa dari pemerintah daerah</h6>
                                    <small class="text-muted">2 hari lalu</small>
                                </div>
                                <small class="text-muted">Oleh: BEM Universitas</small>
                            </a>
                            <a href="discussion.php" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Alternatif transportasi murah untuk mahasiswa di kota besar</h6>
                                    <small class="text-muted">3 hari lalu</small>
                                </div>
                                <small class="text-muted">Oleh: Ahmad Fauzi</small>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Discussion Stats -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Statistik Diskusi</h5>
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="p-2">
                                    <h3 class="h5 text-primary">24</h3>
                                    <small>Komentar</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2">
                                    <h3 class="h5 text-success">156</h3>
                                    <small>Dilihat</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2">
                                    <h3 class="h5 text-warning">42</h3>
                                    <small>Suka</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Info -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tentang Kategori</h5>
                        <p class="card-text">Diskusi seputar perkuliahan, tugas, mata kuliah, dan segala hal terkait akademik di kampus.</p>
                        <a href="categories.php" class="btn btn-sm btn-outline-primary">Lihat Semua Diskusi</a>
                    </div>
                </div>

                <!-- Rules -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h2 class="h5 mb-0">Aturan Diskusi</h2>
                    </div>
                    <div class="card-body">
                        <ol class="small ps-3">
                            <li class="mb-2">Hargai pendapat orang lain</li>
                            <li class="mb-2">Gunakan bahasa yang sopan</li>
                            <li class="mb-2">Jangan menyebarkan hoax atau informasi palsu</li>
                            <li class="mb-2">Fokus pada topik yang dibahas</li>
                            <li>Laporkan konten yang melanggar aturan</li>
                        </ol>
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
    <script>
        // Like button functionality
        document.querySelectorAll('.like-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                const badge = this.querySelector('.badge');
                if (this.classList.contains('active')) {
                    badge.textContent = parseInt(badge.textContent) + 1;
                    badge.classList.remove('bg-secondary');
                    badge.classList.add('bg-primary');
                } else {
                    badge.textContent = parseInt(badge.textContent) - 1;
                    badge.classList.remove('bg-primary');
                    badge.classList.add('bg-secondary');
                }
            });
        });

        // Reply button functionality
        document.querySelectorAll('.reply-btn').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                document.getElementById(targetId).style.display = 'block';
            });
        });

        // Cancel reply button functionality
        document.querySelectorAll('.cancel-reply').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                document.getElementById(targetId).style.display = 'none';
            });
        });

        // Comment form submission
        document.getElementById('commentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const commentText = document.getElementById('commentText').value;
            // Here you would typically send the comment to the server
            alert('Komentar Anda telah dikirim: ' + commentText);
            document.getElementById('commentText').value = '';
        });

        // Share discussion function
        function shareDiscussion() {
            // In a real app, this would use the Web Share API or social media sharing
            alert('Berbagi diskusi ini ke media sosial atau teman');
        }
    </script>
</body>
</html>