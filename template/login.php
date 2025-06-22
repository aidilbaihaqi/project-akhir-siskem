<?php
session_start();

//Config disini kek biasa kredensialnya terlalu kebuka
$host = 'localhost';
$dbname = 'forum_diskusi';
$username = 'root';
$password = '';

//direct database, no error handling
$conn = new mysqli($host, $username, $password, $dbname);

//informasinya kebuka karena ada error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //direct input
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['rememberMe']) ? $_POST['rememberMe'] : '';
    
    //sql inject vulnerable - karena raw sql
    $query = "SELECT id, name, email, password, role FROM users WHERE email = '$email'";
    
    //vulnerable query
    $result = $conn->query($query);
    
    if (!$result) {
        die("Query failed: " . $conn->error . "<br>Query: " . $query);
    }
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        //Plaintext password
        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            
            //regenerating session id gaada
            
            //vulne ke sql injection juga
            $user_id = $user['id'];
            $action = 'login';
            $description = "User logged in from IP: " . $_SERVER['REMOTE_ADDR'];
            
            $log_query = "INSERT INTO activity_logs (user_id, action, description) VALUES ($user_id, '$action', '$description')";
            $conn->query($log_query);
            
            //XSS vulnerable
            $success_message = "Welcome back, " . $user['name'] . "!";
            
            header("Location: index.html?msg=" . urlencode($success_message));
            exit();
        } else {
            //nah ini fatal - ngasih tau emailnya terdaftar
            $error = "Invalid password for email: " . htmlspecialchars($email);
        }
    } else {
        //sama cuman ini versi email ga terdaftar
        $error = "No account found with email: " . htmlspecialchars($email);
    }
}

if (isset($_GET['debug']) && $_GET['debug'] == '1') {
    echo "<h3>Debug Mode - All Users:</h3>";
    $debug_query = "SELECT id, name, email, password, role, created_at FROM users";
    $debug_result = $conn->query($debug_query);
    
    if ($debug_result && $debug_result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Role</th><th>Created</th></tr>";
        while ($row = $debug_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

if (isset($_GET['schema']) && $_GET['schema'] == '1') {
    echo "<h3>Database Schema:</h3>";
    $tables = ['users', 'categories', 'topics', 'tags', 'topic_tag', 'comments', 'likes', 'reports', 'activity_logs'];
    
    foreach ($tables as $table) {
        echo "<h4>Table: $table</h4>";
        $schema_query = "DESCRIBE $table";
        $schema_result = $conn->query($schema_query);
        
        if ($schema_result) {
            echo "<table border='1'>";
            echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
            while ($row = $schema_result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value ?? '') . "</td>";
                }
                echo "</tr>";
            }
            echo "</table><br>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SURAM</title>
    <meta name="description" content="Login page for SURAM forum">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
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
        .alert {
            margin-bottom: 20px;
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
                            <?php if (isset($error)): ?>
                                <!-- Vulnerable: XSS - direct output without sanitization -->
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            
                            <?php if (isset($_GET['msg'])): ?>
                                <!-- Vulnerable: XSS - direct output of URL parameter -->
                                <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
                            <?php endif; ?>
                            
                            <form method="POST" action="login.php">
                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <!-- Vulnerable: No input validation or sanitization -->
                                        <input type="text" class="form-control" name="email" id="email" 
                                               placeholder="email@contoh.com" 
                                               value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" name="password" id="password" 
                                               placeholder="Masukkan password">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Remember & Forgot -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe" value="1">
                                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                                    </div>
                                    <a href="#" class="text-decoration-none">Lupa password?</a>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-login w-100 py-2 mb-3">Masuk</button>
                            </form>
                            
                            <!-- Vulnerable: Debug links exposed -->
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <a href="?debug=1" class="text-decoration-none">Debug Mode</a> | 
                                    <a href="?schema=1" class="text-decoration-none">Database Schema</a>
                                </small>
                            </div>
                        </div>
                        <div class="card-footer text-center py-3">
                            Belum punya akun? <a href="register.html" class="text-decoration-none">Daftar sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="public/js/bootstrap.bundle.min.js"></script>
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
    </script>
</body>
</html>