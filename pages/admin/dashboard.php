<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - BluBooks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    session_start();
    // Memeriksa apakah sesi id_admin dan nama_admin sudah ada
    if (!isset($_SESSION['id_admin']) || !isset($_SESSION['nama_admin'])) {
        // Jika belum, arahkan ke halaman login
        include '../../config.php';
        header("Location: " . BASE_URL . "/pages/auth.php");
        exit();
    }
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
                    <li><a href="dashboard.php" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 text-white">Kelola Buku</a></li>
                    <li><a href="admin_pinjaman.php" class="nav-link px-2 text-white">Kelola Pinjaman Buku</a></li>
                    <li><a href="riwayat_transaksi.php" class="nav-link px-2 text-white">Riwayat Transaksi</a></li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-light px-4 me-sm-3 fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </header>
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
                    <?php echo htmlspecialchars($_SESSION['nama_admin'], ENT_QUOTES); ?>
                </h1>
                <p class="lead">Selamat datang di halaman admin BluBooks, di mana Anda dapat mengelola dan mengawasi
                    semua aktivitas perpustakaan. Temukan dan atur koleksi buku, kelola transaksi, dan lakukan tugas
                    administratif lainnya dengan mudah dan efisien.</p>
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