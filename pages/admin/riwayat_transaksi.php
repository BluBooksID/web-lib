<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table img {
            max-width: 50px;
            height: auto;
        }
    </style>
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

    <!-- Awal navbar -->
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <div class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/web-lib/resources/asset/logo.svg" alt="Logo" width="150" height="35">
                </div>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
                    <li><a href="dashboard.php" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 text-white">Kelola Buku</a></li>
                    <li><a href="admin_pinjaman.php" class="nav-link px-2 text-white">Kelola Pinjaman Buku</a></li>
                    <li><a href="riwayat_transaksi.php" class="nav-link px-2 text-secondary">Riwayat Transaksi</a></li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-light px-4 me-sm-3 fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Akhir navbar -->

    <div class="container mt-4">
        <h2 class="mb-4">Riwayat Transaksi</h2>
        <table class="table table-bordered table-hover">
            <thead>
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
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>

    <!-- Awal footer -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-body-secondary">© 2024 BluBooks</span>
            </div>
        </footer>
    </div>
    <!-- Akhir footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>