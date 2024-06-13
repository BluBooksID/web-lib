<?php
session_start();
include '../db/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $NIM = $_POST['NIM'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirmation'];

    // bila error
    $errors = [];

    if (empty($NIM)) {
        $errors[] = "Mohon untuk mengisi NIM!";
    }
    if (empty($nama_pengguna)) {
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

    $NIM_check = $conn->prepare("SELECT id_pengguna FROM pengguna WHERE NIM = ?");
    $NIM_check->bind_param("s", $NIM);
    $NIM_check->execute();
    $NIM_check->store_result();
    if ($NIM_check->num_rows > 0) {
        $errors[] = "NIM sudah terdaftar.";
    }
    $NIM_check->close();

    // cek apakah email atau NIM sudah terdaftar
    $email_check = $conn->prepare("SELECT id_pengguna FROM pengguna WHERE email = ?");
    $email_check->bind_param("s", $email);
    $email_check->execute();
    $email_check->store_result();
    if ($email_check->num_rows > 0) {
        $errors[] = "Email sudah terdaftar.";
    }
    $email_check->close();


    // jika tidak error lanjut input ke db
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $db = $conn->prepare("INSERT INTO pengguna (email, password, NIM, nama_pengguna, jenis_kelamin, alamat) VALUES (?, ?, ?, ?, ?, ?)");
        $alamat = "";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                <input id="NIM" type="text" name="NIM" value="" required autocomplete="NIM" placeholder="NIM">
            </div>

            <div>
                <input id="nama_pengguna" type="text" name="nama_pengguna" value="" required autocomplete="nama_pengguna" autofocus placeholder="Nama">
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
    </div>
</body>

</html>