<?php
session_start();
if (!isset($_SESSION['id_admin']) || !isset($_SESSION['nama_admin'])) {
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
                <a href="data_buku.php">data buku</a>
            </td>
            <td>
                <a href="">data pinjaman</a>
            </td>
            <td>
                <a href="logout.php">logout</a>
            </td>
        </tr>
    </div>
    <!-- akhir navbar -->
    <h1>Halo, <?php echo htmlspecialchars($_SESSION['nama_admin'], ENT_QUOTES); ?></h1>
    <p>Ini adalah dashboard.</p>
</body>

</html>
