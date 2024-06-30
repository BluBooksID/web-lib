<?php

class UserController
{
    public function pinjam_buku()
    {
        include '../../db/koneksi.php'; // Sisipkan file koneksi database
        if (isset($_GET['borrow'])) {
            if (isset($_SESSION['id_pengguna'])) {
                $id_pengguna = $_SESSION['id_pengguna'];
                $id_buku = $_GET['borrow'];
                $tanggal_pinjam = date('Y-m-d');

                // Cek apakah user sudah meminjam buku yang sama dan belum mengembalikannya
                $check_borrowed_sql = "SELECT * FROM transaksi WHERE id_pengguna=$id_pengguna AND id_buku=$id_buku AND tanggal_pengembalian IS NULL";
                $check_borrowed_result = $conn->query($check_borrowed_sql);

                if ($check_borrowed_result->num_rows > 0) {
                    echo "Anda sudah meminjam buku ini dan belum mengembalikannya.";
                } else {
                    // Cek stok buku
                    $check_stock_sql = "SELECT stok FROM buku WHERE id_buku=$id_buku";
                    $check_stock_result = $conn->query($check_stock_sql);
                    $book = $check_stock_result->fetch_assoc();

                    if ($book['stok'] > 0) {
                        // Kurangi stok buku
                        $new_stock = $book['stok'] - 1;
                        $update_stock_sql = "UPDATE buku SET stok=$new_stock WHERE id_buku=$id_buku";
                        $conn->query($update_stock_sql);

                        // Masukkan data ke tabel transaksi
                        $borrow_sql = "INSERT INTO transaksi (id_pengguna, id_buku, tanggal_pinjam, status_buku) VALUES ($id_pengguna, $id_buku, '$tanggal_pinjam', 'dipinjam')";
                        if ($conn->query($borrow_sql) === TRUE) {
                            echo "Buku berhasil dipinjam"; // Pesan sukses
                        } else {
                            echo "Error: " . $borrow_sql . "<br>" . $conn->error; // Pesan error jika terjadi masalah
                        }
                    } else {
                        echo "Stok buku habis."; // Pesan jika stok buku habis
                    }
                }
            } else {
                echo "Login terlebih dahulu."; // Pesan jika pengguna belum login
            }
        }
    }
}

$userController = new UserController();
if (isset($_GET['borrow'])) {
    $userController->pinjam_buku(); // Panggil metode pinjam_buku() jika parameter 'borrow' diset
}
