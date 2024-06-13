<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <?php

    include("db/koneksi.php");

    ?>

    <!-- awal navbar -->
    <div>
        <tr>
            <td>
                <a href="pages/login.php">login</a>
            </td>
            <td>
                <a href="pages/register.php">register</a>
            </td>
        </tr>
    </div>
    <!-- akhir navbar -->

</body>

</html>