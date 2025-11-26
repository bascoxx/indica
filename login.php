<?php
// login.php - Kedai INDICA (versi benar & simpel)
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Kedai INDICA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow mt-5">
                <div class="card-header bg-success text-white text-center py-4">
                    <h3 class="mb-0">Kedai INDICA</h3>
                </div>
                <div class="card-body p-4">

                    <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger">Username atau password salah!</div>
                    <?php endif; ?>

                    <?php if(isset($_GET['logout'])): ?>
                        <div class="alert alert-info">Logout berhasil.</div>
                    <?php endif; ?>

                    <form action="proses_login.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" name="username" class="form-control" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100">LOGIN</button>
                    </form>

                    <hr class="my-4">
                    <small class="text-muted d-block text-center">
                        <strong>User untuk testing:</strong><br>
                        • admin → admin123<br>
                        • kasir1 → kasir123<br>
                        • owner → owner123
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>