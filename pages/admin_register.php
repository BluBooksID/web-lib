<?php
session_start();
include '../db/koneksi.php';

if (!isset($_SESSION['akses_diberikan']) || $_SESSION['akses_diberikan'] !== true) {
    header('Location: admin_only.php');
    exit();
}

unset($_SESSION['akses_diberikan']);

include '../db/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirmation'];

    // bila error
    $errors = [];

    if (empty($nama)) {
        $errors[] = "Nama harus di isi.";
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

    $nama_check = $conn->prepare("SELECT id_admin FROM admin WHERE nama = ?");
    $nama_check->bind_param("s", $nama);
    $nama_check->execute();
    $nama_check->store_result();
    if ($nama_check->num_rows > 0) {
        $errors[] = "nama sudah terdaftar.";
    }
    $nama_check->close();

    // cek apakah email atau nama sudah terdaftar
    $email_check = $conn->prepare("SELECT id_admin FROM admin WHERE email = ?");
    $email_check->bind_param("s", $email);
    $email_check->execute();
    $email_check->store_result();
    if ($email_check->num_rows > 0) {
        $errors[] = "Email sudah terdaftar.";
    }
    $email_check->close();

    // cek apakah email atau NIM sudah terdaftar pada section pengguna
    $email_check_user = $conn->prepare("SELECT id_pengguna FROM pengguna WHERE email = ?");
    $email_check_user->bind_param("s", $email);
    $email_check_user->execute();
    $email_check_user->store_result();
    if ($email_check_user->num_rows > 0) {
        $errors[] = "Email sudah terdaftar.";
    }
    $email_check_user->close();

    // jika tidak error lanjut input ke db
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $db = $conn->prepare("INSERT INTO admin (email, password, nama, jenis_kelamin) VALUES (?, ?, ?, ?)");

        $db->bind_param("ssss", $email, $hashed_password, $nama, $jenis_kelamin);

        if ($db->execute()) {
            $_SESSION['message'] = "Registrasi berhasil!";
            header("Location: login.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="../resources/js/admin.js"></script>
</head>

<body>
    <div>
        <h1 class="text-center">Sign Up</h1>
        <form method="POST" action="">
            <?php
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p style='color:red;'>$error</p>";
                }
            }
            ?>

            <div>
                <input id="nama" type="text" name="nama" value="" required autocomplete="nama" autofocus placeholder="Nama">
            </div>

            <div>
                <p>Jenis Kelamin:
                    <select name="jenis_kelamin">
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </p>
            </div>

            <div>
                <input id="email" type="email" name="email" value="" required autocomplete="email" placeholder="Email">
            </div>

            <div>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Password">
            </div>

            <div>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
            </div>

            <div>
                <p>Sudah memiliki akun? <a href="login.php">Login</a></p>
            </div>

            <div>
                <button type="submit">
                    Register
                </button>
            </div>
        </form>
        <a href="../index.php">kembali ke index</a>
    </div>
</body>

</html>