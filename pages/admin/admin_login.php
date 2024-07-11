<?php
session_start();
include '../../db/koneksi.php'; // Pastikan path file koneksi.php sudah benar

$errors = [];

// Logika untuk Login Admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $credential = $_POST['credential'];
    $password = $_POST['password'];

    if (empty($credential)) {
        $errors[] = "Email harus di isi.";
    }
    if (empty($password)) {
        $errors[] = "Password harus di isi.";
    }

    if (empty($errors)) {
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
                    header("Location: dashboard.php");
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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - BluBooks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../resources/css/login.css">
</head>

<body id="login-page">
    <div class="login-page">
        <div class="form">
            <form class="login-form" method="POST" action="">
                <h2><i class="fa-solid fa-user"></i> Login Admin</h2>
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<p style='color:red;'>$error</p>";
                    }
                }
                ?>
                <input id="credential" type="text" name="credential" value="<?php echo isset($_POST['credential']) ? htmlspecialchars($_POST['credential'], ENT_QUOTES) : ''; ?>" required autocomplete="credential" autofocus placeholder="Email">
                <input id="password" type="password" name="password" placeholder="Password" required />
                <button type="submit" name="login">LOGIN</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/web-lib/resources/js/app.js"></script>
</body>

</html>