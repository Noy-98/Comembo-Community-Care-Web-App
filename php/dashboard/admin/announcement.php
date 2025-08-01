<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
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
    <title>Announcement - Admin Dashboard</title>
    <link href="../../../assets/img/logo_icon.png" rel="icon">
    <link rel="stylesheet" href="../../../assets/css/dashboard.css" />
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        </i>Admin Dashboard
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
            <a href="../../../php/dashboard/admin/home.php" class="nav_link">
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
          <li class="item active">
            <a href="../../../php/dashboard/admin/announcement.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-info-circle"></i>
              </span>
              <span class="navlink">Announcement</span>
            </a>
          </li>
          <li class="item">
            <a href="../../../php/dashboard/admin/event_reg.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-clipboard"></i>
              </span>
              <span class="navlink">Event Registration</span>
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
            <i class='bx bx-right-arrow' ></i>
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
            <form action="action_page.php">
          
              <label>Title</label>
              <input type="text" id="fname" name="firstname" placeholder="Announcement Title..">
          
              <label>Date</label>
              <input type="text" id="lname" name="lastname" placeholder="Announcement Date..">

              <label>Time</label>
              <input type="text" id="lname" name="lastname" placeholder="Announcement Time..">
          
              <label>Subject</label>
              <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
          
              <input type="submit" value="Add Picture/Video">
              <input type="submit" value="Submit">
          
            </form>
          </div>
    </section>

    <!-- JavaScript -->
    <script src="../../../assets/js/dashboard.js"></script>
  </body>
</html>