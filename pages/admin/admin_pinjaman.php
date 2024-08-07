<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pinjaman Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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

    <style>
        .table img {
            max-width: 50px;
            height: auto;
        }
    </style>
</head>

<body>
    <!-- PHP backend code -->
    <?php
    session_start();
    if (!isset($_SESSION['id_admin'])) {
        echo "<div class='alert alert-danger'>Akses Ditolak!</div>";
        exit;
    }
    include '../../controllers/TransaksiController.php';
    include '../../db/koneksi.php';
    $result = $conn->query($verifikasi);
    ?>
    <!-- End of PHP backend code -->

    <!-- Awal Navbar -->
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="dashboard.php" class="logo d-flex align-items-center me-auto">
                <img src="../../public/assets/images/logo.png" alt="BluBooks" width="218" height="68">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="dashboard.php" class="nav-link px-2 ">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 ">Kelola Buku</a></li>
                    <li><a href="admin_pinjaman.php" class="nav-link px-2 active">Kelola Pinjaman Buku</a></li>
                    <li><a href="riwayat_transaksi.php" class="nav-link px-2 ">Riwayat Transaksi</a></li>
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
                </div>
            </div>
        </div>
    </header>
    <!-- Navbar End -->

    <div class="container mt-4">
        <h2 class="mb-4">Manajemen Pinjaman Buku</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nama Pengguna</th>
                        <th>Cover</th>
                        <th>Nama Buku</th>
                        <th>Author Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status Buku</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["nama_pengguna"] . "</td>";
                            echo "<td><img src='../../" . $row["cover"] . "' alt='Cover Buku'></td>";
                            echo "<td>" . $row["nama_buku"] . "</td>";
                            echo "<td>" . $row["author_buku"] . "</td>";
                            echo "<td>" . $row["tanggal_pinjam"] . "</td>";
                            echo "<td>" . ($row["tanggal_pengembalian"] ? $row["tanggal_pengembalian"] : "Belum dikembalikan") . "</td>";
                            echo "<td>" . ucfirst($row["status_buku"]) . "</td>";
                            echo "<td>";
                            if ($row["status_buku"] == 'on_review') {
                                echo "<a href='admin_pinjaman.php?verify=dikembalikan&id_transaksi=" . $row["id_transaksi"] . "' class='btn btn-primary'>Verifikasi</a>";
                            } elseif ($row["status_buku"] == 'dikembalikan') {
                                echo "<span class='badge bg-success'>Sudah diverifikasi</span>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Belum ada buku yang perlu diverifikasi.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
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
</body>

</html>