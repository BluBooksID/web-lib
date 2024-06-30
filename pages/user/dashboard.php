<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BluBooks</title>
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    // Memulai sesi untuk pengelolaan sesi
    session_start();

    // Memeriksa apakah pengguna sudah masuk (login)
    if (!isset($_SESSION['id_pengguna'])) {
        // Memasukkan file konfigurasi untuk mengambil BASE_URL
        include '../../config.php';
        // Mengarahkan pengguna kembali ke halaman login jika belum masuk
        header("Location: " . BASE_URL . "/pages/auth.php");
        exit();
    }
    ?>
    <!-- Akhir php-backend -->


    <!-- Awal navbar -->
    <div>
        <tr>
            <td>
                <a href="data_buku.php">List Buku</a>
            </td>
            <td>
                <a href="list_pinjam_buku.php">List Buku Yang Dipinjam</a>
            </td>
            <td>
                <a href="../logout.php">Logout</a>
            </td>
        </tr>
    </div>
    <!-- Akhir navbar -->
    <h1>Halo, <?php echo htmlspecialchars($_SESSION['nama_pengguna'], ENT_QUOTES); ?></h1>
    <p>Ini adalah dashboard user.</p>
</body>

</html>