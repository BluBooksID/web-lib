<?php
session_start();
include '../db/koneksi.php'; // Pastikan path file koneksi.php sudah benar

$errors = [];

// Logika untuk Login Pengguna
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
                    header("Location: user/dashboard.php");
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
    <title>Login Pengguna - BluBooks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- favicon -->
    <link href="../public/assets/images/favicon.png" rel="icon">

    <link rel="stylesheet" href="../resources/css/login.css">



</head>

<body id="login-page">
    <div class="login-page">
        <div class="form">
            <form class="login-form" method="POST" action="">
                <h2><i class="fa-solid fa-user"></i> Login Pengguna</h2>
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<p style='color:red;'>$error</p>";
                    }
                }
                ?>
                <input id="credential" type="text" name="credential" value="<?php echo isset($_POST['credential']) ? htmlspecialchars($_POST['credential'], ENT_QUOTES) : ''; ?>" required autocomplete="credential" autofocus placeholder="NIM atau Email">
                <input id="password" type="password" name="password" placeholder="Password" required />
                <button type="submit" name="login">LOGIN</button>
                <p class="message">Belum Daftar? <a href="register.php">Buat Akun</a></p>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../resources/js/app.js"></script>
</body>

</html>