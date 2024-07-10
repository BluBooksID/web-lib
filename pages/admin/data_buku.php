<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        .book-title,
        .book-description {
            max-height: calc(1.2em * 4);
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            /* Number of lines to show */
            -webkit-box-orient: vertical;
        }
    </style>
</head>

<body>
    <!-- PHP Script -->
    <?php
    session_start();
    if (!isset($_SESSION['id_admin']) || !isset($_SESSION['nama_admin'])) {
        include '../../config.php';
        header("Location: " . BASE_URL . "/pages/auth.php");
        exit();
    }

    include '../../db/koneksi.php';
    $kategori_result = $conn->query("SELECT id_kategori, nama_kategori FROM kategori");
    include '../../controllers/BukuController.php';

    // Determine current page and books per page
    $booksPerPage = 25;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $booksPerPage;

    // Fetch books with pagination
    $sql = "SELECT buku.*, kategori.nama_kategori 
        FROM buku 
        LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
        LIMIT $offset, $booksPerPage";
    $result = $conn->query($sql);

    // Count total number of books for pagination
    $total_books_query = $conn->query("SELECT COUNT(*) AS total FROM buku");
    $total_books = $total_books_query->fetch_assoc()['total'];

    // Calculate total pages
    $total_pages = ceil($total_books / $booksPerPage);
    ?>
    <!-- End PHP Script -->

    <!-- Navbar -->
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <div class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/web-lib/resources/asset/logo.svg" alt="Logo" width="150" height="35">
                </div>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
                    <li><a href="dashboard.php" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 text-secondary">Kelola Buku</a></li>
                    <li><a href="admin_pinjaman.php" class="nav-link px-2 text-white">Kelola Pinjaman Buku</a></li>
                    <li><a href="riwayat_transaksi.php" class="nav-link px-2 text-white">Riwayat Transaksi</a></li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-light px-4 me-sm-3 fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <!-- End Navbar -->

    <!--Heading-->
    <div class="p-3 text-center">
        <div class="container pt-3">
            <h1 class="text-body-emphasis">Pengelolaan Buku</h1>
        </div>
    </div>

    <!--Konten-->
    <div class="container mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="container bg-body-tertiary border rounded-3 px-4 pb-5 p-4 p-md-5">
                        <!-- Form Tambah Buku -->
                        <form method="post" action="data_buku.php" enctype="multipart/form-data">
                            <input type="hidden" name="id_buku"
                                value="<?php echo isset($_GET['id_buku']) ? $_GET['id_buku'] : ''; ?>">
                            <div class="mb-3">
                                <label for="cover" class="form-label">Cover</label>
                                <input type="file" class="form-control" id="cover" name="cover">
                            </div>
                            <div class="mb-3">
                                <label for="nama_buku" class="form-label">Nama Buku</label>
                                <input type="text" class="form-control" id="nama_buku" name="nama_buku">
                            </div>
                            <div class="mb-3">
                                <label for="author_buku" class="form-label">Author Buku</label>
                                <input type="text" class="form-control" id="author_buku" name="author_buku">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
                                <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit">
                            </div>
                            <div class="mb-3">
                                <label for="bahasa" class="form-label">Bahasa</label>
                                <input type="text" class="form-control" id="bahasa" name="bahasa">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="id_kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="id_kategori" name="id_kategori">
                                    <?php
                                    while ($row = $kategori_result->fetch_assoc()) {
                                        echo "<option value='" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok">
                            </div>
                            <div class="pt-2">
                                <button type="submit" class="btn btn-primary w-100">Save</button>
                            </div>
                        </form>
                        <!-- End Form Tambah Buku -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container bg-light border rounded-3 px-4 pb-5 p-4 p-md-5">
                        <h4 class="mb-3">Penggunaan Form</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce facilisis libero sed neque
                            venenatis sollicitudin. Maecenas erat ligula, porta eu dictum non, ultricies eget sem.
                            Integer in est porttitor, pulvinar tellus ac, pharetra massa. Vestibulum convallis
                            vestibulum ornare. Aliquam laoreet eros quis purus volutpat, in gravida enim hendrerit.
                            Aliquam dui lacus, gravida sit amet consectetur ut, venenatis eget ex. Donec efficitur,
                            velit in pharetra pretium, nibh erat rhoncus odio, sit amet feugiat tortor orci ac felis.
                            Morbi lacinia eros velit, et sollicitudin justo laoreet eget. Morbi lobortis augue ut
                            finibus semper. Quisque gravida elit a enim feugiat, ut elementum urna placerat. Etiam eu
                            euismod arcu. Ut fermentum a nulla nec sodales.
                        </p>
                        <p>
                            Vestibulum bibendum iaculis elementum. Ut nec lacus sed ligula vulputate sodales. Donec
                            rhoncus fringilla laoreet. Nulla facilisi. In urna leo, feugiat at leo suscipit, mattis
                            consequat nisi. Vestibulum ultrices purus in nunc consectetur commodo. Pellentesque habitant
                            morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="table-responsive pt-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cover</th>
                            <th>Nama Buku</th>
                            <th>Author Buku</th>
                            <th>Tanggal Terbit</th>
                            <th>Bahasa</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Your PHP loop for table rows -->
                        <?php
                        $count = 0;
                        while ($row = $result->fetch_assoc()) {
                            if ($count >= 25) {
                                break;
                            }
                            $count++;

                            // Start table row
                            echo "<tr>";
                            echo "<td>" . $row["id_buku"] . "</td>";
                            echo "<td><img src='../../" . $row["cover"] . "' width='50' height='50' class='img-fluid'></td>";
                            echo "<td class='book-title'>" . $row["nama_buku"] . "</td>";
                            echo "<td>" . $row["author_buku"] . "</td>";
                            echo "<td>" . $row["tanggal_terbit"] . "</td>";
                            echo "<td>" . $row["bahasa"] . "</td>";
                            echo "<td class='book-description'>" . $row["deskripsi"] . "</td>";
                            echo "<td>" . $row["nama_kategori"] . "</td>";
                            echo "<td>" . $row["stok"] . "</td>";
                            echo "<td class='text-center'>";

                            // Edit Button
                            echo "<a href='edit_buku.php?id_buku=" . $row["id_buku"] . "' class='btn btn-sm btn-primary mb-1'>Edit</a>";

                            // Delete Button (only if book is not in transactions)
                            if (!isBookInTransactions($conn, $row["id_buku"])) {
                                echo "<a href='data_buku.php?delete=" . $row["id_buku"] . "' class='btn btn-sm btn-danger mb-1' onclick=\"return confirm('Are you sure?')\">Delete</a>";
                            }

                            echo "</td>";
                            // End table row
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav class="pagination-container" aria-label="Page navigation">
                <ul class="pagination justify-content-end">
                    <?php if ($current_page > 1): ?>
                        <li class="page-item"><a class="page-link"
                                href="?page=<?php echo $current_page - 1; ?>">Previous</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>"><a class="page-link"
                                href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>

                    <?php if ($current_page < $total_pages): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
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

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>