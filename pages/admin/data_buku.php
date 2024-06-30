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

    // Memeriksa apakah pengguna sudah masuk sebagai admin dan memiliki nama admin
    if (!isset($_SESSION['id_admin']) || !isset($_SESSION['nama_admin'])) {
        // Memasukkan file konfigurasi untuk mengambil BASE_URL
        include '../../config.php';
        // Mengarahkan pengguna kembali ke halaman login jika belum masuk
        header("Location: " . BASE_URL . "/pages/auth.php");
        exit();
    }

    // Memasukkan file koneksi database
    include '../../db/koneksi.php';

    // Query untuk mengambil semua kategori
    $kategori_result = $conn->query("SELECT id_kategori, nama_kategori FROM kategori");

    // Memasukkan file controller BukuController.php untuk mengelola data buku
    include '../../controllers/BukuController.php';

    // Query untuk mengambil semua data buku dan nama kategori dengan join
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
        // Menampilkan data buku jika ada hasil query
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
                    <a href='edit_buku.php?id_buku=" . $row["id_buku"] . "'>Edit </a>";

                // Only show delete button if the book is not in a transaction
                if (!isBookInTransactions($conn, $row["id_buku"])) {
                    // Show delete link only if book is not in transactions
                    echo "<a href='data_buku.php?delete=" . $row["id_buku"] . "' onclick=\"return confirm('Are you sure?')\">| Delete</a>";
                }

                echo "</td>";
                echo "</tr>";
            }
        } else {
            // Menampilkan pesan jika tidak ada data buku
            echo "<tr><td colspan='10'>0 results</td></tr>";
        }
        ?>
    </table>

    <h2>Tambah Buku</h2>

    <!-- Awal form tambah -->
    <form method="post" action="data_buku.php" enctype="multipart/form-data">
        <input type="hidden" name="id_buku" value="<?php echo isset($_GET['id_buku']) ? $_GET['id_buku'] : ''; ?>">
        Cover: <input type="file" name="cover"><br>
        Nama Buku: <input type="text" name="nama_buku"><br>
        Author Buku: <input type="text" name="author_buku"><br>
        Tanggal Terbit: <input type="date" name="tanggal_terbit"><br>
        Bahasa: <input type="text" name="bahasa"><br>
        Deskripsi: <textarea name="deskripsi"></textarea><br>
        Kategori:
        <select name="id_kategori">
            <?php
            // Menampilkan pilihan kategori berdasarkan hasil query
            while ($row = $kategori_result->fetch_assoc()) {
                echo "<option value='" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . "</option>";
            }
            ?>
        </select><br>
        Stok: <input type="number" name="stok"><br>
        <input type="submit" value="Save">
        <a href="dashboard.php">Kembali Ke Dashboard</a>
    </form>
    <!-- Akhir form tambah -->

</body>

</html>