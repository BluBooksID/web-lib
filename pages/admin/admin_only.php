<?php
// PHP code remains the same
session_start();
define('KODE_AKSES', 'admin');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_password = $_POST['password'];
    if ($input_password === KODE_AKSES) {
        $_SESSION['akses_diberikan'] = true;
        header('Location: admin_register.php');
        exit();
    } else {
        $error = 'Kode Akses Salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Admin - BluBooks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container-fluid vh-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4"><i class="fas fa-lock"></i> Akses Admin</h2>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password" required
                                    placeholder="Kode Akses">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">SUBMIT</button>
                            <p class="text-center mt-3">
                                <a href="../../index.php" class="text-decoration-none">Kembali ke Index</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>