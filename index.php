<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Welcome to BluBooksID</title>
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
  <link href="resources/vendor/aos/aos.css" rel="stylesheet">
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
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">BluBooksID</h1>
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

      <img src="public/assets/images/hero-bg-abstract.jpg" alt="" data-aos="fade-in" class="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-out">
          <div class="col-xl-7 col-lg-9 text-center">
            <h2>Temukan buku impianmu dan pinjam dengan mudah di BluBooksID</h2>
            <p>BluBooksID hadir untuk memberikan kemudahan bagi para pecinta buku dalam menemukan dan meminjam buku favorit.
              Dengan koleksi yang beragam dan terus diperbarui, BluBooksID memastikan setiap pembaca dapat menemukan buku yang sesuai dengan minat.</p>
          </div>
        </div>
        <div class="text-center" data-aos="zoom-out" data-aos-delay="100">
          <a href="pages/login.php" class="btn-get-started">Ayo Mulai!</a>
        </div>

        <div class="row gy-4 mt-5">
          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-arrow-repeat"></i></div>
              <h4 class="title"><a href="">Mudah dan Cepat</a></h4>
              <p class="description">Proses peminjaman buku di BluBooksID sangat mudah dan cepat. Cukup beberapa klik untuk memilih dan meminjam buku favorit Anda.</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-book-half"></i></div>
              <h4 class="title"><a href="">Koleksi Beragam</a></h4>
              <p class="description">BluBooksID menawarkan koleksi buku yang luas dan beragam, dari berbagai genre dan kategori, untuk memenuhi minat bacaan semua pengguna.</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-clock-fill"></i></div>
              <h4 class="title"><a href="">Akses Kapan Saja</a></h4>
              <p class="description">Pinjam buku kapan saja dan di mana saja dengan platform online kami yang tersedia 24/7.</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-stars"></i></div>
              <h4 class="title"><a href="">Buku Berkualitas</a></h4>
              <p class="description">Semua buku yang tersedia di BluBooksID dipilih dengan cermat untuk memastikan kualitas dan kepuasan peminjam.</p>
            </div>
          </div><!--End Icon Box -->

        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Buku Populer</h2>
        <p>Terdapat buku-buku populer dari koleksi kami yang beragam.</p>
      </div>

      <div class="container">
        <div class="row gy-4 mt-5">
          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="100">
            <div class="mini-box">
              <img src="public/assets/images/atomic-habits.png" alt="Atomic Habits" class="img-fluid">
              <p class="author">James Clear</p>
              <h4 class="title">Atomic Habits: Perubahan Kecil yang Memberikan Hasil Luar Biasa Edisi Hardcover</h4>
            </div>
          </div><!--End mini Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="200">
            <div class="mini-box">
              <img src="public/assets/images/Monster.jpg" alt="Monsters" class="img-fluid">
              <p class="author">NAOKI URASAWA</p>
              <h4 class="title">Akasha : Monster 2</h4>
            </div>
          </div><!--End mini Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="300">
            <div class="mini-box">
              <img src="public/assets/images/komi.jpg" alt="Komi" class="img-fluid">
              <p class="author">Tomohito Oda</p>
              <h4 class="title">Komi Sulit Berkomunikasi 18</h4>
            </div>
          </div><!--End mini Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="400">
            <div class="mini-box">
              <img src="public/assets/images/keigo.jpg" alt="Keigo" class="img-fluid">
              <p class="author">Keigo Higashino</p>
              <h4 class="title">Rumus Kebenaran Musim Panas: A Midsummer`s Equation (Manatsu no Hoteishiki)</h4>
            </div>
          </div><!--End mini Box -->
        </div>
      </div>
    </section><!-- /About Section -->


    <!-- Kategori Buku Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kategori Buku</h2>
        <p>Temukan berbagai kategori buku yang tersedia untuk memenuhi semua minat dan kebutuhan membaca Anda.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div id="kategoriCarousel" class="carousel slide" data-bs-ride="carousel">

          <div class="carousel-inner">

            <!-- Carousel Item 1 -->
            <div class="carousel-item active">
              <div class="row gy-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                  <div class="service-item item-cyan position-relative">
                    <div class="icon">
                      <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                      </svg>
                      <i class="bi bi-activity"></i>
                    </div>
                    <h3>Fiksi</h3>
                    <p>Buku-buku yang membawa imajinasi tanpa batas dan cerita yang mendebarkan.</p>
                  </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                  <div class="service-item item-orange position-relative">
                    <div class="icon">
                      <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                      </svg>
                      <i class="bi bi-broadcast"></i>
                    </div>
                    <h3>Non-fiksi</h3>
                    <p>Buku-buku dengan pengetahuan dan informasi yang berharga untuk meningkatkan pemahaman Anda.</p>
                  </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                  <div class="service-item item-teal position-relative">
                    <div class="icon">
                      <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                      </svg>
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
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                  <div class="service-item item-red position-relative">
                    <div class="icon">
                      <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,503.46388370962813C374.79870501325706,506.71871716319447,464.8034551963731,527.1746412648533,510.4981551193396,467.86667711651364C555.9287308511215,408.9015244558933,512.6030010748507,327.5744911775523,490.211057578863,256.5855673507754C471.097692560561,195.9906835881958,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C326.66090330228417,83.56013727371605,265.50278462259654,122.79126021842126,205.59402678444342,154.97941800540476C142.04162070785543,191.6656085001917,108.32599866398365,252.3157124727524,82.841026647081,316.3448947031311C53.8161597415335,392.3565360804306,16.34595650760364,476.56938371761585,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                      </svg>
                      <i class="bi bi-book-half"></i>
                    </div>
                    <h3>Seni dan Desain</h3>
                    <p>Buku-buku yang mengilhami dan memperkaya kehidupan Anda dengan kreativitas seni dan desain.</p>
                  </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                  <div class="service-item item-purple position-relative">
                    <div class="icon">
                      <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,493.25545850378915C375.06961789113727,496.8349605523867,479.8736841581634,548.3450877840088,502.5850820975895,461.55621195738473C528.3932143170296,372.3079286216748,473.57363656557914,321.11408992330096,429.4763091881971,236.2795303875473C385.8272386344426,153.58283903870893,355.51242006132774,88.23411342668382,285.23083089123716,74.36733574560294C213.57545839538843,59.22842948689948,123.47431976706788,122.63693166981596,114.4419427279849,191.1120519032119C105.7863990298783,255.74458672387745,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                      </svg>
                      <i class="bi bi-book"></i>
                    </div>
                    <h3>Biografi</h3>
                    <p>Buku-buku yang mengungkapkan cerita hidup dan pencapaian inspiratif tokoh-tokoh dunia.</p>
                  </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                  <div class="service-item item-yellow position-relative">
                    <div class="icon">
                      <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,490.75509408904666C380.0298753682071,494.79867722095067,469.62848776518725,525.897283158536,514.5527098690853,464.4510019706397C561.1968245182595,399.74750332451715,493.2567452191103,306.3465051484789,471.8541818980436,244.2017183337307C451.42642100191474,185.13050542313635,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C326.66090330228417,83.56013727371605,261.73787243898436,116.87084272165935,197.44276105268097,155.8839757606186C129.0115653226545,198.1766535323963,96.39223231211245,254.24838075167917,82.841026647081,316.3448947031311C53.8161597415335,392.3565360804306,16.34595650760364,476.56938371761585,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                      </svg>
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
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimoni Pengguna</h2>
        <p>Baca pengalaman langsung dari para pengguna BluBooksID yang telah menemukan buku-buku favorit mereka. Temukan mengapa BluBooksID menjadi pilihan utama untuk memenuhi kebutuhan membaca Anda.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item" "="">
            <p>
              <i class=" bi bi-quote quote-icon-left"></i>
                <span>BluBooksID adalah platform yang sangat membantu saya dalam menemukan buku-buku favorit dengan mudah. Saya senang dengan koleksi yang mereka tawarkan!</span>
                <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="public/assets/images/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Rangga Sanjaya</h3>
                <h4>Dekan</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Pelayanan dari BluBooksID luar biasa. Buku yang saya pinjam selalu dalam kondisi baik dan proses pengembalian sangat lancar. Terima kasih!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="public/assets/images/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Toni Arifin</h3>
                <h4>Dosen</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Saya sangat suka dengan variasi buku di BluBooksID. Dari buku pelajaran hingga novel terbaru, semuanya ada di sini!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="public/assets/images/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Sari Susanti</h3>
                <h4>Dosen</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Sebagai pembaca berat, BluBooksID adalah tempat yang sempurna untuk memenuhi kebutuhan bacaan saya. Saya sudah merekomendasikan ke teman-teman!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="public/assets/images/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Ricky Firmansyah</h3>
                <h4>Dosen</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Saya senang dengan kemudahan akses dan ketersediaan buku-buku terbaru di BluBooksID. Layanan mereka sungguh memuaskan!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="public/assets/images/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>Hendi Suhendi</h3>
                <h4>Dosen</h4>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->




    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
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
      <div class="container section-title" data-aos="fade-up">
        <h2>Anggota Kelompok 9</h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="public\assets\images\team\team-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Aliffian Cahya</h4>
                <span>NIM - 17223021</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="public/assets/images/team/team-2.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Aria Zufar Shada</h4>
                <span>NIM - 17221013</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="public/assets/images/team/team-3.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Indra Dwi Septianto</h4>
                <span>NIM - 17221034</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="public/assets/images/team/team-4.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Asep Saepul Rohman</h4>
                <span>NIM - 17221029</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
            <div class="team-member">
              <div class="member-img">
                <img src="public/assets/images/team/team-5.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Wiguna Surya Syahputra</h4>
                <span>NIM - 17221033</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="600">
            <div class="team-member">
              <div class="member-img">
                <img src="public/assets/images/team/team-6.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
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

      <div class="footer-top">
        <div class="container">
          <div class="row">

            <div class="col-lg-3 col-md-6 footer-contact">
              <h3>BluBooksID</h3>
              <p>
                <a href="https://www.google.com/maps/place/ARS+University/@-6.9104962,107.6499176,17z/data=!3m1!4b1!4m6!3m5!1s0x2e68e7eb9456ae97:0x9fd67cfa593e7dc9!8m2!3d-6.9104962!4d107.6499176!16s%2Fg%2F1ptxxdtq9?entry=ttu" target="_blank">
                  Jalan Sekolah Internasional No.1-2 Antapani, <br>
                  Bandung - Jawa Barat,40282<br>
                  Indonesia
                </a>
                <br><br>
                <strong>Phone:</strong> +1 5589 55488 55<br>
                <strong>Email:</strong> blubooks@ars.id<br>
              </p>

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
          &copy; Copyright <strong><span>BluBooksID</span></strong>. All Rights Reserved
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
    <script src="resources/vendor/php-email-form/validate.js"></script>
    <script src="resources/vendor/aos/aos.js"></script>
    <script src="resources/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="resources/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="resources/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="resources/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="resources/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="resources/js/index.js"></script>

</body>

</html>