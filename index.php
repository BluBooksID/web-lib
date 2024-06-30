<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set karakter encoding dan viewport untuk responsif -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    // Sisipkan file koneksi database
    include("db/koneksi.php");
    ?>
    <!-- Akhir php-backend -->


    <!-- Awal navbar untuk navigasi -->
    <div>
        <table>
            <tr>
                <td>
                    <a href="pages/auth.php">Login / Register</a>
                </td>
                <td>
                    <a href="pages/admin/admin_only.php">Admin Only</a>
                </td>
            </tr>
        </table>
    </div>
    <!-- Akhir navbar -->

</body>

</html>