<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - BluBooks</title>
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    session_start();
    // Memeriksa apakah sesi id_admin dan nama_admin sudah ada
    if (!isset($_SESSION['id_admin']) || !isset($_SESSION['nama_admin'])) {
        // Jika belum, arahkan ke halaman login
        include '../../config.php';
        header("Location: " . BASE_URL . "/pages/auth.php");
        exit();
    }
    ?>
    <!-- Akhir php-backend -->


    <!-- Awal navbar -->
    <div>
        <table>
            <tr>
                <td>
                    <a href="data_buku.php">Kelola Buku</a>
                </td>
                <td>
                    <a href="admin_pinjaman.php">Kelola Pinjaman Buku</a>
                </td>
                <td>
                    <a href="riwayat_transaksi.php">Riwayat Transaksi</a>
                </td>
                <td>
                    <a href="../logout.php">Logout</a>
                </td>
            </tr>
        </table>
    </div>
    <!-- Akhir navbar -->

    <h1>Halo, <?php echo htmlspecialchars($_SESSION['nama_admin'], ENT_QUOTES); ?></h1>
    <p>Ini adalah dashboard admin.</p>
</body>

</html>