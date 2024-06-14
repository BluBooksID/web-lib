<?php
include '../db/koneksi.php'; // Pastikan path file koneksi.php sudah benar

// Retrieve categories for dropdown
$kategori_result = $conn->query("SELECT id_kategori, nama_kategori FROM kategori");

// Handle Create and Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_buku = isset($_POST['id_buku']) ? $_POST['id_buku'] : '';
    $cover = isset($_FILES['cover']) ? $_FILES['cover'] : null;
    $nama_buku = $_POST['nama_buku'];
    $author_buku = $_POST['author_buku'];
    $tanggal_terbit = $_POST['tanggal_terbit'];
    $bahasa = $_POST['bahasa'];
    $deskripsi = $_POST['deskripsi'];
    $id_kategori = $_POST['id_kategori'];
    $stok = $_POST['stok'];
    $cover_path = '';

    if ($cover && $cover['error'] === UPLOAD_ERR_OK) {
        // Handle file upload
        $target_dir = "../uploads/"; // Path disesuaikan
        $target_file = $target_dir . basename($cover["name"]);
        if (move_uploaded_file($cover["tmp_name"], $target_file)) {
            $cover_path = "uploads/" . basename($cover["name"]); // Path disimpan dalam database
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    if ($id_buku) {
        // Update existing record
        if ($cover_path) {
            // Use new cover if uploaded
            $sql = "UPDATE buku SET cover='$cover_path', nama_buku='$nama_buku', author_buku='$author_buku', tanggal_terbit='$tanggal_terbit', bahasa='$bahasa', deskripsi='$deskripsi', id_kategori=$id_kategori, stok=$stok WHERE id_buku=$id_buku";
        } else {
            // Keep old cover if no new cover uploaded
            $sql = "UPDATE buku SET nama_buku='$nama_buku', author_buku='$author_buku', tanggal_terbit='$tanggal_terbit', bahasa='$bahasa', deskripsi='$deskripsi', id_kategori=$id_kategori, stok=$stok WHERE id_buku=$id_buku";
        }
    } else {
        // Insert new record
        $sql = "INSERT INTO buku (cover, nama_buku, author_buku, tanggal_terbit, bahasa, deskripsi, id_kategori, stok)
                VALUES ('$cover_path', '$nama_buku', '$author_buku', '$tanggal_terbit', '$bahasa', '$deskripsi', $id_kategori, $stok)";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record successfully saved";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id_buku = $_GET['delete'];
    $sql = "DELETE FROM buku WHERE id_buku=$id_buku";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Retrieve Data
$sql = "SELECT * FROM buku";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
</head>
<body>

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
        <th>ID Kategori</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_buku"] . "</td>";
            echo "<td><img src='../" . $row["cover"] . "' width='50' height='50'></td>"; // Path disesuaikan
            echo "<td>" . $row["nama_buku"] . "</td>";
            echo "<td>" . $row["author_buku"] . "</td>";
            echo "<td>" . $row["tanggal_terbit"] . "</td>";
            echo "<td>" . $row["bahasa"] . "</td>";
            echo "<td>" . $row["deskripsi"] . "</td>";
            echo "<td>" . $row["id_kategori"] . "</td>";
            echo "<td>" . $row["stok"] . "</td>";
            echo "<td>
                    <a href='edit_buku.php?id_buku=" . $row["id_buku"] . "'>Edit</a> | 
                    <a href='data_buku.php?delete=" . $row["id_buku"] . "' onclick=\"return confirm('Are you sure?')\">Delete</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>0 results</td></tr>";
    }
    ?>
</table>

<h2>Tambah Buku</h2>

<form method="post" action="data_buku.php" enctype="multipart/form-data">
    <input type="hidden" name="id_buku" value="<?php echo isset($_GET['id_buku']) ? $_GET['id_buku'] : ''; ?>">
    Cover: <input type="file" name="cover"><br>
    Nama Buku: <input type="text" name="nama_buku"><br>
    Author Buku: <input type="text" name="author_buku"><br>
    Tanggal Terbit: <input type="date" name="tanggal_terbit"><br>
    Bahasa: <input type="text" name="bahasa"><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br>
    ID Kategori: 
    <select name="id_kategori">
        <?php
        while($row = $kategori_result->fetch_assoc()) {
            echo "<option value='" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . "</option>";
        }
        ?>
    </select><br>
    Stok: <input type="number" name="stok"><br>
    <input type="submit" value="Save">
</form>

</body>
</html>

<?php
$conn->close();
?>
