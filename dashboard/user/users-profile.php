<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'user') {
  header('Location: ../../login.php');
  exit();
}
require_once __DIR__ . '/../../db_con/conn.php'; // Adjust the path if necessary

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT profile_picture, full_name, email, mobile_number, address FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users / Profile - Comembo Community Care</title>
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
        <a class="nav-link collapsed" href="../../dashboard/user/home.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../../dashboard/user/event_registration.php">
          <i class="bi bi-person-lines-fill"></i>
          <span>Event Registration</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../../dashboard/user/users-profile.php">
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
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../../dashboard/user/home.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

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

      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?php echo htmlspecialchars($user_data['profile_picture']); ?>" alt="Profile" class="rounded-circle">
              <h6><?php echo htmlspecialchars($user_data['full_name']); ?></h6>
              <span><?php echo htmlspecialchars($user_data['email']); ?></span>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <h6>Full Name: </h6>
                    <span><?php echo htmlspecialchars($user_data['full_name']); ?></span>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>
                  </div>

                  <div class="row">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <h6>Email: </h6>
                    <span><?php echo htmlspecialchars($user_data['email']); ?></span>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>
                  </div>

                  <div class="row">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <h6>Mobile Number: </h6>
                    <span><?php echo htmlspecialchars($user_data['mobile_number']); ?></span>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>
                  </div>

                  <div class="row">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <h6>Address: </h6>
                    <span><?php echo htmlspecialchars($user_data['address']); ?></span>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>
                  </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  
                  <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?php echo htmlspecialchars($user_data['profile_picture']); ?>"  alt="Profile" class="rounded-circle">
                          <div class="col-4 text-right">
                              <button type="button" class="btn btn-primary btn-sm" id="uploadButton"><i class="bi bi-upload"></i></button>
                              <form id="uploadForm" method="post" action="../../db_con/update_profile_picture_con_2.php" enctype="multipart/form-data" style="display: none;">
                                  <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*">
                              </form>
                          </div>
                      </div>
                    </div>

                    <form method="post" action="../../db_con/user_profile_con.php">
                    <div class="row mb-3">
                      <label for="Full_Name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="full_name" type="text" class="form-control" id="Full_Name" value="<?php echo htmlspecialchars($user_data['full_name']); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?php echo htmlspecialchars($user_data['email']); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Mobile Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo htmlspecialchars($user_data['mobile_number']); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?php echo htmlspecialchars($user_data['address']); ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post" action="../../db_con/user_change_password_con.php">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                      <input name="current_password" type="password" class="form-control" id="currentPassword" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                      <input name="confirm_password" type="password" class="form-control" id="renewPassword" required>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
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
  <script src=../../dashboard_assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../dashboard_assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../dashboard_assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../dashboard_assets/js/main.js"></script>

   <!-- Bootstrap JS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('uploadButton').addEventListener('click', function() {
            document.getElementById('profilePictureInput').click();
        });

        document.getElementById('profilePictureInput').addEventListener('change', function() {
            document.getElementById('uploadForm').submit();
        });
    </script>


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