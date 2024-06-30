<!DOCTYPE html>
<html>

<head>
    <title>Manajemen Pinjaman Buku</title>
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    // Mulai sesi untuk pengelolaan sesi
    session_start();

    // Periksa apakah pengguna sudah masuk sebagai admin
    if (!isset($_SESSION['id_admin'])) {
        echo "Akses Ditolak!";
        exit;
    }

    // Sisipkan file TransaksiController untuk pengaturan transaksi
    include '../../controllers/TransaksiController.php';

    // Sisipkan file koneksi database
    include '../../db/koneksi.php';

    // Query untuk mendapatkan data transaksi yang perlu diverifikasi
    $result = $conn->query($verifikasi);
    ?>
    <!-- Akhir php-backend -->


    <h2>Manajemen Pinjaman Buku</h2>
    <table border="1">
        <tr>
            <th>Nama Pengguna</th>
            <th>Cover</th>
            <th>Nama Buku</th>
            <th>Author Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Pengembalian</th>
            <th>Status Buku</th>
            <th></th>
        </tr>
        <?php
        // Tampilkan data transaksi jika ada
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nama_pengguna"] . "</td>";
                echo "<td><img src='../../" . $row["cover"] . "' width='50' height='50'></td>";
                echo "<td>" . $row["nama_buku"] . "</td>";
                echo "<td>" . $row["author_buku"] . "</td>";
                echo "<td>" . $row["tanggal_pinjam"] . "</td>";
                echo "<td>" . ($row["tanggal_pengembalian"] ? $row["tanggal_pengembalian"] : "Belum dikembalikan") . "</td>";
                echo "<td>" . ucfirst($row["status_buku"]) . "</td>";
                echo "<td>";
                // Tampilkan tombol verifikasi jika status buku adalah 'on_review'
                if ($row["status_buku"] == 'on_review') {
                    echo "<a href='admin_pinjaman.php?verify=dikembalikan&id_transaksi=" . $row["id_transaksi"] . "'>Verifikasi</a>";
                } elseif ($row["status_buku"] == 'dikembalikan') {
                    echo "Sudah diverifikasi";
                } else {
                    echo "";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            // Tampilkan pesan jika belum ada buku yang perlu diverifikasi
            echo "<tr><td colspan='10'>Belum ada buku yang perlu diverifikasi.</td></tr>";
        }
        ?>
    </table>
    <br>
    <!-- Tautan kembali ke dashboard -->
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>

</html>