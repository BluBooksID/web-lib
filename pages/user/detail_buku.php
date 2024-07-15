<!DOCTYPE html>
<html>

<head>
    <title>Detail Buku</title>
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

    // Memasukkan file koneksi database
    include '../../db/koneksi.php';

    // Memeriksa apakah ID buku diteruskan melalui URL
    if (!isset($_GET['id'])) {
        echo "ID buku tidak tersedia.";
        exit();
    }

    // Ambil ID buku dari URL dan pastikan itu adalah integer
    $id = intval($_GET['id']);

    // Query untuk mengambil data buku berdasarkan ID
    $sql = "SELECT buku.*, kategori.nama_kategori FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE buku.id_buku = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil data buku
        $row = $result->fetch_assoc();
        $cover = $row["cover"];
        $nama_buku = $row["nama_buku"];
        $author_buku = $row["author_buku"];
        $tanggal_terbit = $row["tanggal_terbit"];
        $bahasa = $row["bahasa"];
        $deskripsi = $row["deskripsi"];
        $kategori = $row["nama_kategori"];
        $stok = $row["stok"];
    } else {
        echo "Buku tidak ditemukan.";
        exit();
    }

    $stmt->close();
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
                    <li><a href="dashboard.php" class="nav-item nav-link ">Home<br></a></li>
                    <li><a href="data_buku.php" class="nav-item nav-link active">List Buku</a></li>
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

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Detail Buku</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a class="link-body-emphasis" href="dashboard.php">
                        <i class="bi bi-house-door-fill"></i>
                        <span class="visually-hidden">Home</span>
                    </a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a class="link-body-emphasis fw-semibold text-decoration-none" href="data_buku.php">List Buku</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0" class="breadcrumb-item active" aria-current="page">Detail Buku</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Awal konten -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div class="p-2 bg-light rounded-3"> <!-- Tambahkan kelas padding dan background -->
                    <img src="../../<?php echo $cover; ?>" class="d-block mx-lg-auto img-fluid" alt="Cover Image" loading="lazy" style="width: 340px; height: 516px;">
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="display-7 fw-bold text-body-emphasis lh-1 mb-3"><?php echo $nama_buku; ?></h3>
                <p class="lead"><?php echo $author_buku; ?></p>
                <p class="text-justify"><?php echo $deskripsi; ?></p>
                <div class="row mt-3">
                    <div class="col-4">
                        <h6>Tanggal Terbit</h6>
                        <p><?php echo $tanggal_terbit; ?></p>
                    </div>
                    <div class="col-4">
                        <h6>Bahasa</h6>
                        <p><?php echo $bahasa; ?></p>
                    </div>
                    <div class="col-4">
                        <h6>Kategori</h6>
                        <p><?php echo $kategori; ?></p>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <?php
                    echo "<td>
                        <a href='data_buku.php?borrow=" . $row["id_buku"] . "' onclick=\"return confirm('Anda yakin ingin meminjam buku ini?')\"class='btn btn-primary px-4 fw-bold'>Pinjam Buku</a>
                        </td>";
                    ?>
                    <p class="lead pt-3">Stock tersisa : <?php echo $stok; ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir konten -->

    <!-- Rekomendasi -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Rekomendasi Untukmu</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php
            // Query untuk mengambil data dari database dengan id_kategori secara acak dan membatasi 4 baris pertama
            $sql = "SELECT id_buku, cover, nama_buku, stok FROM buku WHERE id_kategori = (SELECT id_kategori FROM buku ORDER BY RAND() LIMIT 1) LIMIT 4";
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
                echo "<p class='text-center'>Data tidak ditemukan</p>";
            }
            ?>
        </div>
    </div>



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