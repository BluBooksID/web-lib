<!DOCTYPE html>
<html>

<head>
    <title>List Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <!-- Awal navbar -->
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <div class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/web-lib/resources/asset/logo.svg" alt="Logo" width="150" height="35">
                </div>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
                    <li><a href="dashboard.php" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 text-secondary">List Buku</a></li>
                    <li><a href="list_pinjam_buku.php" class="nav-link px-2 text-white">Daftar Pinjaman Buku</a></li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-primary px-4 me-sm-3 fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Akhir navbar -->

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>