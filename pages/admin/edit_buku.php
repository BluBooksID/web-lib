<!DOCTYPE html>
<html>

<head>
    <title>Edit Buku</title>
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

    // Mengambil id_buku dari parameter GET
    $id_buku = $_GET['id_buku'];

    // Query untuk mengambil data buku berdasarkan id_buku
    $sql = "SELECT * FROM buku WHERE id_buku=$id_buku";
    $result = $conn->query($sql);

    // Memeriksa apakah ada hasil query untuk id_buku tertentu
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        // Menampilkan pesan jika tidak ada record yang ditemukan
        echo "No record found";
        exit;
    }

    // Query untuk mengambil semua kategori
    $kategori_result = $conn->query("SELECT id_kategori, nama_kategori FROM kategori");

    // Menutup koneksi database
    $conn->close();
    ?>
    <!-- Akhir php-backend -->


    <h2>Edit Buku</h2>

    <!-- Awal form edit -->
    <form method="post" action="data_buku.php" enctype="multipart/form-data">
        <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
        <input type="hidden" name="current_cover" value="<?php echo $row['cover']; ?>">
        Cover: <input type="file" name="cover"><br>
        Nama Buku: <input type="text" name="nama_buku" value="<?php echo $row['nama_buku']; ?>"><br>
        Author Buku: <input type="text" name="author_buku" value="<?php echo $row['author_buku']; ?>"><br>
        Tanggal Terbit: <input type="date" name="tanggal_terbit" value="<?php echo $row['tanggal_terbit']; ?>"><br>
        Bahasa: <input type="text" name="bahasa" value="<?php echo $row['bahasa']; ?>"><br>
        Deskripsi: <textarea name="deskripsi"><?php echo $row['deskripsi']; ?></textarea><br>
        Kategori:
        <select name="id_kategori">
            <?php
            // Menampilkan pilihan kategori berdasarkan hasil query
            while ($kategori_row = $kategori_result->fetch_assoc()) {
                $selected = ($kategori_row['id_kategori'] == $row['id_kategori']) ? 'selected' : '';
                echo "<option value='" . $kategori_row['id_kategori'] . "' $selected>" . $kategori_row['nama_kategori'] . "</option>";
            }
            ?>
        </select><br>
        Stok: <input type="number" name="stok" value="<?php echo $row['stok']; ?>"><br>
        <input type="submit" value="Save">
        <a href="data_buku.php">Cancel</a>
    </form>
    <!-- Akhir form edit -->

</body>

</html>