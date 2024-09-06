<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AshwinArchives</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #f4f4f4;
        }
        h1, h2, h3 {
            color: #555;
        }
        code {
            background: #eee;
            padding: 0.2em 0.4em;
            font-size: 85%;
            color: #d14;
            border-radius: 4px;
        }
        pre {
            background: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: auto;
            padding: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>AshwinArchives</h1>

    <p><strong>AshwinArchives</strong> is a PHP-based web application designed to help you store, create, and manage your educational archives efficiently. This project features secure and accessible storage solutions for your notes, with an intuitive interface for easy organization.</p>

    <h2>Features</h2>
    <ul>
        <li><strong>Organize Notes</strong>: Easily categorize and manage your educational notes with user-friendly tools.</li>
        <li><strong>Secure Storage</strong>: Protect your data with robust security features to ensure privacy.</li>
        <li><strong>Cloud Access</strong>: Access your notes from anywhere using our secure cloud storage.</li>
        <li><strong>Download or Email Notes</strong>: Save your notes locally or send them via email directly from the platform.</li>
    </ul>

    <h2>Database Schema</h2>

    <h3><code>notes</code></h3>
    <table>
        <thead>
            <tr>
                <th>Column</th>
                <th>Type</th>
                <th>Null</th>
                <th>Default</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>id</code></td>
                <td>int(11)</td>
                <td>No</td>
                <td></td>
                <td>Primary key</td>
            </tr>
            <tr>
                <td><code>content</code></td>
                <td>text</td>
                <td>No</td>
                <td></td>
                <td>The content of the note</td>
            </tr>
            <tr>
                <td><code>created_at</code></td>
                <td>timestamp</td>
                <td>No</td>
                <td>current_timestamp()</td>
                <td>Timestamp when the note was created</td>
            </tr>
            <tr>
                <td><code>username</code></td>
                <td>varchar(255)</td>
                <td>Yes</td>
                <td>NULL</td>
                <td>Username of the note creator</td>
            </tr>
        </tbody>
    </table>

    <h3><code>users</code></h3>
    <table>
        <thead>
            <tr>
                <th>Column</th>
                <th>Type</th>
                <th>Null</th>
                <th>Default</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>id</code></td>
                <td>int(11)</td>
                <td>No</td>
                <td></td>
                <td>Primary key</td>
            </tr>
            <tr>
                <td><code>username</code></td>
                <td>varchar(255)</td>
                <td>No</td>
                <td></td>
                <td>Username for login</td>
            </tr>
            <tr>
                <td><code>password</code></td>
                <td>varchar(255)</td>
                <td>No</td>
                <td></td>
                <td>Password for login</td>
            </tr>
            <tr>
                <td><code>created</code></td>
                <td>datetime</td>
                <td>No</td>
                <td>current_timestamp()</td>
                <td>Timestamp when the user was created</td>
            </tr>
        </tbody>
    </table>

    <h2>Getting Started</h2>
    <ol>
        <li><strong>Clone the Repository</strong>:
            <pre><code>git clone https://github.com/yourusername/AshwinArchives.git</code></pre>
        </li>
        <li><strong>Navigate to the Project Directory</strong>:
            <pre><code>cd AshwinArchives</code></pre>
        </li>
        <li><strong>Install Dependencies</strong>:
            <ul>
                <li>Ensure you have Composer installed. If not, you can download and install it from <a href="https://getcomposer.org/" target="_blank">getcomposer.org</a>.</li>
                <li>Run Composer to install the project's dependencies:
                    <pre><code>composer install</code></pre>
                </li>
            </ul>
        </li>
        <li><strong>Set Up Your Environment</strong>:
            <ul>
                <li>Ensure you have a web server (like Apache or Nginx) with PHP support and MySQL installed.</li>
                <li>Create a new database named <code>aa</code> and import the schema from the <code>database.sql</code> file (if provided) or manually create tables based on the schema above.</li>
            </ul>
        </li>
        <li><strong>Configure the Database Connection</strong>:
            <p>Edit <code>db.php</code> to set your database connection details:</p>
            <pre><code>&lt;?php
$dbHost = 'localhost'; // Database host
$dbUser = 'root';      // Database username
$dbPass = '';          // Database password
$dbName = 'aa';        // Database name

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?&gt;</code></pre>
        </li>
        <li><strong>Run the Application</strong>:
            <ul>
                <li>Place the project directory in your web server's root directory.</li>
                <li>Access the application via <a href="http://localhost/AshwinArchives" target="_blank">http://localhost/AshwinArchives</a> in your web browser.</li>
            </ul>
        </li>
    </ol>

    <h2>Usage</h2>
    <ul>
        <li><strong>Create and Manage Notes</strong>: Use the web interface to add, view, and manage your notes.</li>
        <li><strong>Access Notes</strong>: Log in to access your notes from any device.</li>
        <li><strong>Download or Email Notes</strong>: Use the provided features to download or email your notes.</li>
    </ul>

    <h2>Contact</h2>
    <p>For more information or inquiries, you can follow us on social media:</p>
    <ul>
        <li><a href="https://x.com/iAshwinSolanki" target="_blank">Twitter</a></li>
        <li><a href="https://www.instagram.com/iAshwinSolanki/" target="_blank">Instagram</a></li>
        <li><a href="https://www.linkedin.com/in/iAshwinSolanki/" target="_blank">LinkedIn</a></li>
    </ul>

    <h2>License</h2>
    <p>This project is licensed under the MIT License - see the <a href="LICENSE" target="_blank">LICENSE</a> file for details.</p>

    <h2>Acknowledgments</h2>
    <p>Thank you to all for your attention to <strong>AshwinArchives</strong>.</p>
</body>
</html>
