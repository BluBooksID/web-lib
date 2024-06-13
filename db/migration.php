<?php
// Jalankan file di terminal dengan perintah "php migration.php" atau dapat menjalankan pada web browser
include '../db/koneksi.php';

// membuat kueri migration
$queries = [
    "CREATE TABLE IF NOT EXISTS admin (
        id_admin INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARBINARY(255) NOT NULL,
        nama VARCHAR(255) NOT NULL,
        jenis_kelamin ENUM('laki-laki', 'perempuan') NOT NULL
    )",

    "CREATE TABLE IF NOT EXISTS pengguna (
        id_pengguna INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARBINARY(255) NOT NULL,
        NIM VARCHAR(20) UNIQUE NOT NULL,
        nama_pengguna VARCHAR(255) NOT NULL,
        jenis_kelamin ENUM('laki-laki', 'perempuan') NOT NULL,
        alamat TEXT
    )",

    "CREATE TABLE IF NOT EXISTS kategori (
        id_kategori INT PRIMARY KEY AUTO_INCREMENT,
        nama_kategori VARCHAR(255) NOT NULL
    )",

    "CREATE TABLE IF NOT EXISTS buku (
        id_buku INT PRIMARY KEY AUTO_INCREMENT,
        cover VARCHAR(255),
        nama_buku VARCHAR(255) NOT NULL,
        author_buku VARCHAR(255) NOT NULL,
        tanggal_terbit DATE NOT NULL,
        bahasa VARCHAR(50) NOT NULL,
        deskripsi TEXT,
        id_kategori INT,
        stok INT UNSIGNED NOT NULL,
        FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
    )",

    "CREATE TABLE IF NOT EXISTS status (
        id_status INT PRIMARY KEY AUTO_INCREMENT,
        id_pengguna INT NOT NULL,
        id_buku INT NOT NULL,
        status VARCHAR(50) NOT NULL,
        FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna),
        FOREIGN KEY (id_buku) REFERENCES buku(id_buku)
    )",

    "CREATE TABLE IF NOT EXISTS transaksi (
        id_transaksi INT PRIMARY KEY AUTO_INCREMENT,
        id_pengguna INT NOT NULL,
        id_buku INT NOT NULL,
        tanggal_pinjam DATE NOT NULL,
        tanggal_pengembalian DATE,
        FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna),
        FOREIGN KEY (id_buku) REFERENCES buku(id_buku)
    )",

    // membuat index untuk improve performa
    "CREATE INDEX idx_admin_email ON admin(email)",
    "CREATE INDEX idx_pengguna_email ON pengguna(email)",
    "CREATE INDEX idx_pengguna_nim ON pengguna(NIM)",
];

// cek apakah proses migrasi menggunakan CLI atau Browser
$shiftEnter = (php_sapi_name() === 'cli') ? PHP_EOL : '<br>';

// eksekusi kueri migration
foreach ($queries as $query) {
    if ($conn->query($query) === TRUE) {
        echo "Migration berhasil: $query" . $shiftEnter;
    } else {
        echo "Error: " . $conn->error . $shiftEnter;
    }
}

// tutup database connection
$conn->close();
