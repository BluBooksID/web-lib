<!DOCTYPE html>
<html>

<head>
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="../../resources/css/style.css" rel="stylesheet">
    <!-- Favicons -->
    <link href="../../public/assets/images/favicon.png" rel="icon">
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    // Memulai sesi untuk pengelolaan sesi
    session_start();

    // Memeriksa apakah pengguna sudah masuk sebagai admin dan memiliki nama admin
    if (!isset($_SESSION['id_admin']) || !isset($_SESSION['nama_admin'])) {
        // Memasukkan file konfigurasi untuk mengambil BASE_URL
        include '../../config.php';
        // Mengarahkan pengguna kembali ke halaman login jika belum masuk
        header("Location: " . BASE_URL . "/pages/auth.php");
        exit();
    }

    // Memasukkan file koneksi database
    include '../../db/koneksi.php';

    // Mengambil id_buku dari parameter GET
    $id_buku = $_GET['id_buku'];

    // Query untuk mengambil data buku berdasarkan id_buku
    $sql = "SELECT * FROM buku WHERE id_buku=$id_buku";
    $result = $conn->query($sql);

    // Memeriksa apakah ada hasil query untuk id_buku tertentu
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        // Menampilkan pesan jika tidak ada record yang ditemukan
        echo "No record found";
        exit;
    }

    // Query untuk mengambil semua kategori
    $kategori_result = $conn->query("SELECT id_kategori, nama_kategori FROM kategori");

    // Menutup koneksi database
    $conn->close();
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
                    <li><a href="dashboard.php" class="nav-link px-2  ">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 active ">Kelola Buku</a></li>
                    <li><a href="admin_pinjaman.php" class="nav-link px-2 ">Kelola Pinjaman Buku</a></li>
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
                    <a class="link-body-emphasis fw-semibold text-decoration-none" href="data_buku.php">Kelola Buku</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit Buku
                </li>
            </ol>
        </nav>
    </div>

    <!-- Awal form edit -->
    <div class="container mt-4 pb-5">
        <div class="container bg-body-tertiary border rounded-3 px-4 pb-5 p-4 p-md-5">
            <form method="post" action="data_buku.php" enctype="multipart/form-data">
                <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
                <input type="hidden" name="current_cover" value="<?php echo $row['cover']; ?>">

                <div class="mb-3">
                    <label for="cover" class="form-label">Cover</label>
                    <input type="file" class="form-control" id="cover" name="cover">
                </div>

                <div class="mb-3">
                    <label for="nama_buku" class="form-label">Nama Buku</label>
                    <input type="text" class="form-control" id="nama_buku" name="nama_buku" value="<?php echo $row['nama_buku']; ?>">
                </div>

                <div class="mb-3">
                    <label for="author_buku" class="form-label">Author Buku</label>
                    <input type="text" class="form-control" id="author_buku" name="author_buku" value="<?php echo $row['author_buku']; ?>">
                </div>

                <div class="mb-3">
                    <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
                    <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" value="<?php echo $row['tanggal_terbit']; ?>">
                </div>

                <div class="mb-3">
                    <label for="bahasa" class="form-label">Bahasa</label>
                    <input type="text" class="form-control" id="bahasa" name="bahasa" value="<?php echo $row['bahasa']; ?>">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?php echo $row['deskripsi']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="id_kategori" name="id_kategori">
                        <?php
                        // Menampilkan pilihan kategori berdasarkan hasil query
                        while ($kategori_row = $kategori_result->fetch_assoc()) {
                            $selected = ($kategori_row['id_kategori'] == $row['id_kategori']) ? 'selected' : '';
                            echo "<option value='" . $kategori_row['id_kategori'] . "' $selected>" . $kategori_row['nama_kategori'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $row['stok']; ?>">
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn btn-primary w-100">Save</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Akhir form edit -->

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