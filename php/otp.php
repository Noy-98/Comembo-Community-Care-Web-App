<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Comembo Community Care</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/logo_icon.png" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>

  <header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="">barangaycomembo28@gmail.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>0917 144 0735</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="https://www.facebook.com/profile.php?id=61555165777821" class="facebook"><i
              class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-twitter"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="../index.html" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <img src="../assets/img/logo_icon.png" alt="">
          <h1 class="sitename">Comembo Community Care</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="../index.html#hero" class="">Home</a></li>
            <li><a href="../index.html#about">About</a></li>
            <li><a href="../index.html#services">Services</a></li>
            <li><a href="../index.html#team">Officials</a></li>
            <li><a href="../index.html#contact">Contact</a></li>
            <li class="dropdown"><a><span>Portal</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="../php/login.php">Login</a></li>
                <li><a href="../php/signup.php">Signup</a></li>
              </ul>
            </li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>

    </div>

  </header>

  <section id="login">
    <div class="center">
      <h1>OTP</h1>
      <!-- Validation message section -->
      <?php
      session_start(); // Start the session

      // Check if there are any error messages
      if (isset($_SESSION['error'])) {
        echo '<div class="error_message">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']); // Clear the error message
      }

      // Check if there are any success messages
      if (isset($_SESSION['success'])) {
        echo '<div class="success-message">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']); // Clear the success message
      }
      ?>
      <form method="post" action="../db_con/otp_con.php">
        <div class="txt_field">
          <input type="number" name="otp" required>
          <span></span>
          <label>Enter your OTP Code</label>
        </div>
        <input type="submit" value="Next">
        <div class="signup_link">
          Do you have Account? <a href="../php/login.php">Login</a>
        </div>
      </form>
    </div>
  </section>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6">
          <div class="footer-about">
            <a href="../index.html" class="logo sitename">
              <img src="../assets/img/logo_icon.png">
            </a>
            <div class="footer-contact pt-3">
              <p>Anahaw St., Comembo,</p>
              <p>1217. Taguig City</p>
              <p class="mt-3"><strong>Phone:</strong> <span>+8721 7971</span></p>
              <p><strong>Email:</strong> <span>barangaycomembo28@gmail.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href="https://www.facebook.com/profile.php?id=61555165777821"><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="../index.html#hero">Home</a></li>
            <li><a href="../index.html#about">About us</a></li>
            <li><a href="../index.html#services">Services</a></li>
            <li><a href="../index.html#team">Officials</a></li>
            <li><a href="../index.html#contact">Contact</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Caregiver</a></li>
            <li><a href="#">Transportation</a></li>
            <li><a href="#">Job for Hire</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Comembo Community Care</strong> <span>All Rights
          Reserved</span></p>
      <div class="credits">
        2024
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main.js"></script>
</body>

</html>