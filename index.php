<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set karakter encoding dan viewport untuk responsif -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Awal php-backend -->
    <?php
    // Sisipkan file koneksi database
    include ("db/koneksi.php");
    ?>
    <!-- Akhir php-backend -->

    <!-- Awal navbar -->
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/web-lib/resources/asset/logo.svg" alt="Logo" width="150" height="35">
                </div>
                <div class="text-end">
                    <a href="pages/auth.php" class="btn btn-outline-light px-4 me-sm-3 fw-bold">Login / Register</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Akhir navbar -->

    <!-- Awal konten -->
    <div class="container col-xxl-8 px-4 py-1">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-3">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="/web-lib/resources/asset/library.svg"
                    class="d-none d-sm-block d-md-block mx-lg-auto img-fluid" alt="Images" width="400" height="300">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Membaca Semakin Mudah
                </h1>
                <p class="lead">Selamat datang di BluBooks, perpustakaan yang menawarkan beragam koleksi buku untuk
                    memenuhi berbagai minat baca Anda. Kami memiliki banyak koleksi buku yang dapat Anda jelajahi
                    dan
                    nikmati.</p>
            </div>
        </div>
    </div>
    <!-- Akhir konten -->

    <!-- Awal footer -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-body-secondary">© 2024 BluBooks</span>
            </div>
        </footer>
    </div>
    <!-- Akhir footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>