<?php

class AdminController
{
    public function register()
    {
        include '../../db/koneksi.php'; // Sisipkan file koneksi database

        // Memeriksa apakah permintaan adalah metode POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST['nama'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirmation'];

            // Array untuk menyimpan pesan kesalahan
            $errors = [];

            // Validasi input
            if (empty($nama)) {
                $errors[] = "Nama harus diisi.";
            }
            if (empty($email)) {
                $errors[] = "Email harus diisi.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Format email salah.";
            }
            if (empty($password)) {
                $errors[] = "Password harus diisi.";
            }
            if ($password !== $password_confirm) {
                $errors[] = "Passwords tidak sama.";
            }

            // Memeriksa apakah nama sudah terdaftar
            $nama_check = $conn->prepare("SELECT id_admin FROM admin WHERE nama = ?");
            $nama_check->bind_param("s", $nama);
            $nama_check->execute();
            $nama_check->store_result();
            if ($nama_check->num_rows > 0) {
                $errors[] = "Nama sudah terdaftar.";
            }
            $nama_check->close();

            // Memeriksa apakah email sudah terdaftar pada admin
            $email_check = $conn->prepare("SELECT id_admin FROM admin WHERE email = ?");
            $email_check->bind_param("s", $email);
            $email_check->execute();
            $email_check->store_result();
            if ($email_check->num_rows > 0) {
                $errors[] = "Email sudah terdaftar.";
            }
            $email_check->close();

            // Memeriksa apakah email sudah terdaftar pada pengguna
            $email_check_user = $conn->prepare("SELECT id_pengguna FROM pengguna WHERE email = ?");
            $email_check_user->bind_param("s", $email);
            $email_check_user->execute();
            $email_check_user->store_result();
            if ($email_check_user->num_rows > 0) {
                $errors[] = "Email sudah terdaftar.";
            }
            $email_check_user->close();

            // Jika tidak ada kesalahan, masukkan data ke database
            if (empty($errors)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $db = $conn->prepare("INSERT INTO admin (email, password, nama, jenis_kelamin) VALUES (?, ?, ?, ?)");

                // Binding parameter untuk query insert
                $db->bind_param("ssss", $email, $hashed_password, $nama, $jenis_kelamin);

                // Eksekusi query insert
                if ($db->execute()) {
                    $_SESSION['message'] = "Registrasi berhasil!";
                    unset($_SESSION['akses_diberikan']);
                    include '../../config.php';
                    header("Location: " . BASE_URL . "/pages/auth.php"); // Redirect ke halaman login/registrasi setelah registrasi berhasil
                    exit();
                } else {
                    $errors[] = "Error: " . $db->error;
                }
                $db->close();
            }
        }
    }
}

$adminController = new AdminController();

// Panggil fungsi register() jika permintaan adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminController->register();
}

// Redirect ke halaman admin_only.php jika tidak ada akses yang diberikan atau akses tidak benar
if (!isset($_SESSION['akses_diberikan']) || $_SESSION['akses_diberikan'] !== true) {
    header('Location: admin_only.php');
    exit();
}
