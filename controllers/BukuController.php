<?php

class BukuController
{
    public function tambah_edit_buku()
    {
        include '../../db/koneksi.php'; // Sisipkan file koneksi database

        // Handle Create and Update
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_buku = isset($_POST['id_buku']) ? $_POST['id_buku'] : '';
            $cover = isset($_FILES['cover']) ? $_FILES['cover'] : null;
            $nama_buku = $_POST['nama_buku'];
            $author_buku = $_POST['author_buku'];
            $tanggal_terbit = $_POST['tanggal_terbit'];
            $bahasa = $_POST['bahasa'];
            $deskripsi = $_POST['deskripsi'];
            $id_kategori = $_POST['id_kategori'];
            $stok = $_POST['stok'];
            $cover_path = '';

            // Handle file upload jika ada file yang diunggah
            if ($cover && $cover['error'] === UPLOAD_ERR_OK) {
                $target_dir = "../../public/assets/storage/cover_buku/"; // Path untuk menyimpan file cover
                $file_name = basename($cover["name"]);
                $unique_name = time() . "_" . $file_name; // Menggunakan timestamp untuk membuat nama file unik
                $target_file = $target_dir . $unique_name;

                // Pindahkan file yang diunggah ke lokasi target
                if (move_uploaded_file($cover["tmp_name"], $target_file)) {
                    $cover_path = "public/assets/storage/cover_buku/" . $unique_name; // Path yang disimpan dalam database
                } else {
                    echo "Maaf, terjadi error saat upload file.";
                    exit;
                }
            }

            // Persiapkan query SQL sesuai dengan apakah id_buku sudah ada (untuk update) atau belum (untuk insert)
            if ($id_buku) {
                // Update record yang sudah ada
                if ($cover_path) {
                    // Gunakan cover baru jika ada yang diunggah
                    $sql = "UPDATE buku SET cover='$cover_path', nama_buku='$nama_buku', author_buku='$author_buku', tanggal_terbit='$tanggal_terbit', bahasa='$bahasa', deskripsi='$deskripsi', id_kategori=$id_kategori, stok=$stok WHERE id_buku=$id_buku";
                } else {
                    // Tetapkan cover lama jika tidak ada cover baru yang diunggah
                    $sql = "UPDATE buku SET nama_buku='$nama_buku', author_buku='$author_buku', tanggal_terbit='$tanggal_terbit', bahasa='$bahasa', deskripsi='$deskripsi', id_kategori=$id_kategori, stok=$stok WHERE id_buku=$id_buku";
                }
            } else {
                // Insert record baru
                $sql = "INSERT INTO buku (cover, nama_buku, author_buku, tanggal_terbit, bahasa, deskripsi, id_kategori, stok)
                VALUES ('$cover_path', '$nama_buku', '$author_buku', '$tanggal_terbit', '$bahasa', '$deskripsi', $id_kategori, $stok)";
            }

            // Eksekusi query SQL
            if ($conn->query($sql) === TRUE) {
                echo "Buku berhasil di edit"; // Pesan sukses
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error; // Pesan error jika terjadi masalah
            }
        }
    }

    public function hapus_buku()
    {
        include '../../db/koneksi.php'; // Sisipkan file koneksi database

        if (isset($_GET['delete'])) {
            $id_buku = $_GET['delete'];
            $sql = "DELETE FROM buku WHERE id_buku=$id_buku"; // Query untuk menghapus buku berdasarkan id_buku

            // Eksekusi query SQL hapus buku
            if ($conn->query($sql) === TRUE) {
                echo "Buku berhasil dihapus"; // Pesan sukses
            } else {
                echo "Error: " . $conn->error; // Pesan error jika terjadi masalah
            }
        }
    }
}

// Fungsi untuk validasi hapus buku
function isBookInTransactions($conn, $id_buku)
{
    $query = "SELECT COUNT(*) as count FROM transaksi WHERE id_buku = $id_buku";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['count'] > 0; // True jika buku ada pada tabel transaksi
}

$bukuController = new BukuController();

// Panggil fungsi tambah_edit_buku() jika request method adalah POST, atau panggil fungsi hapus_buku() jika terdapat parameter GET 'delete'
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bukuController->tambah_edit_buku();
} elseif (isset($_GET['delete'])) {
    $bukuController->hapus_buku();
}
