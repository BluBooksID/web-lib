<?php
// PHP code remains the same
session_start();
include '../../controllers/AdminController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BluBooks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container-fluid py-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4"><i class="fas fa-user-plus"></i> Admin</h2>

                        <?php
                        if (!empty($errors)) {
                            foreach ($errors as $error) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        }
                        ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama"
                                    required autocomplete="nama" autofocus>
                            </div>

                            <div class="mb-3">
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="" disabled selected>Jenis Kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                                    required autocomplete="email">
                            </div>

                            <div class="mb-3">
                                <input id="password" type="password" class="form-control" name="password"
                                    placeholder="Password" required autocomplete="new-password">
                            </div>

                            <div class="mb-3">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Confirm Password" required
                                    autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">REGISTER</button>

                            <p class="text-center">Sudah memiliki akun? <a href="../auth.php"
                                    class="text-decoration-none">Login</a></p>
                            <p class="text-center"><a href="../../index.php" class="text-decoration-none">Kembali ke
                                    Index</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="../../resources/js/admin.js"></script>
</body>

</html>