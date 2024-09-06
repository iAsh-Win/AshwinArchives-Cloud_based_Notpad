<?php
// Ensure session is started at the very beginning of the script
session_start();
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  // Unset all session variables
  $_SESSION = array();

  // If using cookies to store the session ID, delete the cookie
  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
  }

  // Destroy the session
  session_destroy();

  // Redirect to login or home page
  header("Location: ./"); // Change 'login.php' to your login or home page
  exit();
}
// Your script logic goes here
// For example:
if (isset($_SESSION['user'])) {
  $username = htmlspecialchars($_SESSION['user']['username']);
  $shortUsername = substr($username, 0, 5);
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>AshwinArchives</title>
    <meta
      content="AshwinArchives is a platform for creating, managing, and organizing your personal notes and ideas. Discover powerful tools to keep your thoughts and projects well-organized."
      name="description">
    <meta content="notes, personal notes, note-taking, organization, productivity, AshwinArchives" name="keywords">
    <meta content="AshwinArchives" name="author">
    <meta property="og:title" content="AshwinArchives">
    <meta property="og:description"
      content="AshwinArchives is a platform for creating, managing, and organizing your personal notes and ideas. Discover powerful tools to keep your thoughts and projects well-organized.">
    <meta property="og:image" content="URL_TO_IMAGE"> <!-- Replace with the URL of your preview image -->
    <meta property="og:url" content="URL_TO_PAGE"> <!-- Replace with the actual URL of the page -->
    <meta property="og:type" content="website">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="AshwinArchives">
    <meta property="twitter:description"
      content="AshwinArchives is a platform for creating, managing, and organizing your personal notes and ideas. Discover powerful tools to keep your thoughts and projects well-organized.">
    <meta property="twitter:image" content="URL_TO_IMAGE"> <!-- 

    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">

    <!-- Vendor CSS Files -->

    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

  </head>

  <body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">AshwinArchives</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Home<br></a></li>
            <li><a href="mynotes">Notes</a></li>
            <li><a id="changePasswordBtn" class="active" style="cursor:pointer;">Change Password</a></li>
            <li><a id="logout-btn" class="active" style="cursor:pointer;">Logout</a></li>


          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <p class="btn-getstarted">
          <?php // Extract the first 5 characters
            echo "Hello, " . $shortUsername;
            ?>
        </p>

      </div>
    </header>

    <main class="main">


      <section id="hero" class="hero section">

        <img src="assets/img/hero-bg-abstract.jpg" alt="" data-aos="fade-in" class="aos-init aos-animate">

        <div class="container">
          <div class="row justify-content-center aos-init aos-animate" data-aos="zoom-out">
            <div class="col-xl-7 col-lg-9 text-center">
              <h1>Make your own Archives</h1>
              <p>Store, Create and Manage your Educational Archives !</p>
            </div>
          </div>
          <div class="text-center aos-init aos-animate" data-aos="zoom-out" data-aos-delay="100">
            <a href="mynotes" class="btn-get-started">Create Note Now!</a>
          </div>

          <div class="row gy-4 mt-5">
            <div class="col-md-6 col-lg-3 aos-init aos-animate" data-aos="zoom-out" data-aos-delay="100">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-file-earmark-text"></i></div>
                <h4 class="title"><a href="">Organize Notes</a></h4>
                <p class="description">Easily categorize and manage your educational notes with intuitive tools, ensuring
                  your information is well-organized and quickly accessible.</p>
              </div>
            </div><!--End Icon Box -->

            <div class="col-md-6 col-lg-3 aos-init aos-animate" data-aos="zoom-out" data-aos-delay="200">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-shield-check"></i></div>
                <h4 class="title"><a href="">Secure Storage</a></h4>
                <p class="description">Keep your educational notes safe with our robust security features, protecting your
                  data from unauthorized access and ensuring privacy.</p>
              </div>
            </div><!--End Icon Box -->

            <div class="col-md-6 col-lg-3 aos-init aos-animate" data-aos="zoom-out" data-aos-delay="300">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-cloud-upload"></i></div>
                <h4 class="title"><a href="">Cloud Access</a></h4>
                <p class="description">Access your notes from anywhere with our secure cloud storage, providing the
                  flexibility to study and manage your material on the go.</p>
              </div>
            </div><!--End Icon Box -->

            <div class="col-md-6 col-lg-3 aos-init aos-animate" data-aos="zoom-out" data-aos-delay="400">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-share"></i></div>
                <h4 class="title"><a href="">Collaborate Easily</a></h4>
                <p class="description">Share and collaborate on notes with classmates or colleagues effortlessly, making
                  group study and project work seamless and efficient.</p>
              </div>
            </div><!--End Icon Box -->
          </div>

        </div>
        </div>

      </section>

    </main>
    <footer id="footer" class="footer light-background mt-5">
      <div class="container footer-top">
        <div class="row gy-4">
          <div class="col-lg-7 col-md-12 footer-about">
            <a href="home" class="logo d-flex align-items-center" target="_blank">
              <span class="sitename">AshwinArchives</span>
            </a>
            <p>Welcome to AshwinArchives, your premier solution for efficient document management. Easily organize,
              access, and secure your important records from any device. Experience a user-friendly interface designed to
              simplify your workflow and keep your information at your fingertips.</p>
            <div class="social-links d-flex mt-4">
              <a href="https://x.com/iAshwinSolanki" target="_blank"><i class="bi bi-twitter-x"></i></a>
              <a href="https://www.instagram.com/iAshwinSolanki/" target="_blank"><i class="bi bi-instagram"></i></a>
              <a href="https://www.linkedin.com/in/iAshwinSolanki/" target="_blank"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="container copyright text-center mt-4">
        <p>©<span> Copyrights <span id="current-year"></span></span> <strong class="px-1 sitename">AshwinArchives</strong>
          <span>All Rights Reserved</span>
        </p>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          Developed by Ashwin Solanki
        </div>
      </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
    <script>
      // Function to fetch user data
      async function getUserData(userId) {
        // Show the preloader
        showPreloader();

        try {
          // Construct the URL with query parameters directly within the fetch call
          const response = await fetch(`phpScript.php?id=${encodeURIComponent(userId)}&action=getUser`);

          // Check if the response is okay (status in the range 200-299)
          if (response.ok) {
            // Parse the JSON response
            const data = await response.json();

            // Check if the response data status is true
            if (!data.status) {
              // Process the data (e.g., display it or use it in your application)
              window.location.href = 'index';
              // Redirect to index.php if the status is false

            }

          } else {
            // Redirect to index.php if the HTTP status is not in the range 200-299
            window.location.href = 'index';
          }
        } catch (error) {
          // Handle network or other errors
          console.error('Fetch error:', error);
          // Redirect to index.php in case of error
          window.location.href = 'index';
        } finally {
          // Hide the preloader
          hidePreloader();
        }
      }

      // Function to show preloader
      function showPreloader() {
        if (!document.getElementById('preloader')) {
          const preloader = document.createElement('div');
          preloader.id = 'preloader';
          document.body.appendChild(preloader);
        }
      }

      // Function to hide preloader
      function hidePreloader() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
          document.body.removeChild(preloader);
        }
      }

      // Example usage: Replace '123' with the actual user ID you want to fetch
      // Assuming the PHP variable `$username` is safely rendered into the page
      document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('logout-btn').addEventListener('click', function () {
          // Perform logout by redirecting to the same page with a logout action
          window.location.href = '?action=logout'; // Appends ?action=logout to the URL
        });
        const yearSpan = document.getElementById('current-year');
        const currentYear = new Date().getFullYear();
        yearSpan.textContent = currentYear;

        const userId = '<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>';
        getUserData(userId);

        const changePasswordBtn = document.getElementById('changePasswordBtn');

        changePasswordBtn.addEventListener('click', () => {
          const newPassword = prompt('Enter your new password:');

          // Validate input
          if (newPassword === null || newPassword.trim() === '') {
            alert('Password cannot be empty.');
            return;
          }

          // Prepare data
          const data = {
            newPassword: String(newPassword.trim())
          };

          // Make the API request to change the password
          fetch(`phpScript.php?id=${userId}`, {
            method: 'PUT',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
          })
            .then(response => {

              if (!response.ok) {
                throw new Error('Network response was not ok.');
              }
              return response.json();
            })
            .then(result => {
              if (result.success) {
                alert('Password changed successfully.');
              } else {
                alert('Error: ' + result.error);
              }
            })
            .catch(error => {
              console.error('Fetch error:', error);
              alert('An error occurred. Please try again later.');
            });
        });
      });
    </script>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

  </body>

  </html>

  <?php
} else {
  header("Location: index");
  exit();
}// Your PHP code here
?>