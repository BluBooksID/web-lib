<?php

class TransaksiController
{
    public function verifikasi()
    {
        include '../../db/koneksi.php'; // Sisipkan file koneksi database

        // Handle verification of book return
        if (isset($_GET['verify']) && isset($_GET['id_transaksi'])) {
            $id_transaksi = $_GET['id_transaksi'];
            $verify = $_GET['verify']; // 'dikembalikan' or 'on_review'
            $tanggal_pengembalian = date('Y-m-d'); // Dapatkan tanggal saat ini

            // Ambil id_buku dari transaksi
            $get_book_sql = "SELECT id_buku FROM transaksi WHERE id_transaksi=$id_transaksi";
            $book_result = $conn->query($get_book_sql);
            $book = $book_result->fetch_assoc();
            $id_buku = $book['id_buku'];

            // Update status dan tanggal_pengembalian di tabel transaksi
            $verify_sql = "UPDATE transaksi SET status_buku='$verify', tanggal_pengembalian='$tanggal_pengembalian' WHERE id_transaksi=$id_transaksi";

            if ($conn->query($verify_sql) === TRUE) {
                if ($verify == 'dikembalikan') {
                    // Tingkatkan stok buku
                    $update_stock_sql = "UPDATE buku SET stok = stok + 1 WHERE id_buku=$id_buku";
                    $conn->query($update_stock_sql);
                }
                echo "Pengembalian buku berhasil diverifikasi"; // Pesan sukses
            } else {
                echo "Error: " . $verify_sql . "<br>" . $conn->error; // Pesan error jika terjadi masalah
            }
        }
    }

    public function pengembalian()
    {
        include '../../db/koneksi.php'; // Sisipkan koneksi database

        // Pastikan $_SESSION['id_pengguna'] dan $_GET['return'] sudah diatur dan aman digunakan
        if (isset($_SESSION['id_pengguna']) && isset($_GET['return'])) {
            $id_pengguna = $_SESSION['id_pengguna'];
            $id_transaksi = $_GET['return'];

            // Update tanggal pengembalian dan status di transaksi
            $return_sql = "UPDATE transaksi SET status_buku='on_review' WHERE id_transaksi=$id_transaksi AND id_pengguna=$id_pengguna";

            if ($conn->query($return_sql) === TRUE) {
                echo "Buku dikembalikan menunggu verifikasi"; // Pesan sukses
            } else {
                echo "Error: " . $return_sql . "<br>" . $conn->error; // Pesan error jika terjadi masalah
            }
        } else {
            echo "Parameter permintaan tidak valid."; // Pesan jika parameter tidak valid
        }
    }
}

// Query untuk mendapatkan transaksi yang belum dikembalikan
$verifikasi = "SELECT transaksi.id_transaksi, pengguna.nama_pengguna, buku.*, transaksi.tanggal_pinjam, transaksi.tanggal_pengembalian, transaksi.status_buku
        FROM transaksi
        JOIN pengguna ON transaksi.id_pengguna = pengguna.id_pengguna
        JOIN buku ON transaksi.id_buku = buku.id_buku
        WHERE transaksi.status_buku != 'dikembalikan'";

// Query untuk mendapatkan riwayat transaksi yang sudah dikembalikan
$riwayat_transaksi = "SELECT transaksi.id_transaksi, pengguna.nama_pengguna, buku.*, transaksi.tanggal_pinjam, transaksi.tanggal_pengembalian, transaksi.status_buku
        FROM transaksi
        JOIN pengguna ON transaksi.id_pengguna = pengguna.id_pengguna
        JOIN buku ON transaksi.id_buku = buku.id_buku
        WHERE transaksi.status_buku = 'dikembalikan'";

$transaksiController = new TransaksiController();

// Handle verifikasi pengembalian buku jika parameter 'verify' dan 'id_transaksi' diset
if (isset($_GET['verify']) && isset($_GET['id_transaksi'])) {
    $transaksiController->verifikasi();
}
// Handle proses pengembalian buku jika pengguna sudah login dan terdapat parameter 'return'
elseif (isset($_SESSION['id_pengguna'])) {
    $id_pengguna = $_SESSION['id_pengguna'];
    $pengembalian = "SELECT transaksi.id_transaksi, buku.*, transaksi.tanggal_pinjam, transaksi.tanggal_pengembalian, transaksi.status_buku
        FROM transaksi
        JOIN buku ON transaksi.id_buku = buku.id_buku
        WHERE transaksi.id_pengguna = $id_pengguna";
    if (isset($_SESSION['id_pengguna']) && isset($_GET['return'])) {
        $transaksiController->pengembalian();
    }
}
