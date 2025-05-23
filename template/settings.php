<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - SURAM</title>
    <meta name="description" content="User account settings page for SURAM forum">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .settings-nav .nav-link {
            color: #495057;
            border-radius: 0.25rem;
            padding: 0.5rem 1rem;
        }
        .settings-nav .nav-link.active {
            color: #0d6efd;
            background-color: rgba(13, 110, 253, 0.1);
        }
        .settings-nav .nav-link:hover:not(.active) {
            background-color: #f8f9fa;
        }
        .avatar-upload {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }
        .avatar-upload .avatar-preview {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #f8f9fa;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-edit {
            position: absolute;
            right: 10px;
            bottom: 10px;
        }
        .avatar-upload .avatar-edit input {
            display: none;
        }
        .avatar-upload .avatar-edit label {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .password-toggle {
            cursor: pointer;
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
                        <a class="nav-link" href="popular.php">Popular</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-3">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown">
                            <img src="img/about aidil.jpg" alt="Profile" width="32" height="32" class="rounded-circle me-2">
                            <span>Aidil Baihaqi</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2"></i>Profil</a></li>
                            <li><a class="dropdown-item" href="activity.php"><i class="bi bi-clock-history me-2"></i>Aktivitas</a></li>
                            <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                        </ul>
                    </div>
                    <a href="create-topic.php" class="btn btn-light">Buat Diskusi</a>
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
                        <li class="breadcrumb-item"><a href="profile.php">Profil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
                    </ol>
                </nav>
                <h1 class="h2 mb-0">Pengaturan Akun</h1>
            </div>
        </div>

        <div class="row">
            <!-- Settings Navigation -->
            <div class="col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body p-0">
                        <ul class="nav flex-column settings-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="#profile" data-bs-toggle="pill">
                                    <i class="bi bi-person me-2"></i>Profil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#account" data-bs-toggle="pill">
                                    <i class="bi bi-gear me-2"></i>Akun
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#password" data-bs-toggle="pill">
                                    <i class="bi bi-lock me-2"></i>Password
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#privacy" data-bs-toggle="pill">
                                    <i class="bi bi-shield-lock me-2"></i>Privasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#notifications" data-bs-toggle="pill">
                                    <i class="bi bi-bell me-2"></i>Notifikasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#danger" data-bs-toggle="pill">
                                    <i class="bi bi-exclamation-triangle me-2"></i>Zona Bahaya
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="col-lg-9">
                <div class="tab-content">
                    <!-- Profile Tab -->
                    <div class="tab-pane fade show active" id="profile">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="h5 mb-0">Informasi Profil</h3>
                            </div>
                            <div class="card-body">
                                <form id="profileForm">
                                    <!-- Avatar -->
                                    <div class="mb-4 text-center">
                                        <div class="avatar-upload">
                                            <div class="avatar-preview" id="avatarPreview" style="background-image: url('https://picsum.photos/150?random=61');"></div>
                                            <div class="avatar-edit">
                                                <input type="file" id="avatarUpload" accept="image/*">
                                                <label for="avatarUpload"><i class="bi bi-camera"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Full Name -->
                                        <div class="col-md-6 mb-3">
                                            <label for="fullName" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="fullName" value="Aidil Baihaqi" required>
                                        </div>

                                        <!-- Username -->
                                        <div class="col-md-6 mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <div class="input-group">
                                                <span class="input-group-text">@</span>
                                                <input type="text" class="form-control" id="username" value="aidilbaihaqi" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bio -->
                                    <div class="mb-3">
                                        <label for="bio" class="form-label">Bio</label>
                                        <textarea class="form-control" id="bio" rows="3">Mahasiswa Teknik Informatika yang Berfokus pada pengembangan produk digital dan keamanan sistem yang andal.</textarea>
                                    </div>

                                    <div class="row">
                                        <!-- University -->
                                        <div class="col-md-6 mb-3">
                                            <label for="university" class="form-label">Universitas</label>
                                            <input type="text" class="form-control" id="university" value="Universitas Maritim Raja Ali Haji" required>
                                        </div>

                                        <!-- Major -->
                                        <div class="col-md-6 mb-3">
                                            <label for="major" class="form-label">Jurusan</label>
                                            <input type="text" class="form-control" id="major" value="Teknik Informatika" required>
                                        </div>
                                    </div>

                                    <!-- Location -->
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Lokasi</label>
                                        <input type="text" class="form-control" id="location" value="Kepulauan Riau, Indonesia">
                                    </div>

                                    <!-- Website -->
                                    <div class="mb-3">
                                        <label for="website" class="form-label">Website</label>
                                        <input type="url" class="form-control" id="website" value="https://aidilbaihaqi.dev">
                                    </div>

                                    <!-- Save Button -->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Account Tab -->
                    <div class="tab-pane fade" id="account">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="h5 mb-0">Pengaturan Akun</h3>
                            </div>
                            <div class="card-body">
                                <form id="accountForm">
                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <input type="email" class="form-control" id="email" value="aidil.baihaqi@gmail.com" required>
                                        <div class="form-text">Kami akan mengirim email verifikasi jika Anda mengubah alamat email.</div>
                                    </div>

                                    <!-- Language -->
                                    <div class="mb-3">
                                        <label for="language" class="form-label">Bahasa</label>
                                        <select class="form-select" id="language">
                                            <option value="id" selected>Bahasa Indonesia</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>

                                    <!-- Timezone -->
                                    <div class="mb-3">
                                        <label for="timezone" class="form-label">Zona Waktu</label>
                                        <select class="form-select" id="timezone">
                                            <option value="WIB" selected>WIB (UTC +7)</option>
                                            <option value="WITA">WITA (UTC +8)</option>
                                            <option value="WIT">WIT (UTC +9)</option>
                                        </select>
                                    </div>

                                    <!-- Save Button -->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Connected Accounts -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h5 mb-0">Akun Terhubung</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <i class="bi bi-google me-2"></i>
                                            <span>Google</span>
                                        </div>
                                        <button class="btn btn-sm btn-outline-danger">Putuskan</button>
                                    </div>
                                    <small class="text-muted">Terhubung dengan andi.pratama@example.com</small>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <i class="bi bi-facebook me-2"></i>
                                            <span>Facebook</span>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary">Hubungkan</button>
                                    </div>
                                </div>

                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <i class="bi bi-twitter me-2"></i>
                                            <span>Twitter</span>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary">Hubungkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password Tab -->
                    <div class="tab-pane fade" id="password">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h5 mb-0">Ubah Password</h3>
                            </div>
                            <div class="card-body">
                                <form id="passwordForm">
                                    <!-- Current Password -->
                                    <div class="mb-3">
                                        <label for="currentPassword" class="form-label">Password Saat Ini</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="currentPassword" required>
                                            <span class="input-group-text password-toggle" data-target="currentPassword">
                                                <i class="bi bi-eye"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- New Password -->
                                    <div class="mb-3">
                                        <label for="newPassword" class="form-label">Password Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="newPassword" required>
                                            <span class="input-group-text password-toggle" data-target="newPassword">
                                                <i class="bi bi-eye"></i>
                                            </span>
                                        </div>
                                        <div class="form-text">Minimal 8 karakter, mengandung huruf besar, angka, dan karakter khusus.</div>
                                    </div>

                                    <!-- Confirm New Password -->
                                    <div class="mb-4">
                                        <label for="confirmNewPassword" class="form-label">Konfirmasi Password Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirmNewPassword" required>
                                            <span class="input-group-text password-toggle" data-target="confirmNewPassword">
                                                <i class="bi bi-eye"></i>
                                            </span>
                                        </div>
                                        <div class="invalid-feedback" id="passwordMatchFeedback">
                                            Password tidak cocok
                                        </div>
                                    </div>

                                    <!-- Save Button -->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy Tab -->
                    <div class="tab-pane fade" id="privacy">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h5 mb-0">Pengaturan Privasi</h3>
                            </div>
                            <div class="card-body">
                                <form id="privacyForm">
                                    <!-- Profile Visibility -->
                                    <div class="mb-4">
                                        <h4 class="h6 mb-3">Visibilitas Profil</h4>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="profileVisibility" id="profilePublic" checked>
                                            <label class="form-check-label" for="profilePublic">
                                                Publik - Profil Anda dapat dilihat oleh siapa saja
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="profileVisibility" id="profilePrivate">
                                            <label class="form-check-label" for="profilePrivate">
                                                Pribadi - Hanya pengguna yang Anda ikuti yang dapat melihat profil Anda
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Activity Privacy -->
                                    <div class="mb-4">
                                        <h4 class="h6 mb-3">Privasi Aktivitas</h4>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="showOnlineStatus" checked>
                                            <label class="form-check-label" for="showOnlineStatus">Tampilkan status online</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="showActivity" checked>
                                            <label class="form-check-label" for="showActivity">Tampilkan aktivitas terbaru di profil</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="showReputation" checked>
                                            <label class="form-check-label" for="showReputation">Tampilkan reputasi di profil</label>
                                        </div>
                                    </div>

                                    <!-- Data Sharing -->
                                    <div class="mb-4">
                                        <h4 class="h6 mb-3">Berbagi Data</h4>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="allowAnalytics" checked>
                                            <label class="form-check-label" for="allowAnalytics">Izinkan analitik anonim untuk meningkatkan pengalaman</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="allowPersonalizedAds">
                                            <label class="form-check-label" for="allowPersonalizedAds">Izinkan iklan yang dipersonalisasi</label>
                                        </div>
                                    </div>

                                    <!-- Save Button -->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Tab -->
                    <div class="tab-pane fade" id="notifications">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h5 mb-0">Pengaturan Notifikasi</h3>
                            </div>
                            <div class="card-body">
                                <form id="notificationsForm">
                                    <!-- Email Notifications -->
                                    <div class="mb-4">
                                        <h4 class="h6 mb-3">Notifikasi Email</h4>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="emailReplies" checked>
                                            <label class="form-check-label" for="emailReplies">Balasan pada diskusi saya</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="emailMentions" checked>
                                            <label class="form-check-label" for="emailMentions">Saya disebut dalam komentar</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="emailLikes">
                                            <label class="form-check-label" for="emailLikes">Suka pada diskusi/komentar saya</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="emailNewsletter" checked>
                                            <label class="form-check-label" for="emailNewsletter">Buletin mingguan</label>
                                        </div>
                                    </div>

                                    <!-- Push Notifications -->
                                    <div class="mb-4">
                                        <h4 class="h6 mb-3">Notifikasi Aplikasi</h4>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="pushReplies" checked>
                                            <label class="form-check-label" for="pushReplies">Balasan pada diskusi saya</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="pushMentions" checked>
                                            <label class="form-check-label" for="pushMentions">Saya disebut dalam komentar</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="pushFollowing">
                                            <label class="form-check-label" for="pushFollowing">Aktivitas pengguna yang saya ikuti</label>
                                        </div>
                                    </div>

                                    <!-- Save Button -->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Danger Zone Tab -->
                    <div class="tab-pane fade" id="danger">
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white">
                                <h3 class="h5 mb-0">Zona Bahaya</h3>
                            </div>
                            <div class="card-body">
                                <!-- Deactivate Account -->
                                <div class="mb-4">
                                    <h4 class="h6 text-danger mb-3">Nonaktifkan Akun</h4>
                                    <p>Akun Anda akan dinonaktifkan dan tidak dapat diakses sampai Anda login kembali. Diskusi dan komentar Anda akan tetap ada.</p>
                                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deactivateModal">Nonaktifkan Akun</button>
                                </div>

                                <!-- Delete Account -->
                                <div>
                                    <h4 class="h6 text-danger mb-3">Hapus Akun Permanen</h4>
                                    <p>Akun Anda akan dihapus permanen beserta semua data yang terkait. Aksi ini tidak dapat dibatalkan.</p>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus Akun</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deactivate Account Modal -->
    <div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactivateModalLabel">Nonaktifkan Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menonaktifkan akun Anda? Anda dapat mengaktifkannya kembali kapan saja dengan login.</p>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="confirmDeactivate">
                        <label class="form-check-label" for="confirmDeactivate">
                            Ya, saya mengerti dan ingin menonaktifkan akun saya
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="deactivateAccount" disabled>Nonaktifkan Akun</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Akun Permanen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">Peringatan: Aksi ini tidak dapat dibatalkan. Semua data Anda akan dihapus permanen.</p>
                    <p>Untuk memverifikasi, ketik <strong>HAPUS AKUN</strong> di bawah ini:</p>
                    <input type="text" class="form-control mb-3" id="deleteConfirmation">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="confirmDelete">
                        <label class="form-check-label" for="confirmDelete">
                            Saya mengerti bahwa semua data saya akan dihapus permanen dan tidak dapat dipulihkan
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="deleteAccount" disabled>Hapus Akun Permanen</button>
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
        // Avatar upload preview
        document.getElementById('avatarUpload').addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatarPreview').style.backgroundImage = 'url(' + event.target.result + ')';
            };
            reader.readAsDataURL(e.target.files[0]);
        });

        // Password toggle
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });

        // Check password match
        document.getElementById('newPassword').addEventListener('input', checkPasswordMatch);
        document.getElementById('confirmNewPassword').addEventListener('input', checkPasswordMatch);
        
        function checkPasswordMatch() {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmNewPassword').value;
            const feedback = document.getElementById('passwordMatchFeedback');
            
            if (newPassword && confirmPassword && newPassword !== confirmPassword) {
                document.getElementById('confirmNewPassword').classList.add('is-invalid');
                feedback.style.display = 'block';
            } else {
                document.getElementById('confirmNewPassword').classList.remove('is-invalid');
                feedback.style.display = 'none';
            }
        }

        // Deactivate account confirmation
        document.getElementById('confirmDeactivate').addEventListener('change', function() {
            document.getElementById('deactivateAccount').disabled = !this.checked;
        });

        // Delete account confirmation
        const deleteConfirmation = document.getElementById('deleteConfirmation');
        const confirmDelete = document.getElementById('confirmDelete');
        
        deleteConfirmation.addEventListener('input', function() {
            const deleteBtn = document.getElementById('deleteAccount');
            deleteBtn.disabled = !(this.value === 'HAPUS AKUN' && confirmDelete.checked);
        });
        
        confirmDelete.addEventListener('change', function() {
            const deleteBtn = document.getElementById('deleteAccount');
            deleteBtn.disabled = !(deleteConfirmation.value === 'HAPUS AKUN' && this.checked);
        });

        // Form submissions (for demo purposes)
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Perubahan berhasil disimpan!');
            });
        });
    </script>
</body>
</html>