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
                    header("Location: admin/dashboard.php");
                    exit();
                } else {
                    $errors[] = "Password salah.";
                }
            } else

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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container-fluid py-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <!-- Register Form -->
                        <form class="register-form" method="POST" action="" style="display: none;">
                            <h2 class="text-center mb-4"><i class="fas fa-lock"></i> Register</h2>
                            <?php
                            if (!empty($errors)) {
                                foreach ($errors as $error) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            }
                            ?>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="NIM" name="NIM" placeholder="NIM *"
                                    required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna"
                                    placeholder="Nama Pengguna *" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat *"
                                    required>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="jenis_kelamin" required>
                                    <option value="" disabled selected>Jenis Kelamin *</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email *"
                                    required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password *" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password-confirm"
                                    name="password_confirmation" placeholder="Confirm Password *" required>
                            </div>
                            <button type="submit" name="register" class="btn btn-primary w-100">BUAT AKUN</button>
                            <p class="text-center mt-3">Sudah Daftar? <a href="#" class="toggle-form">Masuk</a></p>
                        </form>

                        <!-- Login Form -->
                        <form class="login-form" method="POST" action="">
                            <h2 class="text-center mb-4"><i class="fas fa-lock"></i> Login</h2>
                            <?php
                            if (!empty($errors)) {
                                foreach ($errors as $error) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            }
                            ?>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="credential" name="credential"
                                    value="<?php echo isset($_POST['credential']) ? htmlspecialchars($_POST['credential'], ENT_QUOTES) : ''; ?>"
                                    required autocomplete="credential" autofocus placeholder="NIM atau Email">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">LOGIN</button>
                            <p class="text-center mt-3">Belum Daftar? <a href="#" class="toggle-form">Buat Akun</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(document).ready(function () {
            $('.toggle-form').click(function (e) {
                e.preventDefault();
                $('.login-form, .register-form').toggle();
            });
        });
    </script>
</body>

</html>