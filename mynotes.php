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
  // User is logged in, proceed with your logic
  $username = htmlspecialchars($_SESSION['user']['username']);

  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>AshwinArchives - Create Your Notes</title>
    <meta
      content="AshwinArchives is a platform for creating, managing, and organizing your personal notes and ideas. Discover powerful tools to keep your thoughts and projects well-organized."
      name="description">
    <meta content="notes, personal notes, note-taking, organization, productivity, AshwinArchives" name="keywords">
    <meta content="AshwinArchives" name="author">
    <meta property="og:title" content="AshwinArchives - Create Your Notes">
    <meta property="og:description"
      content="AshwinArchives is a platform for creating, managing, and organizing your personal notes and ideas. Discover powerful tools to keep your thoughts and projects well-organized.">
    <meta property="og:image" content="URL_TO_IMAGE"> <!-- Replace with the URL of your preview image -->
    <meta property="og:url" content="URL_TO_PAGE"> <!-- Replace with the actual URL of the page -->
    <meta property="og:type" content="website">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="AshwinArchives - Create Your Notes">
    <meta property="twitter:description"
      content="AshwinArchives is a platform for creating, managing, and organizing your personal notes and ideas. Discover powerful tools to keep your thoughts and projects well-organized.">
    <meta property="twitter:image" content="URL_TO_IMAGE"> <!-- 
   
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
      /* Custom CSS to hide the scrollbar */
      .hide-scrollbar {
        overflow-y: hidden;
        /* Hide scrollbar */
      }

      /* Remove default outline of textarea */
      textarea.form-control:focus {
        box-shadow: none;
        /* Remove focus shadow */
        outline: none;
        /* Remove focus outline */
      }

      /* Optional: Add a border to the textarea if needed */
      textarea.form-control {
        border: 1px solid #ced4da;
        font-family: "Courier New", Courier, monospace;
        /* Monospaced font */
        /* Default Bootstrap border color */
      }
    </style>
  </head>

  <body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="home" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">AshwinArchives</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <!-- <li><a style="cursor:pointer;" class="active" onclick="sendNote()">Send to Mail<br></a></li>
          <li><a style="cursor:pointer;" class="active" onclick="sendAllNotes()">Send All Notes<br></a></li> -->

            <!-- <li><a style="cursor:pointer;" class="active" onclick="downloadNote()">Download<br></a></li> -->
            <li><a id="logout-btn" class="" style="cursor:pointer;">Logout</a></li>

          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" style="cursor:pointer" id="save">Save</a>



      </div>
    </header>

    <main class="main">



      <section id="portfolio" class="portfolio section p-2">

        <!-- Section Title -->
        <div class="container section-title aos-init aos-animate p-0" data-aos="fade-up">
          <h2>Notes</h2>
        </div><!-- End Section Title -->

        <div class="container">

          <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <!-- 
          <ul class="portfolio-filters isotope-filters aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">note1</li>
            <li data-filter=".filter-product">note2</li>
            <li data-filter=".filter-branding">note3</li>
          </ul> -->

            <ul class="portfolio-filters isotope-filters aos-init aos-animate" id="notesList" data-aos="fade-up"
              data-aos-delay="100">


            </ul><!-- End Portfolio Filters -->
            <div class="col-md-15">
              <textarea class="form-control" name="message" rows="20" spellcheck="false"
                placeholder="Write your Notes here..." required=""></textarea>
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
      let notesData = [];

      document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('logout-btn').addEventListener('click', function () {
          // Perform logout by redirecting to the same page with a logout action
          window.location.href = '?action=logout'; // Appends ?action=logout to the URL
        });
        const yearSpan = document.getElementById('current-year');
        const currentYear = new Date().getFullYear();
        yearSpan.textContent = currentYear;
        let newn = null;
        const saveButton = document.getElementById('save');
        const txt = document.getElementById('txt');
        const noteTextarea = document.querySelector('textarea[name="message"]');
        const notesList = document.getElementById('notesList');
        let action = '';
        let updatedNoteItem = '';
        var liveid;
        let updatedNoteIndex = '';

        // Function to show preloader
        function showPreloader() {
          const preloader = document.createElement('div');
          preloader.id = 'preloader';
          document.body.appendChild(preloader);
        }

        // Function to hide preloader
        function hidePreloader() {
          const preloader = document.getElementById('preloader');
          if (preloader) {
            document.body.removeChild(preloader);
          }
        }

        // Debounce function
        function debounce(func, delay) {
          let timer;
          return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => func.apply(this, args), delay);
          };
        }

        function handleClick(event) {
          const listItems = document.querySelectorAll('#notesList li');
          listItems.forEach(item => item.classList.remove('filter-active'));

          this.classList.add('filter-active');

          const index = parseInt(this.id.replace('note-', ''), 10);
          const note = notesData.find(note => note.id === index);

          if (index >= 0) {
            noteTextarea.value = note.content;
            noteTextarea.id = `note-${index}`;
          } else {
            noteTextarea.value = '';
            noteTextarea.id = '';
          }
        }

        const debouncedRefreshApi = debounce(refreshApi, 300); // Debounce the API refresh
        // debouncedRefreshApi();
        // setTimeout(execueAfterDelay,t 2000);
        function main() {
          // Show the preloader
          showPreloader();

          // Execute the debounced API refresh
          debouncedRefreshApi();

          // Hide preloader after a delay (e.g., 2 seconds) and execute additional logic
          setTimeout(() => {
            hidePreloader();
            executeAfterDelay();
          }, 2000); // Adjust this delay as needed
        }
        main();

        const debouncedSaveNote = debounce(function () {
          const noteContent = String(noteTextarea.value.trim());
          const noteId = noteTextarea.id;
          const noteIndex = noteId ? parseInt(noteId.replace('note-', ''), 10) : null;
          action = notesData.some(note => note.id === noteIndex) ? 'update' : 'create';

          showPreloader();

          const url = `noteScript.php?action=${action}${action === 'update' ? `&id=${noteIndex}` : ''}`;
          const body = JSON.stringify({ note: noteContent });
          const method = action === 'update' ? 'PUT' : 'POST';

          fetch(url, {
            method: method,
            headers: {
              'Content-Type': 'application/json'
            },
            body: method === 'PUT' ? JSON.stringify({ id: noteIndex, content: noteContent }) : body
          })
            .then(response => response.json())
            .then(result => {

              if (action === 'update') {
                // Store the ID in the variable when action is 'update'
                liveid = result.id;

                updatedNoteIndex = notesData.findIndex(note => note.id === noteIndex);
                if (updatedNoteIndex !== -1) {
                  notesData[updatedNoteIndex].content = noteContent;
                }
              }
              if (action === 'create') {
                newn = result.id;
              }

              refreshApi();


            })
            .catch(error => {
              console.error('Fetch error:', error);
            })
            .finally(() => {
              hidePreloader();
            });
        }, 300); // Debounce save action

        saveButton.addEventListener('click', debouncedSaveNote);

        function refreshApi() {
          fetch('noteScript.php', {
            method: 'GET'
          })
            .then(response => {
              if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
              }
              return response.json();
            })
            .then(responseData => {

              notesData = responseData.data;
              if (!Array.isArray(notesData)) {
                throw new Error('Expected responseData.data to be an array, but got: ' + typeof notesData);
              }

              notesList.innerHTML = '';

              notesData.forEach((note, index) => {
                const li = document.createElement('li');
                const tcontent = note.content ? `${note.content.slice(0, 5)}` : 'No Content';
                li.innerHTML = tcontent;
                li.setAttribute('data-note-id', note.id);

                const icon = document.createElement('i');
                icon.className = 'bi bi-x';
                icon.style.cursor = 'pointer';
                icon.addEventListener('click', cancelbtn);
                li.appendChild(icon);



                if (index === 0) {
                  noteTextarea.id = `note-${note.id}`;
                  noteTextarea.value = note.content;
                  li.className = 'filter-active text';
                } else {
                  li.className = 'text';
                }


                li.id = `note-${note.id}`;
                li.addEventListener('click', handleClick);

                notesList.appendChild(li);
              });

              if (notesData.length > 0) {
                const plusIcon = document.createElement('i');
                plusIcon.className = 'bi bi-plus-circle-fill icon-class';
                plusIcon.style.cursor = 'pointer';
                plusIcon.style.color = '#2487ce';
                plusIcon.addEventListener('click', plus);
                notesList.appendChild(plusIcon);
              }


              if (action === 'update') {

                // Get all list items from the notes list
                const listItems = document.querySelectorAll('#notesList li');

                // Remove 'filter-active' class from all list items
                listItems.forEach(item => item.classList.remove('filter-active'));

                // Add 'filter-active' class to the item with the matching data-note-id
                const activeItem = Array.from(listItems).find(item => item.getAttribute('data-note-id') == liveid);
                if (activeItem) {
                  activeItem.classList.add('filter-active');
                }

                // Find the note to highlight from responseData
                const noteToHighlight = responseData.data.find(note => note.id == liveid);
                if (noteToHighlight) {
                  noteTextarea.value = noteToHighlight.content;
                  noteTextarea.id = `note-${noteToHighlight.id}`;
                }


                // If needed, you can also do something with noteToHighlight here
                // For example, highlight it in the UI or update some other part of your application
              }


              if (action === 'create' && newn != null) {

                // Get all list items from the notes list
                const listItems = document.querySelectorAll('#notesList li');

                // Remove 'filter-active' class from all list items
                listItems.forEach(item => item.classList.remove('filter-active'));

                // Add 'filter-active' class to the item with the matching data-note-id
                const activeItem = Array.from(listItems).find(item => item.getAttribute('data-note-id') == newn);
                if (activeItem) {
                  activeItem.classList.add('filter-active');
                }

                // Find the note to highlight from responseData
                const noteToHighlight1 = responseData.data.find(note => note.id == newn);
                if (noteToHighlight1) {
                  noteTextarea.value = noteToHighlight1.content;
                  noteTextarea.id = `note-${noteToHighlight1.id}`;
                }


              }




            })
            .catch(error => {
              console.log(error);
            });
        }





        function cancelbtn(e) {
          const noteId = this.parentElement.getAttribute('data-note-id');

          fetch(`noteScript.php?id=${noteId}`, {
            method: 'DELETE',
          })
            .then(response => {
              if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
              }
              return response.json();
            })
            .then(responseData => {
              refreshApi();
            })
            .catch(error => {
              console.error('There was a problem with the fetch operation:', error);
            });
        }

        function plus() {

          noteTextarea.value = '';
          noteTextarea.removeAttribute('id');
        }






      });

      function showPreloader() {
        const preloader = document.createElement('div');
        preloader.id = 'preloader';

        document.body.appendChild(preloader);
      }

      // Function to hide preloader
      function hidePreloader() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
          document.body.removeChild(preloader);
        }
      }

      // // Function to send a specific note
      // function sendNote() {

      //   const noteTextarea = document.querySelector('textarea[name="message"]');
      //   const noteId = noteTextarea.id;
      //   // Extract the index (noteId format: 'note-123')
      //   const noteIndex = noteId ? parseInt(noteId.replace('note-', ''), 10) : null;
      //   console.log(noteIndex);

      //   if (noteIndex) {
      //     showPreloader();
      //     fetch(`http://localhost/a/communication/sendNote.php`, {
      //       method: 'POST',
      //       headers: {
      //         'Content-Type': 'application/json',
      //       },
      //       body: JSON.stringify({ note_id: noteIndex }),
      //     })
      //       .then(response => response.json())
      //       .then(data => {
      //         hidePreloader();
      //         alert(data.message); // Handle success response
      //       })
      //       .catch(error => {
      //         hidePreloader();
      //         console.error('Error:', error);
      //         alert('Failed to send note.');
      //       });
      //   } else {
      //     alert('Invalid note ID.');
      //   }
      // }

      // // Function to send all notes
      // function sendAllNotes() {
      //   showPreloader();
      //   fetch(`http://localhost/a/communication/sendNote.php`, {
      //     method: 'POST',
      //     headers: {
      //       'Content-Type': 'application/json',
      //     },
      //     body: JSON.stringify({ send_all_notes: true }),
      //   })
      //     .then(response => response.json())
      //     .then(data => {
      //       hidePreloader();
      //       alert(data.message); // Handle success response
      //     })
      //     .catch(error => {
      //       hidePreloader();
      //       console.error('Error:', error);
      //       alert('Failed to send all notes.');
      //     });
      // }


      // Function to execute the code
      function executeAfterDelay() {
        if (notesData.length > 0) {

          // Select the parent <ul> element
          const ulElement = document.querySelector('#navmenu ul');

          // Array of items to add
          const items = [
            { text: 'Mail the note', onclick: 'sendNote()' },
            { text: 'Mail all notes', onclick: 'sendAllNotes()' },
            { text: 'Download', onclick: 'downloadNote()' } // Added download button
          ];
          // Loop through the array and create list items
          items.forEach(item => {
            // Create a new <li> element
            const liElement = document.createElement('li');

            // Create a new <a> element
            const aElement = document.createElement('a');
            aElement.style.cursor = 'pointer';
            aElement.className = '';
            aElement.innerHTML = `${item.text}<br>`;
            aElement.setAttribute('onclick', item.onclick);

            // Append the <a> element to the <li> element
            liElement.appendChild(aElement);

            // Append the <li> element to the <ul> element
            ulElement.appendChild(liElement);
          });
        }
      }

      // Set a timeout to execute the function after 2 seconds (2000 milliseconds)

      function sendNote() {
        const noteTextarea = document.querySelector('textarea[name="message"]');
        const noteId = noteTextarea ? noteTextarea.id : null;
        // Extract the index (noteId format: 'note-123')
        const noteIndex = noteId ? parseInt(noteId.replace('note-', ''), 10) : null;

        if (noteIndex) {
          promptAndSend(noteIndex, false);
        } else {
          alert('Invalid note ID.');
        }
      }

      function sendAllNotes() {
        promptAndSend(null, true);
      }

      function promptAndSend(noteIndex, sendAll) {
        const email = prompt('Enter your email to proceed:');
        if (email && validateEmail(email)) {
          const proceed = confirm('Email is valid. Do you want to proceed with sending the note(s)?');
          if (proceed) {
            showPreloader();
            fetch(`communication/sendNote.php`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
              },
              body: JSON.stringify({
                email: email,
                note_id: noteIndex,
                send_all_notes: sendAll
              }),
            })
              .then(response => response.json())
              .then(data => {
                hidePreloader();
                alert(data.message); // Handle success response
              })
              .catch(error => {
                hidePreloader();
                console.error('Error:', error);
                alert('Failed to send note(s).');
              });
          } else {
            alert('Note sending canceled.');
          }
        } else {
          alert('Invalid email address.');
        }
      }

      function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
      }

      // Function to download data from textarea as a .txt file
      function downloadNote() {
        const noteTextarea = document.querySelector('textarea[name="message"]');
        const noteId = noteTextarea.id;
        const noteIndex = noteId ? parseInt(noteId.replace('note-', ''), 10) : null;

        if (noteIndex) {
          showPreloader(); // Show preloader to indicate the operation is in progress

          fetch(`noteScript.php?id=${noteIndex}`, {
            method: 'GET'
          })
            .then(response => response.json())
            .then(data => {
              hidePreloader(); // Hide preloader once the operation is complete

              if (data.status == 'success' && data.data['content']) {
                const noteContent = data.data['content'].trim();

                // Create a Blob with the note content
                const blob = new Blob([noteContent], { type: 'text/plain' });
                const url = URL.createObjectURL(blob);

                // Create a link element
                const link = document.createElement('a');
                link.href = url;
                link.download = 'AshwinArchives.txt'; // Set the default file name

                // Append the link to the body (not visible)
                document.body.appendChild(link);

                // Programmatically click the link to trigger the download
                link.click();

                // Clean up
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
              } else {
                alert(data.message || 'Failed to download note.');
              }
            })
            .catch(error => {
              hidePreloader();
              console.error('Error:', error);
              alert('Failed to download note.');
            });
        } else {
          alert('Invalid note ID.');
        }
      }


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