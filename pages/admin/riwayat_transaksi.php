<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Favicons -->
    <link href="../../public/assets/images/favicon.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../resources/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../resources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../resources/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../resources/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../resources/css/style.css" rel="stylesheet">
=======
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
    <style>
        .table img {
            max-width: 50px;
            height: auto;
        }
    </style>
<<<<<<< HEAD

=======
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
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

<<<<<<< HEAD
    <!-- Awal Navbar -->
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="dashboard.php" class="logo d-flex align-items-center me-auto">
                <img src="../../public/assets/images/logo.png" alt="BluBooks" width="218" height="68">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="dashboard.php" class="nav-link px-2 ">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2  ">Kelola Buku</a></li>
                    <li><a href="admin_pinjaman.php" class="nav-link px-2 ">Kelola Pinjaman Buku</a></li>
                    <li><a href="riwayat_transaksi.php" class="nav-link px-2 active">Riwayat Transaksi</a></li>
            </nav>

            <div class="col-lg-3 col-6 text-right">
                <div class="dropdown">
                    <a href="#" class="btn border" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user text-primary"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown" style="width: 297px;">
                        <a class="dropdown-item">Halo, <?php echo htmlspecialchars($_SESSION['nama'], ENT_QUOTES); ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
=======
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
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
                </div>
            </div>
        </div>
    </header>
<<<<<<< HEAD
    <!-- Navbar End -->
=======
    <!-- Akhir navbar -->
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de

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
<<<<<<< HEAD
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../resources/lib/easing/easing.min.js"></script>
    <script src="../../resources/lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="../../resources/js/main.js"></script>

    <script src="../../resources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../resources/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../resources/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
=======

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
</body>

</html>