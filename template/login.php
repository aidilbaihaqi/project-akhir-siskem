<?php
session_start();
require 'config.php'; // koneksi ke database: $conn

// Jika sudah login
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit;
}

// Proses login (VULNERABLE!)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // SQL Injection vulnerability
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        echo "<script>alert('Login berhasil!'); window.location.href='index.php';</script>";
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SURAM</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .login-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://picsum.photos/1920/1080?random=30');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: none;
        }
        .login-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 1rem 1rem 0 0 !important;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .btn-login {
            background-color: #0d6efd;
            color: white;
            font-weight: 600;
        }
        .btn-login:hover {
            background-color: #0b5ed7;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Flash Messages -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card login-card">
                        <div class="card-header login-header py-4 text-center">
                            <h2 class="h3 mb-0">Masuk ke SURAM (Bobrok)</h2>
                        </div>
                        <div class="card-body p-5">
                            <form id="loginForm" action="login.php" method="POST">
                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="email@contoh.com" required>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-login w-100 py-2 mb-3">Login</button>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            Belum punya akun? <a href="register.php" class="text-decoration-none">Daftar sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
