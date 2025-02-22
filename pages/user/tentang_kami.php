<!DOCTYPE html>
<html>

<head>
    <title>Buku yang Dipinjam</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Awal css -->
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

    <!-- Awal navbar -->
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <div class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/web-lib/resources/asset/logo.svg" alt="Logo" width="150" height="35">
                </div>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
                    <li><a href="dashboard.php" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 text-white">List Buku</a></li>
                    <li><a href="list_pinjam_buku.php" class="nav-link px-2 text-white">Daftar Pinjaman Buku</a>
                    </li>
                    <li><a href="tentang_kami.php" class="nav-link px-2 text-secondary">Tentang Kami</a></li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-light px-4 me-sm-3 fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Akhir navbar -->

    <!-- Awal Tentang -->
    <div class="px-4 pt-3 my-5 text-center">
        <h1 class="display-4 fw-bold pb-3">Tentang Kami</h1>
        <div class="col-lg-8 mx-auto text-justify">
            <p class="lead mb-4">BluBooks adalah perpustakaan yang menghadirkan beragam koleksi buku untuk memenuhi
                berbagai minat baca. Dari fiksi hingga nonfiksi, dari literatur klasik hingga karya terbaru, setiap buku
                tersedia untuk memperkaya wawasan dan memperluas imajinasi. Dengan suasana yang nyaman dan sistem
                peminjaman yang mudah, setiap pengunjung dapat menikmati pengalaman membaca yang menyenangkan.
                Berkomitmen untuk mendukung budaya literasi, BluBooks juga menyediakan berbagai kegiatan seperti diskusi
                buku, pelatihan menulis, serta klub baca yang dapat diikuti oleh siapa saja yang ingin berbagi dan
                bertukar ide.</p>
        </div>
    </div>
    <!-- Akhir Tentang -->

    <!-- Awal konten -->
    <div class="px-4 pt-3 my-5 pb-3 text-center">
        <h1 class="display-4 fw-bold pb-3">Tim Kami</h1>
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <img src="/web-lib/resources/asset/images.jpg" class="card-img-top" alt="Foto Tim 1">
                        <div class="card-body">
                            <h5 class="card-title">Aliffian Cahya</h5>
                            <p class="card-text">Backend</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="/web-lib/resources/asset/images.jpg" class="card-img-top" alt="Foto Tim 2">
                        <div class="card-body">
                            <h5 class="card-title">Aria Zufar Shada</h5>
                            <p class="card-text">Frontend</p>
                        </div>
                    </div>
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
</body>

</html>