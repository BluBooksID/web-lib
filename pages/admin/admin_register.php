<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BluBooks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="/web-lib/resources/css/login.css">
</head>

<body>
    <div class="login-page">
        <div class="form">
            <h2><i class="fas fa-user-plus"></i> Admin</h2>

            <?php
            // Assuming $errors is initialized and populated in your PHP logic
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama" required
                        autocomplete="nama" autofocus>
                </div>

                <div class="mb-3">
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="" disabled selected>Jenis Kelamin</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" required
                        autocomplete="email">
                </div>

                <div class="mb-3">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                        required autocomplete="new-password">
                </div>

                <div class="mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        placeholder="Confirm Password" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">REGISTER</button>

                <p class="message">Sudah Daftar? <a href="/web-lib/pages/auth.php">Masuk</a></p>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="../../resources/js/admin.js"></script>
</body>

</html>