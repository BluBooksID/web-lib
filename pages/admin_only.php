<?php
session_start();

// Define the correct password
define('KODE_AKSES', 'admin');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_password = $_POST['password'];

    if ($input_password === KODE_AKSES) {
        $_SESSION['akses_diberikan'] = true;
        header('Location: admin_register.php');
        exit();
    } else {
        $error = 'Kode Akses Salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Admin</title>
</head>

<body>
    <div>
        <h1>Masukan Kode Akses</h1>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST" action="">
            <div>
                <input type="password" name="password" required placeholder="Password">
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>

    </div>
    <a href="../index.php">kembali ke index</a>
</body>

</html>