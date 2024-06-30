<!DOCTYPE html>
<html>

<head>
    <title>Data Buku</title>
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

    // Memasukkan file controller UserController.php untuk mengelola data pengguna
    include '../../controllers/UserController.php';

    // Memasukkan file koneksi database
    include '../../db/koneksi.php';

    // Query untuk mengambil data buku beserta kategori dari tabel buku dan kategori
    $sql = "SELECT buku.*, kategori.nama_kategori FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori";
    $result = $conn->query($sql);
    ?>
    <!-- Akhir php-backend -->


    <h2>Data Buku</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Cover</th>
            <th>Nama Buku</th>
            <th>Author Buku</th>
            <th>Tanggal Terbit</th>
            <th>Bahasa</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th></th>
        </tr>
        <?php
        // Menampilkan data buku jika hasil query lebih dari 0
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_buku"] . "</td>";
                echo "<td><img src='../../" . $row["cover"] . "' width='50' height='50'></td>";
                echo "<td>" . $row["nama_buku"] . "</td>";
                echo "<td>" . $row["author_buku"] . "</td>";
                echo "<td>" . $row["tanggal_terbit"] . "</td>";
                echo "<td>" . $row["bahasa"] . "</td>";
                echo "<td>" . $row["deskripsi"] . "</td>";
                echo "<td>" . $row["nama_kategori"] . "</td>";
                echo "<td>" . $row["stok"] . "</td>";
                echo "<td>
                    <a href='data_buku.php?borrow=" . $row["id_buku"] . "' onclick=\"return confirm('Konfirmasi')\">Pinjam Buku</a>
                  </td>";
                echo "</tr>";
            }
        } else {
            // Menampilkan pesan jika tidak ada hasil
            echo "<tr><td colspan='10'>0 results</td></tr>";
        }
        ?>
    </table>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>

</html>