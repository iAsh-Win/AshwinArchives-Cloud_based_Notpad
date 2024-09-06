AshwinArchives

AshwinArchives is a PHP-based web application designed to store, create, and manage educational archives efficiently. It offers secure and accessible storage solutions with an intuitive interface.

Features

- Organize Notes: Categorize and manage notes with user-friendly tools.
- Secure Storage: Protect data with robust security features.
- Cloud Access: Access notes from anywhere using secure cloud storage.
- Download or Email Notes: Save notes locally or send them via email directly.

Database Schema

notes Table

Column      | Type        | Null | Default             | Comment
-------------|-------------|------|---------------------|----------------------------------
id          | int(11)     | No   |                     | Primary key
content     | text        | No   |                     | The content of the note
created_at  | timestamp   | No   | current_timestamp() | Timestamp when the note was created
username    | varchar(255)| Yes  | NULL                | Username of the note creator

users Table

Column     | Type         | Null | Default             | Comment
------------|--------------|------|---------------------|-----------------------------
id         | int(11)      | No   |                     | Primary key
username   | varchar(255) | No   |                     | Username for login
password   | varchar(255) | No   |                     | Password for login
created    | datetime     | No   | current_timestamp() | Timestamp when the user was created

Getting Started

1. Clone the Repository:
    git clone https://github.com/yourusername/AshwinArchives.git

2. Navigate to the Project Directory:
    cd AshwinArchives

3. Install Dependencies:
    - Ensure Composer is installed. Download it from getcomposer.org.
    - Install dependencies with Composer:
    composer install

4. Set Up Your Environment:
    - Ensure a web server (Apache/Nginx) with PHP and MySQL is installed.
    - Create a database named aa and import the schema from database.sql or create tables manually.

5. Configure the Database Connection:
    - Edit db.php:
    <?php
    $dbHost = 'localhost'; // Database host
    $dbUser = 'root';      // Database username
    $dbPass = '';          // Database password
    $dbName = 'aa';        // Database name

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>

6. Run the Application:
    - Place the project in your web server's root directory.
    - Access it via http://localhost/AshwinArchives.

Usage

- Create and Manage Notes: Add, view, and manage notes through the web interface.
- Access Notes: Log in to access notes from any device.
- Download or Email Notes: Use features to download or email notes.

Contact

For more information or inquiries, follow us on social media:

- Twitter: https://x.com/iAshwinSolanki
- Instagram: https://www.instagram.com/iAshwinSolanki/
- LinkedIn: https://www.linkedin.com/in/iAshwinSolanki/

License

This project is licensed under the MIT License. See the LICENSE file for details.

Acknowledgments

Thank you for your attention to AshwinArchives.
