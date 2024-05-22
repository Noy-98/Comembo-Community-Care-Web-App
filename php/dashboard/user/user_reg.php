<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'user') {
  header('Location: ../../login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Registration - Dashboard</title>
  <link href="../../../assets/img/logo_icon.png" rel="icon">
  <link rel="stylesheet" href="../../../assets/css/dashboard.css" />
</head>

<body>
  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      </i>Comembo Community Care
    </div>
    <div class="search_bar">
      <input type="text" placeholder="Search" />
    </div>
    <div class="navbar_content">
      <i class="bi bi-grid"></i>
      <i class='bx bx-sun' id="darkLight"></i>
    </div>
  </nav>
  <!-- sidebar -->
  <nav class="sidebar">
    <div class="menu_content">
      <ul class="menu_items">
        <div class="menu_title menu_dahsboard"></div>
        <!-- duplicate or remove this li tag if you want to add or remove navlink with submenu -->
        <!-- start -->
        <li class="item">
          <a href="../../../php/dashboard/user/home.php" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bx-home-alt"></i>
            </span>
            <span class="navlink">Home</span>
          </a>
        </li>
        <!-- end -->
      </ul>
      <ul class="menu_items">
        <div class="menu_title menu_editor"></div>
        <!-- duplicate these li tag if you want to add or remove navlink only -->
        <li class="item">
          <a href="#" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bx-user-circle"></i>
            </span>
            <span class="navlink">Profile</span>
          </a>
        </li>
      </ul>
      <ul class="menu_items">
        <div class="menu_title menu_setting"></div>
        <li class="item">
          <a href="../../../db_con/logout_con.php" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bx-log-out"></i>
            </span>
            <span class="navlink">Logout</span>
          </a>
        </li>
      </ul>
      <!-- Sidebar Open / Close -->
      <div class="bottom_content">
        <div class="bottom expand_sidebar">
          <span> Expand</span>
          <i class='bx bx-right-arrow'></i>
        </div>
        <div class="bottom collapse_sidebar">
          <span> Collapse</span>
          <i class='bx bx-left-arrow'></i>
        </div>
      </div>
    </div>
  </nav>

  <!-- Section -->
  <section id="sec_announce">
    <div class="container">
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
      <form method="post" action="../../../db_con/event_reg_con.php">

        <label>Event Name</label>
        <input type="text" id="event_name" name="event_name" placeholder="Event Name..." required>

        <label>First Name</label>
        <input type="text" id="first_name" name="first_name" placeholder="First Name..." required>

        <label>Last Name</label>
        <input type="text" id="last_name" name="last_name" placeholder="Last Name..." required>

        <label>Email</label>
        <input type="text" id="email" name="email" placeholder="Email..." required>

        <label>Phone Number</label>
        <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number..." required>

        <label>Address</label>
        <input type="text" id="address" name="address" placeholder="Address..." required>

        <label>Age</label>
        <input type="text" id="age" name="age" placeholder="Age..." required>

        <label>Category</label>
        <select name="category" required>
          <option disabled="disabled" selected="selected">Choose Category</option>
          <option>Pukpok Palayok</option>
          <option>Kadang Kadang Relay</option>
          <option>Sipa</option>
          <option>Sack Race</option>
          <option>Ihip Harina</option>
          <option>5 Members</option>
          <option>10 Members</option>
          <option>Solo</option>
          <option>Duo</option>
          <option>Group</option>
        </select>

        <input type="submit" value="Submit">

      </form>
    </div>
  </section>

  <!-- JavaScript -->
  <script src="../../../assets/js/dashboard.js"></script>
</body>

</html>