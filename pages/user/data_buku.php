<!DOCTYPE html>
<html>

<head>
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

    <!-- Awal navbar -->
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <div class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/web-lib/resources/asset/logo.svg" alt="Logo" width="150" height="35">
                </div>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
                    <li><a href="dashboard.php" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 text-secondary">List Buku</a></li>
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

            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="me-3">Menampilkan <span class="fs-6 fw-bold"><?php echo $offset + 1; ?></span> -
                            <span class="fs-6 fw-bold"><?php echo min($offset + $limit, $total_books); ?></span>
                            dari <span class="fs-6 fw-bold"><?php echo $total_books; ?></span> hasil pencarian
                            buku</span>
                    </div>
                    <div class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" role="button" id="sortDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Urutkan
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item <?php echo $sort == 'terbaru' ? 'active' : ''; ?>"
                                    href="?sort=terbaru&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>">Terbaru</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo $sort == 'terlama' ? 'active' : ''; ?>"
                                    href="?sort=terlama&category=<?php echo $category_filter; ?>&search=<?php echo $search_query; ?>">Terlama</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
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
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p class='text-center'>Tidak ada buku yang ditemukan.</p>";
                    }
                    ?>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation example" class="mt-4">
                    <ul class="pagination justify-content-center">
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
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>