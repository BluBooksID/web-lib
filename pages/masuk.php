<?php
session_start();
include '../db/koneksi.php'; // Pastikan path file koneksi.php sudah benar

$errors = [];

// Logika untuk Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $credential = $_POST['credential'];
    $password = $_POST['password'];

    if (empty($credential)) {
        $errors[] = "NIM atau email harus di isi.";
    }
    if (empty($password)) {
        $errors[] = "Password harus di isi.";
    }

    if (empty($errors)) {
        if (filter_var($credential, FILTER_VALIDATE_EMAIL)) {
            $query_user = "SELECT id_pengguna, password, nama_pengguna FROM pengguna WHERE email = ?";
        } else {
            $query_user = "SELECT id_pengguna, password, nama_pengguna FROM pengguna WHERE NIM = ?";
        }

        $stmt_user = $conn->prepare($query_user);
        if ($stmt_user) {
            $stmt_user->bind_param("s", $credential);
            $stmt_user->execute();
            $stmt_user->store_result();

            if ($stmt_user->num_rows > 0) {
                $stmt_user->bind_result($id_pengguna, $hashed_password, $nama_pengguna);
                $stmt_user->fetch();

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['id_pengguna'] = $id_pengguna;
                    $_SESSION['nama_pengguna'] = $nama_pengguna;
                    header("Location: dashboard.php");
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

        $query_admin = "SELECT id_admin, password, nama FROM admin WHERE email = ?";
        $stmt_admin = $conn->prepare($query_admin);
        if ($stmt_admin) {
            $stmt_admin->bind_param("s", $credential);
            $stmt_admin->execute();
            $stmt_admin->store_result();

            if ($stmt_admin->num_rows > 0) {
                $stmt_admin->bind_result($id_admin, $hashed_password, $nama);
                $stmt_admin->fetch();

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['id_admin'] = $id_admin;
                    $_SESSION['nama_admin'] = $nama;
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    $errors[] = "Password salah.";
                }
            } else {
                $errors[] = "Email tidak ditemukan.";
            }
            $stmt_admin->close();
        } else {
            $errors[] = "Query preparation error untuk admin: " . $conn->error;
        }
    }
}

// Logika untuk Register
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $NIM = $_POST['NIM'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirmation'];

    if (empty($NIM)) {
        $errors[] = "Mohon untuk mengisi NIM!";
    }
    if (empty($nama_pengguna)) {
        $errors[] = "Nama harus di isi.";
    }
    if (empty($alamat)) {
        $errors[] = "Mohon untuk mengisi alamat.";
    }
    if (empty($email)) {
        $errors[] = "Email harus di isi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email salah.";
    }
    if (empty($password)) {
        $errors[] = "Password harus di isi.";
    }
    if ($password !== $password_confirm) {
        $errors[] = "Passwords tidak sama.";
    }

    $NIM_check = $conn->prepare("SELECT id_pengguna FROM pengguna WHERE NIM = ?");
    $NIM_check->bind_param("s", $NIM);
    $NIM_check->execute();
    $NIM_check->store_result();
    if ($NIM_check->num_rows > 0) {
        $errors[] = "NIM sudah terdaftar.";
    }
    $NIM_check->close();

    $email_check = $conn->prepare("SELECT id_pengguna FROM pengguna WHERE email = ?");
    $email_check->bind_param("s", $email);
    $email_check->execute();
    $email_check->store_result();
    if ($email_check->num_rows > 0) {
        $errors[] = "Email sudah terdaftar.";
    }
    $email_check->close();

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $db = $conn->prepare("INSERT INTO pengguna (email, password, NIM, nama_pengguna, jenis_kelamin, alamat) VALUES (?, ?, ?, ?, ?, ?)");
        $db->bind_param("ssssss", $email, $hashed_password, $NIM, $nama_pengguna, $jenis_kelamin, $alamat);

        if ($db->execute()) {
            $_SESSION['message'] = "Registrasi berhasil!";
            header("Location: masuk.php");
            exit();
        } else {
            $errors[] = "Error: " . $db->error;
        }
        $db->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BluBooks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/web-lib/resources/css/login.css">
</head>

<body>
    <div class="login-page">
        <div class="form">
            <form class="register-form" method="POST" action="">
                <h2><i class="fas fa-lock"></i> Register</h2>
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<p style='color:red;'>$error</p>";
                    }
                }
                ?>
                <input type="text" name="NIM" placeholder="NIM *" required />
                <input type="text" name="nama_pengguna" placeholder="Nama Pengguna *" required />
                <input type="text" name="alamat" placeholder="Alamat *" required />
                <select name="jenis_kelamin" required>
                    <option value="" disabled selected>Jenis Kelamin *</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <input type="email" name="email" placeholder="Email *" required />
                <input type="password" name="password" placeholder="Password *" required />
                <input type="password" name="password_confirmation" placeholder="Confirm Password *" required />
                <button type="submit" name="register">BUAT AKUN</button>
                <p class="message">Sudah Daftar? <a href="#">Masuk</a></p>
            </form>

            <form class="login-form" method="POST" action="">
                <h2><i class="fas fa-lock"></i> Login</h2>
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<p style='color:red;'>$error</p>";
                    }
                }
                ?>
                <input type="text" name="credential" placeholder="NIM atau Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <button type="submit" name="login">LOGIN</button>
                <p class="message">Belum Daftar? <a href="#">Buat Akun</a></p>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/web-lib/resources/js/app.js"></script>
</body>

</html>