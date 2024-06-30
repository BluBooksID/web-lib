<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BluBooks</title>
    <!-- Sisipkan CSS Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Sisipkan CSS kustom untuk halaman login -->
    <link rel="stylesheet" href="../../resources/css/login.css">
    <!-- Sisipkan JavaScript khusus untuk admin -->
    <script src="../../resources/js/admin.js"></script>
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    // Mulai sesi untuk pengelolaan sesi
    session_start();

    // Sisipkan file AdminController untuk pengaturan admin
    include '../../controllers/AdminController.php';
    ?>
    <!-- Akhir php-backend -->


    <div class="login-page">
        <div class="form">
            <!-- Awal form register -->
            <form method="POST" action="">
                <h2><i class="fas fa-user-plus"></i> Admin</h2>
                <?php
                // Tampilkan pesan kesalahan jika ada
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<p style='color:red;'>$error</p>";
                    }
                }
                ?>
                <!-- Input untuk nama dengan validasi -->
                <input id="nama" type="text" name="nama" placeholder="Nama" required autocomplete="nama" autofocus>
                <!-- Pilihan jenis kelamin -->
                <select name="jenis_kelamin" required>
                    <option value="" disabled selected>Jenis Kelamin</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
                <!-- Input untuk email dengan validasi -->
                <input id="email" type="email" name="email" placeholder="Email" required autocomplete="email">
                <!-- Input untuk password dengan validasi -->
                <input id="password" type="password" name="password" placeholder="Password" required
                    autocomplete="new-password">
                <!-- Konfirmasi password -->
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password"
                    required autocomplete="new-password">
                <!-- Tombol submit untuk registrasi -->
                <button type="submit">REGISTER</button>
                <!-- Tautan untuk login jika sudah memiliki akun -->
                <p class="message">Sudah memiliki akun? <a href="../auth.php">Login</a></p>
                <!-- Tautan untuk kembali ke halaman utama -->
                <p class="message"><a href="../../index.php">Kembali ke Index</a></p>
            </form>
            <!-- Awal form register -->
        </div>
    </div>
</body>

</html>