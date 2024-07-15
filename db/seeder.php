<?php
include 'koneksi.php';

// Data untuk dimasukkan ke tabel kategori
$kategori = [
    'Teknologi',
    'Novel',
    'Komik',
    'Pendidikan',
    'Sains'
];

// Fungsi untuk menampilkan hasil
function output($message)
{
    if (php_sapi_name() == 'cli') {
        echo $message . "\n";
    } else {
        echo $message . "<br>";
    }
}

// Memasukkan data ke tabel kategori dengan pengecekan duplikat manual
foreach ($kategori as $nama_kategori) {
    // Periksa apakah kategori sudah ada
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM kategori WHERE nama_kategori = ?");
    $checkStmt->bind_param("s", $nama_kategori);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count == 0) { // Kategori belum ada
        $stmt = $conn->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
        $stmt->bind_param("s", $nama_kategori);
        if ($stmt->execute()) {
            output("Kategori '$nama_kategori' berhasil dimasukkan.");
        } else {
            output("Gagal memasukkan kategori '$nama_kategori': " . $stmt->error);
        }
        $stmt->close();
    } else {
        output("Kategori '$nama_kategori' sudah ada.");
    }
}

$conn->close();
