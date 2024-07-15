<!DOCTYPE html>
<html>

<head>
    <title>Buku yang Dipinjam</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Awal css -->
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
        .text-justify {
            text-align: justify;
        }
    </style>
    <!-- Akhir css -->

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

    // Inisialisasi counter
    $counter = 1;
    ?>
    <!-- Akhir php-backend -->

    <!-- Awal Navbar -->
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="dashboard.php" class="logo d-flex align-items-center me-auto">
                <img src="../../public/assets/images/logo.png" alt="BluBooks" width="218" height="68">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="dashboard.php" class="nav-item nav-link active">Home<br></a></li>
                    <li><a href="data_buku.php" class="nav-item nav-link ">List Buku</a></li>
                    <li>
                        <form class="form-inline" action="data_buku.php" method="GET" style="display: flex;">
                            <input class="form-control mr-sm-2" type="search" placeholder="Cari Buku" aria-label="Search">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <div class="col-lg-3 col-6 text-right">
                <div class="dropdown">
                    <a href="#" class="btn border" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user text-primary"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown" style="width: 297px;">
                        <a class="dropdown-item">Halo, <?php echo htmlspecialchars($_SESSION['nama_pengguna'], ENT_QUOTES); ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="list_pinjam_buku.php">Riwayat Peminjaman</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Navbar End -->

    <div class="container mt-5">
        <h2 class="mb-4">Daftar Pinjaman Buku</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="bg-light text-center">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Buku</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Menampilkan data buku yang dipinjam jika ada hasil query
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $counter . "</td>"; // Menampilkan nomor urut, di tengah
                            echo "<td>" . $row["nama_buku"] . "</td>";
                            echo "<td class='text-center'>" . $row["tanggal_pinjam"] . "</td>"; // Tanggal pinjam, di tengah
                            echo "<td class='text-center'>" . ($row["tanggal_pengembalian"] ? $row["tanggal_pengembalian"] : "Belum dikembalikan") . "</td>"; // Tanggal pengembalian, di tengah
                            echo "<td class='text-center'>" . ucfirst($row["status_buku"]) . "</td>"; // Status, di tengah
                            echo "<td class='text-center'>";
                            // Tombol untuk mengembalikan buku, di tengah
                            if ($row["status_buku"] == 'dipinjam') {
                                echo "<a href='list_pinjam_buku.php?return=" . $row["id_transaksi"] . "' onclick=\"return confirm('Konfirmasi?')\" class='btn btn-primary btn-sm'>Kembalikan Buku</a>";
                            }
                            echo "</td>";
                            echo "</tr>";
                            $counter++; // Menambah counter setiap kali loop
                        }
                    } else {
                        // Menampilkan pesan jika tidak ada buku yang dipinjam
                        echo "<tr><td colspan='6' class='text-center'>Belum ada buku yang dipinjam.</td></tr>";
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

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="../../resources/js/main.js"></script>

    <script src="../../resources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../resources/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../resources/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>