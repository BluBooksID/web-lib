<!DOCTYPE html>
<html lang="en">

<head>
<<<<<<< HEAD
    <meta charset="utf-8">
    <title>Detail Buku - BluBooks</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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
    <title>List Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card:hover {
            cursor: pointer;
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        }
    </style>
</head>
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de

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

    // Tentukan jumlah buku per halaman
    $limit = 20;

    // Ambil nomor halaman dari parameter URL, default ke 1 jika tidak ada
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Ambil parameter sorting dan filter kategori dari URL
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'terbaru';
    $category_filter = isset($_GET['category']) ? $_GET['category'] : '';

    // Ambil parameter pencarian dari URL
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';

    // Query dasar untuk mengambil data buku
    $sql = "SELECT buku.*, kategori.nama_kategori FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori";

    // Tambahkan filter kategori jika ada
    if ($category_filter) {
        $sql .= " WHERE buku.id_kategori = '$category_filter'";
    }

    // Tambahkan kondisi pencarian jika ada
    if (!empty($search_query)) {
        $search_query = mysqli_real_escape_string($conn, $search_query);
        $sql .= " WHERE buku.nama_buku LIKE '%$search_query%' OR buku.author_buku LIKE '%$search_query%'";
    }

    // Tambahkan sorting berdasarkan parameter
    if ($sort == 'terbaru') {
        $sql .= " ORDER BY buku.tanggal_terbit DESC";
    } else {
        $sql .= " ORDER BY buku.tanggal_terbit ASC";
    }

    // Tambahkan pagination
    $sql .= " LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);

    // Query untuk menghitung total buku
    $sql_count = "SELECT COUNT(*) AS total FROM buku";
    if ($category_filter) {
        $sql_count .= " WHERE buku.id_kategori = '$category_filter'";
    }
    if (!empty($search_query)) {
        $sql_count .= " WHERE buku.nama_buku LIKE '%$search_query%' OR buku.author_buku LIKE '%$search_query%'";
    }
    $result_count = $conn->query($sql_count);
    $total_books = $result_count->fetch_assoc()['total'];
    $total_pages = ceil($total_books / $limit);

    // Query untuk mengambil semua kategori
    $sql_categories = "SELECT * FROM kategori";
    $result_categories = $conn->query($sql_categories);
    ?>
    <!-- Akhir php-backend -->
</head>

<body>
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

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- All kategori Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter Kategori</h5>
                    <ul class="list-group">
                        <li class="list-group-item <?php echo !$category_filter ? 'active' : ''; ?>"><a href="data_buku.php?sort=<?php echo $sort; ?>" class="text-decoration-none text-dark">Semua
                                Kategori</a></li>
                        <?php while ($category = $result_categories->fetch_assoc()) { ?>
                            <li class="list-group-item <?php echo $category_filter == $category['id_kategori'] ? 'active' : ''; ?>">
                                <a href="data_buku.php?sort=<?php echo $sort; ?>&category=<?php echo $category['id_kategori']; ?>" class="text-decoration-none text-dark"><?php echo $category['nama_kategori']; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

    <!-- Awal navbar -->
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <div class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/web-lib/resources/asset/logo.svg" alt="Logo" width="150" height="35">
                </div>

<<<<<<< HEAD
=======
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
                    <li><a href="dashboard.php" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 text-secondary">List Buku</a></li>
                    <li><a href="list_pinjam_buku.php" class="nav-link px-2 text-white">Daftar Pinjaman Buku</a></li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-light px-4 me-sm-3 fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Akhir navbar -->

    <div class="container my-5">
        <form class="d-flex p-3 bg-body-tertiary rounded-3" action="data_buku.php" method="GET">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search"
                value="<?php echo htmlspecialchars($search_query); ?>">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-3">
                <div class="p-3 bg-light rounded">
                    <h5 class="pb-3">Filter Kategori</h5>
                    <ul class="list-group">
                        <li class="list-group-item <?php echo !$category_filter ? 'active' : ''; ?>"><a
                                href="data_buku.php?sort=<?php echo $sort; ?>"
                                class="text-decoration-none text-dark">Semua
                                Kategori</a></li>
                        <?php while ($category = $result_categories->fetch_assoc()) { ?>
                            <li
                                class="list-group-item <?php echo $category_filter == $category['id_kategori'] ? 'active' : ''; ?>">
                                <a href="data_buku.php?sort=<?php echo $sort; ?>&category=<?php echo $category['id_kategori']; ?>"
                                    class="text-decoration-none text-dark"><?php echo $category['nama_kategori']; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="me-3">Menampilkan <span class="fs-6 fw-bold"><?php echo $offset + 1; ?></span> -
                            <span class="fs-6 fw-bold"><?php echo min($offset + $limit, $total_books); ?></span>
                            dari <span class="fs-6 fw-bold"><?php echo $total_books; ?></span> hasil pencarian
                            buku</span>
                    </div>
                    <div class="nav-item dropdown">
<<<<<<< HEAD
                        <button class="nav-link dropdown-toggle" role="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
=======
                        <button class="nav-link dropdown-toggle" role="button" id="sortDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
                            Urutkan
                        </button>
                        <ul class="dropdown-menu">
                            <li>
<<<<<<< HEAD
                                <a class="dropdown-item <?php echo $sort == 'terbaru' ? 'active' : ''; ?>" href="?sort=terbaru&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>">Terbaru</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo $sort == 'terlama' ? 'active' : ''; ?>" href="?sort=terlama&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>">Terlama</a>
=======
                                <a class="dropdown-item <?php echo $sort == 'terbaru' ? 'active' : ''; ?>"
                                    href="?sort=terbaru&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>">Terbaru</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo $sort == 'terlama' ? 'active' : ''; ?>"
                                    href="?sort=terlama&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>">Terlama</a>
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
<<<<<<< HEAD
                    ?>
                            <div class="col">
                                <a href="detail_buku.php?id=<?php echo $row['id_buku']; ?>" class="text-decoration-none">
                                    <div class="card h-100 border-0 shadow-sm rounded-3">
                                        <img src="../../<?php echo $row['cover']; ?>" class="card-img-top rounded-top-3" alt="Cover Buku">
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-text fw-lighter mt-auto"><?php echo $row['author_buku']; ?></p>
                                            <p class="card-title" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                <?php echo $row['nama_buku']; ?>
                                            </p>
                                            <p class="fs-6">Stok : <?php echo $row['stok']; ?></p>
=======
                            ?>
                            <div class="col">
                                <a href="detail_buku.php?id=<?php echo $row['id_buku']; ?>" class="text-decoration-none">
                                    <div class="card h-100 border-0 shadow-sm rounded-3">
                                        <img src="../../<?php echo $row['cover']; ?>" class="card-img-top rounded-top-3"
                                            alt="Cover Buku">
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-title"
                                                style="max-height: 3em; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                <?php echo $row['nama_buku']; ?>
                                            </p>
                                            <p class="card-text fw-lighter mt-auto"><?php echo $row['author_buku']; ?></p>
                                            <p class="fs-6 fw-bold">Stok : <?php echo $row['stok']; ?></p>
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
                                        </div>
                                    </div>
                                </a>
                            </div>
<<<<<<< HEAD
                    <?php
=======
                            <?php
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
                        }
                    } else {
                        echo "<p class='text-center'>Tidak ada buku yang ditemukan.</p>";
                    }
                    ?>
                </div>
<<<<<<< HEAD
                <!-- Filter End -->


=======
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de

                <!-- Pagination -->
                <nav aria-label="Page navigation example" class="mt-4">
                    <ul class="pagination justify-content-center">
<<<<<<< HEAD
                        <?php if ($page > 1) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>">Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?php if ($i == $page)
                                                        echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>">Next</a>
=======
                        <?php if ($page > 1): ?>
                            <li class="page-item"><a class="page-link"
                                    href="?page=<?php echo $page - 1; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>">Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php if ($i == $page)
                                echo 'active'; ?>"><a class="page-link"
                                    href="?page=<?php echo $i; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <li class="page-item"><a class="page-link"
                                    href="?page=<?php echo $page + 1; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>">Next</a>
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

<<<<<<< HEAD

    <!-- Footer -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">

                        <h3>BluBooks</h3>
                        <p>
                            <a href="https://www.google.com/maps/place/ARS+University/@-6.9104962,107.6499176,17z/data=!3m1!4b1!4m6!3m5!1s0x2e68e7eb9456ae97:0x9fd67cfa593e7dc9!8m2!3d-6.9104962!4d107.6499176!16s%2Fg%2F1ptxxdtq9?entry=ttu" target="_blank">
                                Jalan Sekolah Internasional No.1-2 Antapani, <br>
                                Bandung - Jawa Barat,40282<br>
                                Indonesia
                            </a>
                            <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> blubooks@ars.id<br>
                        </p>

                    </div>

                    <div class="col-lg-6 col-md-6 footer-links">
                        <h4>Navigasi</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Syarat dan Ketentuan</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Kebijakan Privasi</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Tentang Kami</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Komunitas</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Sosial Media Kami</h4>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>BluBooks</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Kelompok 9 - Ti.4A</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


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
=======
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
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
</body>

</html>