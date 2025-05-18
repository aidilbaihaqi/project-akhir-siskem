<?php
// login.php
session_start();

// Security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

require 'config.php';

// Jika user sudah login, redirect ke dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php");
    exit;
}

// Proses Login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Rate limiting: Maks 5 percobaan dalam 5 menit
    if (($_SESSION['login_attempts'] ?? 0) >= 5 && time() - ($_SESSION['last_attempt'] ?? 0) < 300) {
        $error = "Terlalu banyak percobaan. Coba lagi nanti.";
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Format email tidak valid!";
        } else {
            // Query ke database
            $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password'])) {
                    // Regenerate session ID
                    session_regenerate_id(true);

                    // Set session data
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_role'] = $user['role'];
                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['last_activity'] = time();

                    // Set cookie params
                    $cookieParams = session_get_cookie_params();
                    setcookie(
                        session_name(),
                        session_id(),
                        [
                            'lifetime' => 86400,
                            'path' => '/',
                            'domain' => $cookieParams['domain'],
                            'secure' => true, // Ganti jadi true jika pakai HTTPS
                            'httponly' => true,
                            'samesite' => 'Strict'
                        ]
                    );

                    // Reset login attempts
                    unset($_SESSION['login_attempts']);
                    unset($_SESSION['last_attempt']);

                    // Redirect ke dashboard
                    header("Location: dashboard.php");
                    exit;
                }
            }
            
            // Jika gagal
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
            $_SESSION['last_attempt'] = time();
            $error = "Email atau password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SURAM</title>
    <meta name="description" content="Login page for SURAM forum">
    <link rel="stylesheet" href="/project-akhir-siskem-main/template/public/css/bootstrap.min.css"/>
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
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #6c757d;
            margin: 1rem 0;
        }
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        .divider::before {
            margin-right: 1rem;
        }
        .divider::after {
            margin-left: 1rem;
        }
    </style>
</head>
<body>
    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card login-card">
                        <div class="card-header login-header py-4 text-center">
                            <h2 class="h3 mb-0">Masuk ke SURAM</h2>
                        </div>
                        <div class="card-body p-5">
                            <form id="loginForm" action="login.php" method="POST">
                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="email@contoh.com" required>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Remember & Forgot -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                                    </div>
                                    <a href="#" class="text-decoration-none">Lupa password?</a>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-login w-100 py-2 mb-3">Masuk</button>

                                <!-- Divider 
                                <div class="divider">atau</div>
                                -->

                                <!-- Social Login
                                <div class="text-center">
                                    <p class="mb-3">Masuk dengan</p>
                                    <div class="d-flex justify-content-center gap-3">
                                        <a href="#" class="btn btn-outline-primary rounded-circle p-2">
                                            <i class="bi bi-google"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-primary rounded-circle p-2">
                                            <i class="bi bi-facebook"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-primary rounded-circle p-2">
                                            <i class="bi bi-twitter"></i>
                                        </a>
                                    </div>
                                </div>
                                -->
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            Belum punya akun? <a href="register.html" class="text-decoration-none">Daftar sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/project-akhir-siskem-main/template/public/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
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

        // Form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('rememberMe').checked;
            
            // In a real application, you would send this data to your server
            console.log('Login attempt with:', { email, password, rememberMe });
            
            // For demo purposes, redirect to homepage after "login"
            window.location.href = 'index.html';
        });
    </script>
</body>
</html>