<?php
session_start();
include '../db/koneksi.php'; // Pastikan path file koneksi.php sudah benar

$errors = [];

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BluBooks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/web-lib/resources/css/login.css">
</head>

<body>

    <body id="register-page">
        <div class="register-page">
            <div class="form">
                <form class="register-form" method="POST" action="">
                    <h2><i class="fas fa-user-plus"></i> Register</h2>
                    <?php
                    if (!empty($errors)) {
                        foreach ($errors as $error) {
                            echo "<p style='color:red;'>$error</p>";
                        }
                    }
                    ?>
                    <input id=NIM type="text" name="NIM" placeholder="NIM *" required />
                    <input id="nama_pengguna" type="text" name="nama_pengguna" placeholder="Nama Pengguna *" required />
                    <input id="alamat" type="text" name="alamat" placeholder="Alamat *" required />
                    <select name="jenis_kelamin" required>
                        <option value="" disabled selected>Jenis Kelamin *</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <input id="email" type="email" name="email" placeholder="Email *" required />
                    <input id="password" type="password" name="password" placeholder="Password *" required />
                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password *" required />
                    <button type="submit" name="register">BUAT AKUN</button>
                    <p class="message">Sudah Daftar? <a href="login.php">Masuk</a></p>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="/web-lib/resources/js/app.js"></script>
    </body>

</html>