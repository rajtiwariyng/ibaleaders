<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendor/css/animate.css" />
  <link rel="stylesheet" href="vendor/slick/slick.css">
  <link rel="stylesheet" href="vendor/slick/slick-theme.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>IBA</title>
</head>

<body>
  <main class="">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar home">
      <a href="home.html" class="d-flex align-items-center mb-3 me-md-auto text-white text-decoration-none">
        <span class="fs-4 side-logo"><img src="images/white-logo.png" alt=""></span>
      </a>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="home.html" class="nav-link active" aria-current="page">
            <img src="icons/Home.png" alt=""> Home
          </a>
        </li>
        <li>
          <a href="dashboard.html" class="nav-link text-white">
            <img src="icons/Dashboard.png" alt=""> Dashboard
          </a>
        </li>
        <li>
          <a href="alliance.html" class="nav-link text-white">
            <img src="icons/Alliance.png" alt=""> Alliance
          </a>
        </li>
        <li>
          <a href="reports.html" class="nav-link text-white">
            <img src="icons/report.png" alt=""> Report
          </a>
        </li>
        <li>
          <a href="about-us.html" class="nav-link text-white">
            <img src="icons/About-Us.png" alt=""> About us
          </a>
        </li>
      </ul>
    </div>
    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo ">
          <div class="logo-header">
            <a href="home.html" class="logo">
              <img src="images/white-logo.png" alt="navbar brand" class="navbar-brand" height="20">
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
        </div>
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg">
          <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <div class="input-group">
                <input type="text" placeholder="Search ..." class="form-control fs-7 border-0">
                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-search bg-blue">
                    <img src="icons/search.png" alt="">
                  </button>
                </div>
              </div>
            </nav>
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li>
                <div class="dropdown">
                  <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="icons/settings.png" alt="">
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">View Profile</a>
                    <a class="dropdown-item" href="reset-password.html">Reset Password</a>
                    <a class="dropdown-item" href="privacy-settings.html">Privacy Setting</a>
                    <a class="dropdown-item" href="#">Log Out</a>
                  </div>
                </div>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
                  <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                  <form class="navbar-left navbar-form nav-search">
                    <div class="input-group">
                      <input type="text" placeholder="Search ..." class="form-control">
                    </div>
                  </form>
                </ul>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link" href="notifications.html">
                  <img src="icons/ringing.png" alt="">
                  <span class="notification">4</span>
                </a>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret submenu">
                <a class="nav-link dropdown-toggle" href="chats.html">
                  <img src="icons/mesg.png" alt="">
                  <span class="notification">2</span>
                </a>
              </li>
              <li>
                <a href="#"><img src="icons/help.png" alt=""></a>
              </li>
              <li class="nav-item topbar-user dropdown hidden-caret">
                <div class="d-flex align-items-center">
                  <span class="profile-username">
                    <span class="fw-bold">Manish Juneja</span>
                    <p class="mb-0 fs-8">Real Estate consultant</p>
                  </span>
                  <div class="profile-container">
                    <img src="images/profile.jpg" alt="User Profile" class="profile-image" id="profileImage">
                    <label for="fileUpload" class="camera-icon">
                      <i class="fa-solid fa-camera"></i>
                    </label>
                    <input type="file" id="fileUpload" class="upload-input" accept="image/*" onchange="loadFile(event)">
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <div class="container">
        <div class="page-inner">
          <div class="whiteBox bg-white p-4">
             <div class="password-container">
                <div class="pw-box px-md-4">
                  <div class="logo pb-4">
                    <img src="images/logo.png" alt="">
                  </div>
                  <div class="pw-header">
                    <h5 class="blue poppins-bold">Please check your inbox</h5>
                    <p><small>We sent a confirmation link to you at <strong>youremail@domain.com</strong> Simply click on the link available in the email to confirm your account.</small></p>
                  </div>  
                  <form action="">
                    <div class="form-group">
                      <label for="email" class="blue pb-1">Verification Code*</label>
                      <input type="text" placeholder="XXXXXX" class="form-control">
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="sbmtBtn ms-0 mt-3">
                        <a href="reset-password.html" class="white">
                          <div class="cornerbox mt-2">
                            <div class="bg"></div>
                            <p class="mb-0">Submit</p>
                          </div>
                        </a>
                      </div>
                      <a href="otp.html" class="blue mt-3">Resend Code</a>
                    </div>
                    
                  </form>
                </div>
                <div class="pw-image">
                  <img src="images/pw-lock.png" alt="">
                </div>
             </div>
          </div>
          <div class="back-to-login">
            <p class="grey poppins-semibold pt-4 ps-5 fs-5">Back to <a href="#" class="blue">Login</a></p>
          </div>
        </div>
        <footer class="bg-blue px-4 py-3 mt-4">
          <div class="d-flex justify-content-between flex-wrap">
            <div class="text-white">
              <h4 class="text-white">Personal</h4>
              <h5>Profile</h5>
              <a href="#" class="text-white d-block pb-2">Signout</a>
              <p>Thursday, August 29 2024</p>
            </div>
            <div class="text-md-end text-white copyright">
              <p class="lh-lg">Copyright 2024 IBAL. All Rights Reserved. <br>
                BNIConnect: Release 2.22.0, Build: 2f5c4086  <br>
                Last Changed Date: 2024-07-18 08:20  </p>
               <ul class="d-flex"> 
                <li><a href="#">Terms of Use</a></li>
                <li>|</li>
                <li><a href="#">Privacy Policy</a></li>
                <li>|</li>
                <li><a href="#">Browser Policy</a></li>
               </ul>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </main>
  <!-- All scripts are here -->
  <script src="vendor/js/jquery.min.js"></script>
  <script src="vendor/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/slick/slick.min.js"></script>
  <script src="vendor/js/wow.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>