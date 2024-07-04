<!DOCTYPE html>
<html>

<head>
    <title>Detail Buku</title>
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
        // Memasukkan file konfigurasi untuk mengambil BASE_URL
        include '../../config.php';
        // Mengarahkan pengguna kembali ke halaman login jika belum masuk
        header("Location: " . BASE_URL . "/pages/auth.php");
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

    <!-- Awal navbar -->
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <div class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/web-lib/resources/asset/logo.svg" alt="Logo" width="150" height="35">
                </div>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
                    <li><a href="dashboard.php" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 text-white">List Buku</a></li>
                    <li><a href="list_pinjam_buku.php" class="nav-link px-2 text-white">Daftar Pinjaman Buku</a></li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-primary px-4 me-sm-3 fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Akhir navbar -->

    <div class="container my-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3 bg-body-tertiary rounded-3">
                <li class="breadcrumb-item">
                    <a class="link-body-emphasis" href="dashboard.php">
                        <i class="bi bi-house-door-fill"></i>
                        <span class="visually-hidden">Home</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="link-body-emphasis fw-semibold text-decoration-none" href="data_buku.php">List Buku</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Detail Buku
                </li>
            </ol>
        </nav>
    </div>

    <!-- Awal konten -->
    <div class="container col-xxl-8 px-4">
        <div class="row flex-lg-row g-5 pt-3 pb-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <div class="p-5 bg-light rounded-3"> <!-- Tambahkan kelas padding dan background -->
                    <img src="../../<?php echo $cover; ?>" class="d-block mx-lg-auto img-fluid" alt="Cover Image"
                        loading="lazy" style="max-width: 100%; height: auto;">
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="display-7 fw-bold text-body-emphasis lh-1 mb-3"><?php echo $nama_buku; ?></h1>
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
                    <p class="lead">Stock tersisa : <?php echo $stok; ?></p>
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
