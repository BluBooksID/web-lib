<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pinjaman Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table img {
            max-width: 50px;
            height: auto;
        }
    </style>
</head>

<body>
    <!-- PHP backend code -->
    <?php
    session_start();
    if (!isset($_SESSION['id_admin'])) {
        echo "<div class='alert alert-danger'>Akses Ditolak!</div>";
        exit;
    }
    include '../../controllers/TransaksiController.php';
    include '../../db/koneksi.php';
    $result = $conn->query($verifikasi);
    ?>
    <!-- End of PHP backend code -->

    <!-- Awal navbar -->
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <div class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/web-lib/resources/asset/logo.svg" alt="Logo" width="150" height="35">
                </div>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
                    <li><a href="dashboard.php" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="data_buku.php" class="nav-link px-2 text-white">Kelola Buku</a></li>
                    <li><a href="admin_pinjaman.php" class="nav-link px-2 text-secondary">Kelola Pinjaman Buku</a></li>
                    <li><a href="riwayat_transaksi.php" class="nav-link px-2 text-white">Riwayat Transaksi</a></li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-light px-4 me-sm-3 fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Akhir navbar -->

    <div class="container mt-4">
        <h2 class="mb-4">Manajemen Pinjaman Buku</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nama Pengguna</th>
                        <th>Cover</th>
                        <th>Nama Buku</th>
                        <th>Author Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status Buku</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["nama_pengguna"] . "</td>";
                            echo "<td><img src='../../" . $row["cover"] . "' alt='Cover Buku'></td>";
                            echo "<td>" . $row["nama_buku"] . "</td>";
                            echo "<td>" . $row["author_buku"] . "</td>";
                            echo "<td>" . $row["tanggal_pinjam"] . "</td>";
                            echo "<td>" . ($row["tanggal_pengembalian"] ? $row["tanggal_pengembalian"] : "Belum dikembalikan") . "</td>";
                            echo "<td>" . ucfirst($row["status_buku"]) . "</td>";
                            echo "<td>";
                            if ($row["status_buku"] == 'on_review') {
                                echo "<a href='admin_pinjaman.php?verify=dikembalikan&id_transaksi=" . $row["id_transaksi"] . "' class='btn btn-primary'>Verifikasi</a>";
                            } elseif ($row["status_buku"] == 'dikembalikan') {
                                echo "<span class='badge bg-success'>Sudah diverifikasi</span>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Belum ada buku yang perlu diverifikasi.</td></tr>";
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>