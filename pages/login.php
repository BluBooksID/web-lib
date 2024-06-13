<?php
session_start();
include '../db/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $credential = $_POST['credential'];
    $password = $_POST['password'];

    // bila error
    $errors = [];

    if (empty($credential)) {
        $errors[] = "NIM atau email harus di isi.";
    }
    if (empty($password)) {
        $errors[] = "Password harus di isi.";
    }

    if (empty($errors)) {
        // menentukan apakah login menggunakan NIM atau email
        if (filter_var($credential, FILTER_VALIDATE_EMAIL)) {
            $db = $conn->prepare("SELECT id_pengguna, password, nama_pengguna FROM pengguna WHERE email = ?");
        } else {
            $db = $conn->prepare("SELECT id_pengguna, password, nama_pengguna FROM pengguna WHERE NIM = ?");
        }

        $db->bind_param("s", $credential);
        $db->execute();
        $db->store_result();

        if ($db->num_rows > 0) {
            $db->bind_result($id_pengguna, $hashed_password, $nama_pengguna);
            $db->fetch();

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
        $db->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div>
        <h1>Login</h1>
        <form method="POST" action="">
            <?php
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p style='color:red;'>$error</p>";
                }
            }
            ?>
            <div>
                <input id="credential" type="text" name="credential" value="<?php echo isset($_POST['credential']) ? htmlspecialchars($_POST['credential'], ENT_QUOTES) : ''; ?>" required autocomplete="credential" autofocus placeholder="NIM atau Email">
            </div>

            <div>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password">
            </div>

            <div>
                <button type="submit">Login</button>
                <a href="register.php">Register</a>
            </div>
        </form>

        <div>
            <a href="../index.php">kembali ke index</a>
        </div>
    </div>
</body>

</html>