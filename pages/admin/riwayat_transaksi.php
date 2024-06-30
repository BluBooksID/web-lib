<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Transaksi</title>
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    // Memulai sesi untuk pengelolaan sesi
    session_start();

    // Memasukkan file koneksi database
    include '../../db/koneksi.php';

    // Memeriksa apakah pengguna sudah masuk sebagai admin
    if (!isset($_SESSION['id_admin'])) {
        // Menampilkan pesan jika akses tidak diotorisasi
        echo "Unauthorized access";
        exit;
    }

    // Memasukkan file controller TransaksiController.php untuk mengelola transaksi
    include '../../controllers/TransaksiController.php';

    // Menjalankan query riwayat_transaksi untuk mendapatkan hasil transaksi
    $result = $conn->query($riwayat_transaksi);
    ?>
    <!-- Akhir php-backend -->


    <h2>Riwayat Transaksi</h2>
    <table border="1">
        <tr>
            <th>ID Transaksi</th>
            <th>Nama Pengguna</th>
            <th>Cover</th>
            <th>Nama Buku</th>
            <th>Author Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Pengembalian</th>
            <th>Status Buku</th>
        </tr>
        <?php
        // Menampilkan riwayat transaksi jika ada hasil query
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_transaksi"] . "</td>";
                echo "<td>" . $row["nama_pengguna"] . "</td>";
                echo "<td><img src='../../" . $row["cover"] . "' width='50' height='50'></td>";
                echo "<td>" . $row["nama_buku"] . "</td>";
                echo "<td>" . $row["author_buku"] . "</td>";
                echo "<td>" . $row["tanggal_pinjam"] . "</td>";
                echo "<td>" . $row["tanggal_pengembalian"] . "</td>";
                echo "<td>" . ucfirst($row["status_buku"]) . "</td>";
                echo "</tr>";
            }
        } else {
            // Menampilkan pesan jika tidak ada transaksi yang diverifikasi
            echo "<tr><td colspan='8'>Belum ada transaksi yang diverifikasi.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>

</html>