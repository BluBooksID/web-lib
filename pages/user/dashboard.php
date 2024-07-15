<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BluBooks</title>
<<<<<<< HEAD
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
    <link href="../../resources/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../resources/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../resources/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../resources/css/style.css" rel="stylesheet">
=======
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
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
        header("Location: " . BASE_URL . "/pages/login.php");
        exit();
    }
<<<<<<< HEAD

    // Memasukkan file koneksi database
    include '../../db/koneksi.php';


    // Ambil jumlah judul buku untuk setiap kategori
    $judul_per_kategori = [];

    $sql = "SELECT kategori.nama_kategori, COUNT(buku.id_buku) as total_judul 
            FROM kategori 
            LEFT JOIN buku ON kategori.id_kategori = buku.id_kategori 
            GROUP BY kategori.nama_kategori";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $judul_per_kategori[$row['nama_kategori']] = $row['total_judul'];
        }
    } else {
        // Default jumlah judul jika tidak ada data
        $judul_per_kategori = [
            'Komik' => 0,
            'Non Fiksi' => 0,
            'Novel' => 0,
            'Pendidikan' => 0,
            'Sains' => 0,
            'Teknologi' => 0
        ];
    }
    // Ambil parameter pencarian dari URL
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search_query)) {
        $search_query = mysqli_real_escape_string($conn, $search_query);
        $sql .= " WHERE buku.nama_buku LIKE '%$search_query%' OR buku.author_buku LIKE '%$search_query%'";
    }
=======
    // Memasukkan file koneksi database
    include '../../db/koneksi.php';
>>>>>>> ae26024624bab70b786c20fad2097e733335f6de
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
=======
    <!-- Awal navbar -->
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <div class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/web-lib/resources/asset/logo.svg" alt="Logo" width="150" height="35">
                </div>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
                    <li><a href="dashboard.php" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 text-white">List Buku</a></li>
                    <li><a href="list_pinjam_buku.php" class="nav-link px-2 text-white">Daftar Pinjaman Buku</a></li>
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


    <!-- Promo Start -->
    <div class="container-fluid pt-5">
        <div class="row">
            <!-- Carousel Kiri -->
            <div class="col-lg-6">
                <div id="left-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="../../public/assets/images/promo/promo1.jpeg" alt="Slide 1" style="width: 744px; height: 374px;">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="../../public/assets/images/promo/promo2.jpeg" alt="Slide 2" style="width: 744px; height: 374px;">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="../../public/assets/images/promo/promo3.jpeg" alt="Slide 3" style="width: 744px; height: 374px;">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#left-carousel" role="button" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#left-carousel" role="button" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Carousel Kanan -->
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div id="top-carousel" class="small-carousel ng-star-inserted" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="../../public/assets/images/promo/promo4.jpg" alt="Top Image 1" style="width: 388px; height: 180px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="bottom-carousel" class="small-carousel ng-star-inserted" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="../../public/assets/images/promo/promo5.png" alt="Bottom Image 1" style="width: 388px; height: 180px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Promo End -->



    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-4 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right"><?php echo isset($judul_per_kategori['Komik']) ? $judul_per_kategori['Komik'] : 0; ?> Produk</p>
                    <a href="http://localhost/web-lib/pages/user/data_buku.php?sort=terbaru&category=1" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="../../public/assets/images/kategori/komik.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Komik</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right"><?php echo isset($judul_per_kategori['Novel']) ? $judul_per_kategori['Novel'] : 0; ?> Produk</p>
                    <a href="http://localhost/web-lib/pages/user/data_buku.php?sort=terbaru&category=2" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="../../public/assets/images/kategori/novel.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Novel</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right"><?php echo isset($judul_per_kategori['Sains']) ? $judul_per_kategori['Sains'] : 0; ?> Produk</p>
                    <a href="http://localhost/web-lib/pages/user/data_buku.php?sort=terbaru&category=4" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="../../public/assets/images/kategori/sains.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Sains</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right"><?php echo isset($judul_per_kategori['Teknologi']) ? $judul_per_kategori['Teknologi'] : 0; ?> Produk</p>
                    <a href="http://localhost/web-lib/pages/user/data_buku.php?sort=terbaru&category=5" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="../../public/assets/images/kategori/teknologi.png" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Teknologi</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories End -->



    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Komik Terbaru</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php
            // Query untuk mengambil data dari database dengan batasan 4 baris pertama
            $sql = "SELECT id_buku, cover, nama_buku, stok FROM buku WHERE id_kategori = '1' LIMIT 4";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Loop melalui setiap baris hasil query
                while ($row = $result->fetch_assoc()) {
                    $cover = $row["cover"];
                    $nama_buku = $row["nama_buku"];
                    $stok = $row["stok"];
            ?>
                    <div class="col-lg-3 col-md-4 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="../../<?php echo $cover; ?>" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3"> <?php echo $nama_buku; ?></h6>
                            </div>
                            <div class="card-footer d-flex justify-content-center bg-light border" style="justify-content: center;">
                                <a href="detail_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Lihat Detail</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "Data tidak ditemukan";
            }
            ?>
        </div>

        <div class="text-center mt-4">
            <a href="http://localhost/web-lib/pages/user/data_buku.php?sort=terbaru&category=1" class="btn btn-primary">Lihat Semua</a>
        </div>

        <!-- Products End -->


        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">Novel Terbaru</span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                <?php
                // Query untuk mengambil data dari database dengan batasan 5 baris pertama
                $sql = "SELECT id_buku, cover, nama_buku, stok FROM buku WHERE id_kategori = '2' LIMIT 4";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Loop melalui setiap baris hasil query
                    while ($row = $result->fetch_assoc()) {
                        $cover = $row["cover"];
                        $nama_buku = $row["nama_buku"];
                        $stok = $row["stok"];
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="../../<?php echo $cover; ?>" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"> <?php echo $nama_buku; ?></h6>
                                </div>
                                <div class="card-footer d-flex justify-content-center bg-light border" style="justify-content: center;">
                                    <a href="detail_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Lihat Detail</a>
                                </div>

                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "Data tidak ditemukan";
                }
                ?>
            </div>
            <div class="text-center mt-4">
                <a href="http://localhost/web-lib/pages/user/data_buku.php?sort=terbaru&category=2" class="btn btn-primary">Lihat Semua</a>
            </div>
        </div>
        <!-- Products End -->

        <!-- Products Start -->
        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">Sains Terbaru</span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                <?php
                // Query untuk mengambil data dari database dengan batasan 5 baris pertama
                $sql = "SELECT id_buku, cover, nama_buku, stok FROM buku WHERE id_kategori = '4' LIMIT 4";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Loop melalui setiap baris hasil query
                    while ($row = $result->fetch_assoc()) {
                        $cover = $row["cover"];
                        $nama_buku = $row["nama_buku"];
                        $stok = $row["stok"];
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="../../<?php echo $cover; ?>" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"> <?php echo $nama_buku; ?></h6>
                                </div>
                                <div class="card-footer d-flex justify-content-center bg-light border" style="justify-content: center;">
                                    <a href="detail_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Lihat Detail</a>
                                </div>

                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "Data tidak ditemukan";
                }
                ?>
            </div>
            <div class="text-center mt-4">
                <a href="http://localhost/web-lib/pages/user/data_buku.php?sort=terbaru&category=4" class="btn btn-primary">Lihat Semua</a>
            </div>
        </div>
        <!-- Products End -->


        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">Teknologi Terbaru</span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                <?php
                // Query untuk mengambil data dari database dengan batasan 5 baris pertama
                $sql = "SELECT id_buku, cover, nama_buku, stok FROM buku WHERE id_kategori = '5' LIMIT 4";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // Loop melalui setiap baris hasil query
                    while ($row = $result->fetch_assoc()) {
                        $cover = $row["cover"];
                        $nama_buku = $row["nama_buku"];
                        $stok = $row["stok"];
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="../../<?php echo $cover; ?>" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?php echo $nama_buku; ?></h6>
                                </div>
                                <div class="card-footer d-flex justify-content-center bg-light border" style="justify-content: center;">
                                    <a href="detail_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Lihat Detail</a>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                } else {
                    echo "Data tidak ditemukan";
                }
                $conn->close();
                ?>
            </div>
            <div class="text-center mt-4">
                <a href="http://localhost/web-lib/pages/user/data_buku.php?sort=terbaru&category=5" class="btn btn-primary">Lihat Semua</a>
            </div>
        </div>
        <!-- Products End -->


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
        <script src="../../resources/vendor/aos/aos.js"></script>
=======
    <!-- Akhir navbar -->

    <!-- Awal konten -->
    <div class="container col-xxl-8 px-4 py-1">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-3">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="/web-lib/resources/asset/library.svg"
                    class="d-none d-sm-block d-md-block mx-lg-auto img-fluid" alt="Images" width="400" height="300">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Halo,
                    <?php echo htmlspecialchars($_SESSION['nama_pengguna'], ENT_QUOTES); ?>
                </h1>
                <p class="lead">Selamat datang di BluBooks, perpustakaan yang menawarkan beragam koleksi buku untuk
                    memenuhi berbagai minat baca Anda. Kami memiliki banyak koleksi buku yang dapat Anda jelajahi
                    dan
                    nikmati.</p>
            </div>
        </div>
    </div>
    <!-- Akhir konten -->

    <!-- Bisnis Favorit -->
    <div class="pb-3">
        <div class="container py-3">
            <div class="p-5 text-center bg-body-tertiary rounded-4">
                <div class="row pb-4">
                    <h4 class="col-md-2 mb-0">Bisnis Favorit</h4>
                    <h6 class="col-md-10 text-end"><a href="data_buku.php?category=1"
                            class="px-2 text-body-secondary">Lihat Selengkapnya</a>
                    </h6>
                </div>
                <div class="row row-cols-1 row-cols-md-5 g-4">
                    <?php
                    // Query untuk mengambil data dari database dengan batasan 5 baris pertama
                    $sql = "SELECT id_buku, cover, author_buku, nama_buku, stok FROM buku WHERE id_kategori = '1' LIMIT 5";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Loop melalui setiap baris hasil query
                        while ($row = $result->fetch_assoc()) {
                            $cover = $row["cover"];
                            $author_buku = $row["author_buku"];
                            $nama_buku = $row["nama_buku"];
                            $stok = $row["stok"];
                            ?>
                            <div class="col">
                                <a href="detail_buku.php?id=<?php echo $row['id_buku']; ?>" class="text-decoration-none">
                                    <div class="card h-100 border-0 shadow-sm rounded-3">
                                        <img src="../../<?php echo $cover; ?>" class="card-img-top rounded-top-3"
                                            alt="Cover Buku">
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-title"
                                                style="max-height: 3em; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                <?php echo $nama_buku; ?>
                                            </p>
                                            <p class="card-text fw-lighter mt-auto"><?php echo $author_buku; ?></p>
                                            <p class="fs-6 fw-bold">Stok : <?php echo $stok; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    } else {
                        echo "Data tidak ditemukan";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Novel Favorit -->
    <div class="pb-3">
        <div class="container py-3">
            <div class="p-5 text-center bg-body-tertiary rounded-4">
                <div class="row pb-4">
                    <h4 class="col-md-2 mb-0">Novel Favorit</h4>
                    <h6 class="col-md-10 text-end"><a href="data_buku.php?category=2"
                            class="px-2 text-body-secondary">Lihat Selengkapnya</a>
                    </h6>
                </div>
                <div class="row row-cols-1 row-cols-md-5 g-4">
                    <?php
                    // Query untuk mengambil data dari database dengan batasan 5 baris pertama
                    $sql = "SELECT id_buku, cover, author_buku, nama_buku, stok FROM buku WHERE id_kategori = '2' LIMIT 5";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Loop melalui setiap baris hasil query
                        while ($row = $result->fetch_assoc()) {
                            $cover = $row["cover"];
                            $author_buku = $row["author_buku"];
                            $nama_buku = $row["nama_buku"];
                            $stok = $row["stok"];
                            ?>
                            <div class="col">
                                <a href="detail_buku.php?id=<?php echo $row['id_buku']; ?>" class="text-decoration-none">
                                    <div class="card h-100 border-0 shadow-sm rounded-3">
                                        <img src="../../<?php echo $cover; ?>" class="card-img-top rounded-top-3"
                                            alt="Cover Buku">
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-title"
                                                style="max-height: 3em; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                <?php echo $nama_buku; ?>
                                            </p>
                                            <p class="card-text fw-lighter mt-auto"><?php echo $author_buku; ?></p>
                                            <p class="fs-6 fw-bold">Stok : <?php echo $stok; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    } else {
                        echo "Data tidak ditemukan";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Komik Favorit -->
    <div class="pb-5">
        <div class="container py-3">
            <div class="p-5 text-center bg-body-tertiary rounded-4">
                <div class="row pb-4">
                    <h4 class="col-md-2 mb-0">Komik Favorit</h4>
                    <h6 class="col-md-10 text-end"><a href="data_buku.php?category=4"
                            class="px-2 text-body-secondary">Lihat Selengkapnya</a>
                    </h6>
                </div>
                <div class="row row-cols-1 row-cols-md-5 g-4">
                    <?php
                    // Query untuk mengambil data dari database dengan batasan 5 baris pertama
                    $sql = "SELECT id_buku, cover, author_buku, nama_buku, stok FROM buku WHERE id_kategori = '4' LIMIT 5";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Loop melalui setiap baris hasil query
                        while ($row = $result->fetch_assoc()) {
                            $cover = $row["cover"];
                            $author_buku = $row["author_buku"];
                            $nama_buku = $row["nama_buku"];
                            $stok = $row["stok"];
                            ?>
                            <div class="col">
                                <a href="detail_buku.php?id=<?php echo $row['id_buku']; ?>" class="text-decoration-none">
                                    <div class="card h-100 border-0 shadow-sm rounded-3">
                                        <img src="../../<?php echo $cover; ?>" class="card-img-top rounded-top-3"
                                            alt="Cover Buku">
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-title"
                                                style="max-height: 3em; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                <?php echo $nama_buku; ?>
                                            </p>
                                            <p class="card-text fw-lighter mt-auto"><?php echo $author_buku; ?></p>
                                            <p class="fs-6 fw-bold">Stok : <?php echo $stok; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    } else {
                        echo "Data tidak ditemukan";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir konten -->

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