<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
	  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'/>
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Home - Dashboard</title>
    <link href="../../../assets/img/logo_icon.png" rel="icon">
    <link rel="stylesheet" href="../../../assets/css/dashboard.css" />
    <link rel="stylesheet" href="../../../assets/css/section.css"/>
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
          <li class="item active">
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
            <a href="../../../php/login.php" class="nav_link">
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
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">
          <div class="d-flex flex-row row">
              <div class="col-sm-12 col-lg-4">
                  <div class="icon-box">
                      <div class="icon"><img src="../../../assets/img/blog1.jpg"/></div>
                      <h4><a href="https://www.facebook.com/photo/?fbid=122143414580137909&set=a.122103264464137909" target="_blank">𝙏𝘼𝙍𝘼 𝙉𝘼’𝙏 𝙈𝘼𝙆𝙄𝙎𝘼𝙔𝘼, 𝙈𝘼𝙆𝙄𝙇𝘼𝙃𝙊𝙆, 𝘼𝙏 𝙈𝘼𝙂-𝙀𝙉𝙅𝙊𝙔 𝙎𝘼 𝘼𝙏𝙄𝙉𝙂 𝙋𝘼𝙇𝘼𝙍𝙊𝙉𝙂 𝙋𝙄𝙉𝙊𝙔</a></h4>
                      <p>Ito ay isang espesyal na selebrasyon na hatid ng Sangguniang Kabataan - Comembo Council para sa ika-67 anibersaryo ng ating minamahal na Barangay. Ang aktibidad na ito ay walang sawang sinuportahan ng ating Inang Lungsod, Mayor Lani Cayetano.</p>
                      <a href="../../../php/dashboard/user/user_reg1.php" class="read-more"><span>Register?...</span><i class="bi bi-arrow-right"></i></a>
                  </div>
              </div>

              <div class="col-sm-12 col-lg-4">
                  <div class="icon-box">
                      <div class="icon"><img src="../../../assets/img/blog2.jpg"/></div>
                      <h4><a href="https://www.facebook.com/photo/?fbid=122141917880137909&set=a.122126271146137909" target="_blank">CALLING ALL FITNESS ENTHUSIASTS! 📣</a></h4>
                      <p>Open to ages 15 years old and above, living in Barangay Comembo. In the form of a group with 5 members minimum and 10 members maximum.</p>
                      <p>‼️ Per group, we allow at least 80% of your members to be from Barangay Comembo.</p>
                      <a href="../../../php/dashboard/user/user_reg2.php" class="read-more"><span>Register?...</span><i class="bi bi-arrow-right"></i></a>
                  </div>
              </div>

              <div class="col-sm-12 col-lg-4">
                  <div class="icon-box">
                    <div class="icon"><img src="../../../assets/img/blog3.jpg"/></div>
                      <h4><a href="https://www.facebook.com/photo/?fbid=122141669678137909&set=a.122126271146137909" target="_blank">SAYAW? KANTA? RAP? P’wedeng p’wede ka sumali kahit anong talento pa ‘yan! 🤗</a></h4>
                      <p>Sa mga interesado po na mag-audition, mangyari lang po ng pumunta sa Barangay Comembo, Mamancat Hall ngayong araw ng 1:00 PM.</p>
                      <p>Para sa inyong mga tugtog na gagamitin, mangyari lang po na pakidala ang inyong USB na naglalaman ng audio file.</p>
                      <a href="../../../php/dashboard/user/user_reg3.php" class="read-more"><span>Register?...</span><i class="bi bi-arrow-right"></i></a>
                  </div>
              </div>
          </div>

      </div>
  </section>
    <!-- JavaScript -->
    <script src="../../../assets/js/dashboard.js"></script>
  </body>
</html>