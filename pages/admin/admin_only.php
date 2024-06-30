<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Admin - BluBooks</title>
    <!-- Sisipkan CSS Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Sisipkan CSS kustom untuk halaman login -->
    <link rel="stylesheet" href="../../resources/css/login.css">
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    // Mulai sesi untuk pengelolaan sesi
    session_start();

    // Kode akses = admin
    define('KODE_AKSES', 'admin');

    // Periksa jika metode permintaan adalah POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input_password = $_POST['password'];

        // Periksa apakah kode akses yang dimasukkan sesuai dengan variabel KODE_AKSES
        if ($input_password === KODE_AKSES) {
            $_SESSION['akses_diberikan'] = true;
            header('Location: admin_register.php');
            exit();
        } else {
            $error = 'Kode Akses Salah!';
        }
    }
    ?>
    <!-- Akhir php-backend -->


    <div class="login-page">
        <div class="form">
            <form class="login-form" method="POST" action="">
                <h2><i class="fas fa-lock"></i> Akses Admin</h2>
                <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
                <input type="password" name="password" required placeholder="Kode Akses">
                <button type="submit">SUBMIT</button>
                <p class="message"><a href="../../index.php">Kembali ke Index</a></p>
            </form>
        </div>
    </div>
</body>

</html>