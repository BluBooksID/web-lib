<?php
include '../db/koneksi.php'; // Pastikan path file koneksi.php sudah benar

$id_buku = $_GET['id_buku'];

$sql = "SELECT * FROM buku WHERE id_buku=$id_buku";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No record found";
    exit;
}

// Ambil data kategori untuk dropdown
$kategori_result = $conn->query("SELECT id_kategori, nama_kategori FROM kategori");

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
</head>
<body>

<h2>Edit Buku</h2>

<form method="post" action="data_buku.php" enctype="multipart/form-data">
    <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
    <input type="hidden" name="current_cover" value="<?php echo $row['cover']; ?>">
    Cover: <input type="file" name="cover"><br>
    Nama Buku: <input type="text" name="nama_buku" value="<?php echo $row['nama_buku']; ?>"><br>
    Author Buku: <input type="text" name="author_buku" value="<?php echo $row['author_buku']; ?>"><br>
    Tanggal Terbit: <input type="date" name="tanggal_terbit" value="<?php echo $row['tanggal_terbit']; ?>"><br>
    Bahasa: <input type="text" name="bahasa" value="<?php echo $row['bahasa']; ?>"><br>
    Deskripsi: <textarea name="deskripsi"><?php echo $row['deskripsi']; ?></textarea><br>
    ID Kategori: 
    <select name="id_kategori">
        <?php
        while($kategori_row = $kategori_result->fetch_assoc()) {
            $selected = ($kategori_row['id_kategori'] == $row['id_kategori']) ? 'selected' : '';
            echo "<option value='" . $kategori_row['id_kategori'] . "' $selected>" . $kategori_row['nama_kategori'] . "</option>";
        }
        ?>
    </select><br>
    Stok: <input type="number" name="stok" value="<?php echo $row['stok']; ?>"><br>
    <input type="submit" value="Save">
</form>

</body>
</html>