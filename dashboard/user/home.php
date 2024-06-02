<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'user') {
  header('Location: ../../login.php');
  exit();
}
require_once __DIR__ . '/../../db_con/conn.php'; // Adjust the path if necessary

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT profile_picture, full_name, email FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
$stmt->close();

// Fetch events from the database
$sql_events = "SELECT * FROM event_barangay_post";
$stmt_events = $conn->prepare($sql_events);
$stmt_events->execute();
$result_events = $stmt_events->get_result();
$events = $result_events->fetch_all(MYSQLI_ASSOC);
$stmt_events->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Comembo Community Care</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/logo_icon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../dashboard_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../dashboard_assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../dashboard_assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../dashboard_assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../dashboard_assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../dashboard_assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../dashboard_assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../dashboard_assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="../../dashboard/user/home.php" class="logo d-flex align-items-center">
        <img src="../../assets/img/logo_icon.png" alt="">
        <span class="d-none d-lg-block">User Dashboard</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#" onsubmit="return false;">
        <input type="text" id="search-input" name="query" placeholder="Search" title="Enter search keyword" oninput="filterSearch()">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        <div id="search-results" class="search-results"></div>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo htmlspecialchars($user_data['profile_picture']); ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo htmlspecialchars($user_data['full_name']); ?></h6>
              <span><?php echo htmlspecialchars($user_data['email']); ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../../dashboard/user/users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../../db_con/logout_con.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="../../dashboard/user/home.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../../dashboard/user/event_registration.php">
          <i class="bi bi-person-lines-fill"></i>
          <span>Event Registration</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../../dashboard/user/users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../../db_con/logout_con.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../../dashboard/user/home.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="message">
        <!-- Validation message section -->
        <?php
        if (session_status() == PHP_SESSION_NONE) {
          session_start(); // Start the session if it hasn't started
        }

        // Display error messages
        if (isset($_SESSION['error'])) {
          echo '<div class="error_message">' . $_SESSION['error'] . '</div>';
          unset($_SESSION['error']); // Clear the error message
        }

        // Display success messages
        if (isset($_SESSION['success'])) {
          echo '<div class="success_message">' . $_SESSION['success'] . '</div>';
          unset($_SESSION['success']); // Clear the success message
        }
        ?>
      </div>
      <!-- News & Updates Traffic -->
      <div class="card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>

        <div class="card-body pb-0">
          <h5 class="card-title">Barangay &amp; Events <span>| Today</span></h5>

          <div class="news">
          <?php foreach ($events as $event): ?>
          <div class="post-item clearfix">
            <img src="<?php echo $event['image_upload']; ?>" alt="<?php echo $event['event_name']; ?>">
            <h4><a href="#"><?php echo $event['event_name']; ?></a></h4>
            <p>Date: <span><?php echo $event['date']; ?></span></p>
            <p>Time: <span><?php echo $event['time']; ?></span></p>
            <p>Subject: <span><?php echo $event['subject']; ?></span></p>
          </div>
        <?php endforeach; ?>

          </div><!-- End sidebar recent posts-->

        </div>
      </div><!-- End News & Updates -->
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Comembo Community Care</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../dashboard_assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../dashboard_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../dashboard_assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../dashboard_assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../dashboard_assets/vendor/quill/quill.js"></script>
  <script src="../../dashboard_assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../dashboard_assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../dashboard_assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../dashboard_assets/js/main.js"></script>

  <script>
    const sidebarItems = [
      { name: 'Dashboard', url: '../../dashboard/user/home.php' },
      { name: 'Event Registration', url: '../../dashboard/user/event_registration.php' },
      { name: 'Profile', url: '../../dashboard/user/users-profile.php' }
    ];

    function filterSearch() {
      const query = document.getElementById('search-input').value.toLowerCase();
      const resultsContainer = document.getElementById('search-results');
      resultsContainer.innerHTML = '';

      if (query) {
        const filteredItems = sidebarItems.filter(item => item.name.toLowerCase().includes(query));
        filteredItems.forEach(item => {
          const div = document.createElement('div');
          div.textContent = item.name;
          div.onclick = () => {
            window.location.href = item.url;
          };
          resultsContainer.appendChild(div);
        });
      }
    }
  </script>

</body>

</html>