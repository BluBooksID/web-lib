<?php
session_start();
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BluBooks</title>
</head>

<body>
    <!-- awal navbar -->
    <div>
        <tr>
            <td>
                <a href="">buku</a>
            </td>
            <td>
                <a href="">pinjaman</a>
            </td>
            <td>
                <a href="logout.php">logout</a>
            </td>
        </tr>
    </div>
    <!-- akhir navbar -->
    <h1>Halo, <?php echo htmlspecialchars($_SESSION['nama_pengguna'], ENT_QUOTES); ?></h1>
    <p>Ini adalah dashboard user.</p>
</body>

</html>