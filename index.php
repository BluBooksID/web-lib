<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Welcome to BluBooks</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="public/assets/images/favicon.png" rel="icon">


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="resources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="resources/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="resources/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="resources/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="resources/css/index.css" rel="stylesheet">


</head>
<?php
// Sisipkan file koneksi database
include("db/koneksi.php");
?>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="#hero" class="logo d-flex align-items-center me-auto">
        <img src="public/assets/images/logo.png" alt="BluBooks">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">Konten</a></li>
          <li><a href="#testimonials">Testimoni</a></li>
          <li><a href="#team">Tim Kami</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="pages/login.php">Login</a>
      <a class="btn btn-secondary" href="pages/admin/admin_only.php">Admin Only</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <img src="public/assets/images/index_background.jpg" alt="" class="">

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 col-lg-9 text-center">
            <h2>Temukan buku impianmu dan pinjam dengan mudah di BluBooks</h2>
            <p>BluBooks hadir untuk memberikan kemudahan bagi para pecinta buku dalam menemukan dan meminjam buku favorit.
              Dengan koleksi yang beragam dan terus diperbarui, BluBooks memastikan setiap pembaca dapat menemukan buku yang sesuai dengan minat.</p>
          </div>
        </div>
        <div class="text-center">
          <a href="pages/login.php" class="btn-get-started">Ayo Mulai!</a>
        </div>

        <div class="row gy-4 mt-5">
          <div class="col-md-6 col-lg-3">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-arrow-repeat"></i></div>
              <h4 class="title"><a href="">Mudah dan Cepat</a></h4>
              <p class="description">Proses peminjaman buku di BluBooks sangat mudah dan cepat. Cukup beberapa klik untuk memilih dan meminjam buku favorit Anda.</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-book-half"></i></div>
              <h4 class="title"><a href="">Koleksi Beragam</a></h4>
              <p class="description">BluBooks menawarkan koleksi buku yang luas dan beragam, dari berbagai genre dan kategori, untuk memenuhi minat bacaan semua pengguna.</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-clock-fill"></i></div>
              <h4 class="title"><a href="">Akses Kapan Saja</a></h4>
              <p class="description">Pinjam buku kapan saja dan di mana saja dengan platform online kami yang tersedia 24/7.</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-stars"></i></div>
              <h4 class="title"><a href="">Buku Berkualitas</a></h4>
              <p class="description">Semua buku yang tersedia di BluBooks dipilih dengan cermat untuk memastikan kualitas dan kepuasan peminjam.</p>
            </div>
        </div>
    </header>
    <!-- Akhir navbar -->

    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container section-title">
        <h2>Buku Populer</h2>
        <p>Terdapat buku-buku populer dari koleksi kami yang beragam.</p>
      </div>

      <div class="container">
        <div class="row gy-4 mt-5">
          <div class="col-md-6 col-lg-3">
            <div class="mini-box">
              <img src="public/assets/images/atomic-habits.png" alt="Atomic Habits" class="img-fluid">
              <p class="author">James Clear</p>
              <h4 class="title">Atomic Habits: Perubahan Kecil yang Memberikan Hasil Luar Biasa Edisi Hardcover</h4>
            </div>
          </div><!--End mini Box -->

          <div class="col-md-6 col-lg-3">
            <div class="mini-box">
              <img src="public/assets/images/Monster.jpg" alt="Monsters" class="img-fluid">
              <p class="author">NAOKI URASAWA</p>
              <h4 class="title">Akasha : Monster 2</h4>
            </div>
          </div><!--End mini Box -->

          <div class="col-md-6 col-lg-3">
            <div class="mini-box">
              <img src="public/assets/images/komi.jpg" alt="Komi" class="img-fluid">
              <p class="author">Tomohito Oda</p>
              <h4 class="title">Komi Sulit Berkomunikasi 18</h4>
            </div>
          </div><!--End mini Box -->

          <div class="col-md-6 col-lg-3">
            <div class="mini-box">
              <img src="public/assets/images/keigo.jpg" alt="Keigo" class="img-fluid">
              <p class="author">Keigo Higashino</p>
              <h4 class="title">Rumus Kebenaran Musim Panas: A Midsummer`s Equation (Manatsu no Hoteishiki)</h4>
            </div>
        </div>
    </div>
    <!-- Akhir konten -->

    <!-- Kategori Buku Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>Kategori Buku</h2>
        <p>Temukan berbagai kategori buku yang tersedia untuk memenuhi semua minat dan kebutuhan membaca Anda.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div id="kategoriCarousel" class="carousel slide" data-bs-ride="carousel">

          <div class="carousel-inner">

            <!-- Carousel Item 1 -->
            <div class="carousel-item active">
              <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                  <div class="service-item item-cyan position-relative">
                    <div class="icon">
                      <i class="bi bi-activity"></i>
                    </div>
                    <h3>Fiksi</h3>
                    <p>Buku-buku yang membawa imajinasi tanpa batas dan cerita yang mendebarkan.</p>
                  </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6">
                  <div class="service-item item-orange position-relative">
                    <div class="icon">
                      <i class="bi bi-broadcast"></i>
                    </div>
                    <h3>Non-fiksi</h3>
                    <p>Buku-buku dengan pengetahuan dan informasi yang berharga untuk meningkatkan pemahaman Anda.</p>
                  </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6">
                  <div class="service-item item-teal position-relative">
                    <div class="icon">
                      <i class="bi bi-easel"></i>
                    </div>
                    <h3>Sains dan Teknologi</h3>
                    <p>Buku-buku yang mengungkapkan misteri sains dan teknologi modern untuk memenuhi rasa ingin tahu Anda.</p>
                  </div>
                </div><!-- End Service Item -->
              </div>
            </div><!-- End Carousel Item 1 -->

            <!-- Carousel Item 2 -->
            <div class="carousel-item">
              <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                  <div class="service-item item-red position-relative">
                    <div class="icon">
                      <i class="bi bi-book-half"></i>
                    </div>
                    <h3>Seni dan Desain</h3>
                    <p>Buku-buku yang mengilhami dan memperkaya kehidupan Anda dengan kreativitas seni dan desain.</p>
                  </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6">
                  <div class="service-item item-purple position-relative">
                    <div class="icon">
                      <i class="bi bi-book"></i>
                    </div>
                    <h3>Biografi</h3>
                    <p>Buku-buku yang mengungkapkan cerita hidup dan pencapaian inspiratif tokoh-tokoh dunia.</p>
                  </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6">
                  <div class="service-item item-yellow position-relative">
                    <div class="icon">
                      <i class="bi bi-journal-richtext"></i>
                    </div>
                    <h3>Sejarah</h3>
                    <p>Buku-buku yang mengungkap peristiwa dan tokoh-tokoh penting dari masa lampau untuk memahami asal-usul kita.</p>
                  </div>
                </div><!-- End Service Item -->
              </div>
            </div><!-- End Carousel Item 2 -->

          </div><!-- End Carousel Inner -->

          <!-- Carousel Navigation -->
          <button class="carousel-control-prev" type="button" data-bs-target="#kategoriCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#kategoriCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button><!-- End Carousel Navigation -->

        </div><!-- End Carousel -->

    </section><!-- End Services Section -->



    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>Testimoni Pengguna</h2>
        <p>Baca pengalaman langsung dari para pengguna BluBooks yang telah menemukan buku-buku favorit mereka. Temukan mengapa BluBooks menjadi pilihan utama untuk memenuhi kebutuhan membaca Anda.</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>BluBooks adalah platform yang sangat membantu saya dalam menemukan buku-buku favorit dengan mudah. Saya senang dengan koleksi yang mereka tawarkan!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="public/assets/images/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Rangga Sanjaya</h3>
                <h4>Dekan</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="carousel-item">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Pelayanan dari BluBooks luar biasa. Buku yang saya pinjam selalu dalam kondisi baik dan proses pengembalian sangat lancar. Terima kasih!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="public/assets/images/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Toni Arifin</h3>
                <h4>Dosen</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="carousel-item">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Saya sangat suka dengan variasi buku di BluBooks. Dari buku pelajaran hingga novel terbaru, semuanya ada di sini!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="public/assets/images/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Sari Susanti</h3>
                <h4>Dosen</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="carousel-item">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Sebagai pembaca berat, BluBooks adalah tempat yang sempurna untuk memenuhi kebutuhan bacaan saya. Saya sudah merekomendasikan ke teman-teman!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="public/assets/images/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Ricky Firmansyah</h3>
                <h4>Dosen</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="carousel-item">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Saya senang dengan kemudahan akses dan ketersediaan buku-buku terbaru di BluBooks. Layanan mereka sungguh memuaskan!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="public/assets/images/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>Hendi Suhendi</h3>
                <h4>Dosen</h4>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

    </section><!-- /Testimonials Section -->





    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Temukan Dunia Buku Kami yang Luas!</h3>
              <p>Jelajahi lebih jauh koleksi buku kami yang beragam dan temukan buku-buku terbaik untuk Anda.</p>
              <a class="cta-btn" href="pages/login.php">Jelajahi Lebih Lanjut</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->


    <!-- Team Section -->
    <section id="team" class="team section light-background">
      <!-- Section Title -->
      <div class="container section-title">
        <h2>Anggota Kelompok 9</h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="team-member">
              <div class="member-img">
                <img src="public\assets\images\team\team-1.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Aliffian Cahya</h4>
                <span>NIM - 17223021</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="team-member">
              <div class="member-img">
                <img src="public/assets/images/team/team-2.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Aria Zufar Shada</h4>
                <span>NIM - 17221013</span>
              </div>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="team-member">
              <div class="member-img">
                <img src="public/assets/images/team/team-3.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Indra Dwi Septianto</h4>
                <span>NIM - 17221034</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="team-member">
              <div class="member-img">
                <img src="public/assets/images/team/team-4.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Asep Saepul Rohman</h4>
                <span>NIM - 17221029</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="team-member">
              <div class="member-img">
                <img src="public/assets/images/team/team-5.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Wiguna Surya Syahputra</h4>
                <span>NIM - 17221033</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="team-member">
              <div class="member-img">
                <img src="public/assets/images/team/team-6.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>M Aziz Nur Iman</h4>
                <span>NIM - 17221019</span>
              </div>
            </div>
          </div><!-- End Team Member -->
        </div>
      </div>
    </section><!-- /Team Section -->



    <footer id="footer">

      <div class="footer-newsletter">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <h4>Kejutan spesial dari kami hanya untukmu</h4>
              <form action="" method="post">
                <input type="email" placeholder="Masukkan email anda disini" name="email"><input type="submit" value="Daftar">
              </form>
            </div>
          </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengarahkan pengguna ke halaman login
        function redirectToLogin() {
            window.location.href = 'pages/auth.php';
        }
    </script>

    <!-- Akhir konten -->

    <!-- Awal footer -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-body-secondary">© 2024 BluBooks</span>
            </div>

            <div class="col-lg-6 col-md-6 footer-links">
              <h4>Navigasi</h4>
              <ul>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Syarat dan Ketentuan</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Kebijakan Privasi</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Tentang Kami</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Komunitas</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Sosial Media Kami</h4>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i>
                  <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                  <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
                  <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="container py-4">
        <div class="copyright">
          &copy; Copyright <strong><span>BluBooks</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          Kelompok 9 - Ti.4A</a>
        </div>
      </div>
    </footer><!-- End Footer -->

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



    <!-- Vendor JS Files -->
    <script src="resources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="resources/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="resources/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="resources/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="resources/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="resources/js/index.js"></script>

</body>

</html>