<?php

class AuthController
{
    public function login()
    {
        include '../db/koneksi.php'; // Sisipkan file koneksi database

        // Memeriksa apakah permintaan adalah metode POST dan tombol login ditekan
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
            $credential = $_POST['credential'];
            $password = $_POST['password'];

            // Array untuk menyimpan pesan kesalahan
            $errors = [];

            // Validasi input
            if (empty($credential)) {
                $errors[] = "NIM atau email harus diisi.";
            }
            if (empty($password)) {
                $errors[] = "Password harus diisi.";
            }

            if (empty($errors)) {
                // Query untuk mencari pengguna berdasarkan email atau NIM
                if (filter_var($credential, FILTER_VALIDATE_EMAIL)) {
                    $query_user = "SELECT id_pengguna, password, nama_pengguna FROM pengguna WHERE email = ?";
                } else {
                    $query_user = "SELECT id_pengguna, password, nama_pengguna FROM pengguna WHERE NIM = ?";
                }

                // Persiapkan statement SQL untuk pengguna
                $stmt_user = $conn->prepare($query_user);
                if ($stmt_user) {
                    $stmt_user->bind_param("s", $credential);
                    $stmt_user->execute();
                    $stmt_user->store_result();

                    // Jika ditemukan pengguna, verifikasi password
                    if ($stmt_user->num_rows > 0) {
                        $stmt_user->bind_result($id_pengguna, $hashed_password, $nama_pengguna);
                        $stmt_user->fetch();

                        if (password_verify($password, $hashed_password)) {
                            // Set session untuk pengguna
                            $_SESSION['id_pengguna'] = $id_pengguna;
                            $_SESSION['nama_pengguna'] = $nama_pengguna;
                            include '../config.php';
                            header("Location: " . BASE_URL . "/pages/user/dashboard.php"); // Redirect ke dashboard pengguna setelah login berhasil
                            exit();
                        } else {
                            $errors[] = "Password salah.";
                        }
                    } else {
                        $errors[] = "NIM atau email tidak ditemukan.";
                    }
                    $stmt_user->close();
                } else {
                    $errors[] = "Query preparation error untuk pengguna: " . $conn->error;
                }

                // Query untuk mencari admin berdasarkan email
                $query_admin = "SELECT id_admin, password, nama FROM admin WHERE email = ?";
                $stmt_admin = $conn->prepare($query_admin);
                if ($stmt_admin) {
                    $stmt_admin->bind_param("s", $credential);
                    $stmt_admin->execute();
                    $stmt_admin->store_result();

                    // Jika ditemukan admin, verifikasi password
                    if ($stmt_admin->num_rows > 0) {
                        $stmt_admin->bind_result($id_admin, $hashed_password, $nama);
                        $stmt_admin->fetch();

                        if (password_verify($password, $hashed_password)) {
                            // Set session untuk admin
                            $_SESSION['id_admin'] = $id_admin;
                            $_SESSION['nama_admin'] = $nama;
                            include '../config.php';
                            header("Location: " . BASE_URL . "/pages/admin/dashboard.php"); // Redirect ke dashboard admin setelah login berhasil
                            exit();
                        } else {
                            $errors[] = "Password salah.";
                        }
                    } else {
                        // $errors[] = "Email admin tidak ditemukan.";
                    }
                    $stmt_admin->close();
                } else {
                    $errors[] = "Query preparation error untuk admin: " . $conn->error;
                }
            }

            // Set session errors jika ada kesalahan
            $_SESSION['errors'] = $errors;
        }
    }

    public function register()
    {
        include '../db/koneksi.php'; // Sisipkan file koneksi database

        // Memeriksa apakah permintaan adalah metode POST dan tombol register ditekan
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
            $NIM = $_POST['NIM'];
            $nama_pengguna = $_POST['nama_pengguna'];
            $alamat = $_POST['alamat'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirmation'];

            // Array untuk menyimpan pesan kesalahan
            $errors = [];

            // Validasi input
            if (empty($NIM)) {
                $errors[] = "Mohon untuk mengisi NIM!";
            }
            if (empty($nama_pengguna)) {
                $errors[] = "Nama harus diisi.";
            }
            if (empty($alamat)) {
                $errors[] = "Mohon untuk mengisi alamat.";
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

            // Memeriksa apakah NIM sudah terdaftar
            $NIM_check = $conn->prepare("SELECT id_pengguna FROM pengguna WHERE NIM = ?");
            $NIM_check->bind_param("s", $NIM);
            $NIM_check->execute();
            $NIM_check->store_result();
            if ($NIM_check->num_rows > 0) {
                $errors[] = "NIM sudah terdaftar.";
            }
            $NIM_check->close();

            // Memeriksa apakah email sudah terdaftar
            $email_check = $conn->prepare("SELECT id_pengguna FROM pengguna WHERE email = ?");
            $email_check->bind_param("s", $email);
            $email_check->execute();
            $email_check->store_result();
            if ($email_check->num_rows > 0) {
                $errors[] = "Email sudah terdaftar.";
            }
            $email_check->close();

            // Jika tidak ada kesalahan, masukkan data ke database
            if (empty($errors)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $db = $conn->prepare("INSERT INTO pengguna (email, password, NIM, nama_pengguna, jenis_kelamin, alamat) VALUES (?, ?, ?, ?, ?, ?)");
                $db->bind_param("ssssss", $email, $hashed_password, $NIM, $nama_pengguna, $jenis_kelamin, $alamat);

                if ($db->execute()) {
                    $_SESSION['message'] = "Registrasi berhasil!";
                    include '../config.php';
                    header("Location: " . BASE_URL . "/pages/auth.php"); // Redirect ke halaman login/registrasi setelah registrasi berhasil
                    exit();
                } else {
                    $errors[] = "Error: " . $db->error;
                }
                $db->close();
            }

            // Set session errors jika ada kesalahan
            $_SESSION['errors'] = $errors;
        }
    }
}

$authController = new AuthController();

// Panggil fungsi login() atau register() berdasarkan tombol yang ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $authController->login();
    } elseif (isset($_POST['register'])) {
        $authController->register();
    }
}

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);
