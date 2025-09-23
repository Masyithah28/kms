<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="css/icon-corp.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Petrokopindo Cipta Selaras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inria+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap">

    <!-- Additional security headers -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' https://cdn.jsdelivr.net;">
</head>

<body>
    <div class="login-card">
        <img src="css/LOGO-CORP.png" alt="Logo PT Petrokopindo Cipta Selaras" class="logo">
        <h4 class="mb-4 fw-bold">KMS Petrokopindo</h4>

        <!-- Display error message if any -->
        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
            <div class="alert alert-danger">Email atau Password salah!</div>
        <?php endif; ?>

        <!-- Form -->
        <form action="koneksilogin.php" method="post">
            <div class="mb-3 text-start">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required>
            </div>
            <div class="mb-3 text-start">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password Anda" required>
            </div>

            <!-- Checkbox Tampilkan Kata Sandi -->
            <div class="form-check text-start mb-4">
                <input type="checkbox" class="form-check-input" id="showPassword" onclick="showHide()">
                <label class="form-check-label" for="showPassword">Tampilkan Password</label>
            </div>

            <button type="submit" class="btn btn-custom mt-3">Masuk</button>
        </form>

        <!-- Footer Text -->
        <p class="footer-text">IT PT Petrokopindo Cipta Selaras © 2024</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk menampilkan/menyembunyikan password
        function showHide() {
            var passwordInput = document.getElementById("password");
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
