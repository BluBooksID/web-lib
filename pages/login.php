<?php
session_start();
include '../db/koneksi.php'; // Pastikan path file koneksi.php sudah benar

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $credential = $_POST['credential'];
    $password = $_POST['password'];

    // Validasi input kosong
    if (empty($credential)) {
        $errors[] = "NIM atau email harus di isi.";
    }
    if (empty($password)) {
        $errors[] = "Password harus di isi.";
    }

    if (empty($errors)) {
        // Tentukan apakah login menggunakan NIM atau email untuk pengguna biasa
        if (filter_var($credential, FILTER_VALIDATE_EMAIL)) {
            $query_user = "SELECT id_pengguna, password, nama_pengguna FROM pengguna WHERE email = ?";
        } else {
            $query_user = "SELECT id_pengguna, password, nama_pengguna FROM pengguna WHERE NIM = ?";
        }

        // Prepare statement untuk pengguna biasa
        $stmt_user = $conn->prepare($query_user);
        if ($stmt_user) {
            // Bind parameter untuk pengguna biasa
            $stmt_user->bind_param("s", $credential);

            // Execute statement untuk pengguna biasa
            $stmt_user->execute();
            $stmt_user->store_result();

            // Check jika pengguna biasa ditemukan
            if ($stmt_user->num_rows > 0) {
                // Bind result variables untuk pengguna biasa
                $stmt_user->bind_result($id_pengguna, $hashed_password, $nama_pengguna);
                $stmt_user->fetch();

                // Verify password untuk pengguna biasa
                if (password_verify($password, $hashed_password)) {
                    // Set session variables untuk pengguna biasa
                    $_SESSION['id_pengguna'] = $id_pengguna;
                    $_SESSION['nama_pengguna'] = $nama_pengguna;

                    // Redirect ke dashboard pengguna
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $errors[] = "Password salah.";
                }
            } else {
                $errors[] = "NIM atau email tidak ditemukan.";
            }

            // Close statement untuk pengguna biasa
            $stmt_user->close();
        } else {
            $errors[] = "Query preparation error untuk pengguna: " . $conn->error;
        }

        // Tentukan apakah login menggunakan email untuk admin
        $query_admin = "SELECT id_admin, password, nama FROM admin WHERE email = ?";

        // Prepare statement untuk admin
        $stmt_admin = $conn->prepare($query_admin);
        if ($stmt_admin) {
            // Bind parameter untuk admin
            $stmt_admin->bind_param("s", $credential);

            // Execute statement untuk admin
            $stmt_admin->execute();
            $stmt_admin->store_result();

            // Check jika admin ditemukan
            if ($stmt_admin->num_rows > 0) {
                // Bind result variables untuk admin
                $stmt_admin->bind_result($id_admin, $hashed_password, $nama);
                $stmt_admin->fetch();

                // Verify password untuk admin
                if (password_verify($password, $hashed_password)) {
                    // Set session variables untuk admin
                    $_SESSION['id_admin'] = $id_admin;
                    $_SESSION['nama_admin'] = $nama;

                    // Redirect ke dashboard admin
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    $errors[] = "Password salah.";
                }
            } else {
                $errors[] = "Email tidak ditemukan.";
            }

            // Close statement untuk admin
            $stmt_admin->close();
        } else {
            $errors[] = "Query preparation error untuk admin: " . $conn->error;
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Login</title>
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
