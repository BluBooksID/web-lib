<!DOCTYPE html>
<html>

<head>
    <title>Buku yang Dipinjam</title>
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    // Memulai sesi untuk pengelolaan sesi
    session_start();

    // Memeriksa apakah pengguna sudah masuk (login)
    if (!isset($_SESSION['id_pengguna'])) {
        // Menampilkan pesan jika pengguna belum masuk
        echo "User not logged in.";
        exit;
    }

    // Memasukkan file koneksi database
    include '../../db/koneksi.php';

    // Memasukkan id_pengguna dari sesi yang aktif
    $id_pengguna = $_SESSION['id_pengguna'];

    // Memasukkan file controller TransaksiController.php untuk mengelola transaksi
    include '../../controllers/TransaksiController.php';

    // Menjalankan query pengembalian untuk mendapatkan hasil transaksi pengembalian
    $result = $conn->query($pengembalian);
    ?>
    <!-- Akhir php-backend -->


    <h2>Daftar Buku yang Dipinjam</h2>
    <table border="1">
        <tr>
            <th>ID Buku</th>
            <th>Cover</th>
            <th>Nama Buku</th>
            <th>Author Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Pengembalian</th>
            <th>Status</th>
            <th></th>
        </tr>
        <?php
        // Menampilkan data buku yang dipinjam jika ada hasil query
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_buku"] . "</td>";
                echo "<td><img src='../../" . $row["cover"] . "' width='50' height='50'></td>";
                echo "<td>" . $row["nama_buku"] . "</td>";
                echo "<td>" . $row["author_buku"] . "</td>";
                echo "<td>" . $row["tanggal_pinjam"] . "</td>";
                echo "<td>" . ($row["tanggal_pengembalian"] ? $row["tanggal_pengembalian"] : "Belum dikembalikan") . "</td>";
                echo "<td>" . ucfirst($row["status_buku"]) . "</td>";
                echo "<td>";
                // Menampilkan link untuk mengembalikan buku jika statusnya masih 'dipinjam'
                if ($row["status_buku"] == 'dipinjam') {
                    echo "<a href='list_pinjam_buku.php?return=" . $row["id_transaksi"] . "' onclick=\"return confirm('Konfirmasi?')\">Kembalikan Buku</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            // Menampilkan pesan jika tidak ada buku yang dipinjam
            echo "<tr><td colspan='8'>Belum ada buku yang dipinjam.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>

</html>