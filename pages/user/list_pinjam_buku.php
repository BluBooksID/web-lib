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
                    <li><a href="list_pinjam_buku.php" class="nav-link px-2 text-secondary">Daftar Pinjaman Buku</a>
                    </li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-primary px-4 me-sm-3 fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Akhir navbar -->

    <div class="container mt-5">
        <h1 class="pb-3">Daftar Pinjaman Buku</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="bg-light text-center">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Buku</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Menampilkan data buku yang dipinjam jika ada hasil query
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $counter . "</td>"; // Menampilkan nomor urut, di tengah
                            echo "<td>" . $row["nama_buku"] . "</td>";
                            echo "<td class='text-center'>" . $row["tanggal_pinjam"] . "</td>"; // Tanggal pinjam, di tengah
                            echo "<td class='text-center'>" . ($row["tanggal_pengembalian"] ? $row["tanggal_pengembalian"] : "Belum dikembalikan") . "</td>"; // Tanggal pengembalian, di tengah
                            echo "<td class='text-center'>" . ucfirst($row["status_buku"]) . "</td>"; // Status, di tengah
                            echo "<td class='text-center'>";
                            // Tombol untuk mengembalikan buku, di tengah
                            if ($row["status_buku"] == 'dipinjam') {
                                echo "<a href='list_pinjam_buku.php?return=" . $row["id_transaksi"] . "' onclick=\"return confirm('Konfirmasi?')\" class='btn btn-primary btn-sm'>Kembalikan Buku</a>";
                            }
                            echo "</td>";
                            echo "</tr>";
                            $counter++; // Menambah counter setiap kali loop
                        }
                    } else {
                        // Menampilkan pesan jika tidak ada buku yang dipinjam
                        echo "<tr><td colspan='6' class='text-center'>Belum ada buku yang dipinjam.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>