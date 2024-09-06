<?php
// users.php
session_start(); // Start the session

header('Content-Type: application/json');

// Include the database connection file
require_once 'db.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
// Parse the query string for parameters
$queryParams = [];
parse_str($_SERVER['QUERY_STRING'], $queryParams);

switch ($requestMethod) {
    case 'POST':
        if (isset($queryParams['action']) && $queryParams['action'] === 'login') {
            loginUser($conn);
        } else {
            createUser($conn);
        }
        break;

    case 'GET':
        // Check for 'id' parameter in query string
        if (isset($queryParams['id']) && $queryParams['action'] === 'checkAvailable') {
            $id = $queryParams['id'];
            checkAvailable($conn, $id);
        } else if (isset($queryParams['id']) && $queryParams['action'] === 'getUser') {
            $id = $queryParams['id'];
            getUser($conn, $id);
        } else {
            // Handle case where no user ID is provided
            http_response_code(400);
            echo json_encode(['error' => 'User ID is required']);
        }
        break;

    case 'PUT':
        if (isset($queryParams['id'])) {
            $id = $queryParams['id'];
            updateUser($conn, $id);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'User ID is required']);
        }
        break;

    case 'DELETE':
        if (isset($queryParams['id'])) {
            $id = $queryParams['id'];
            deleteUser($conn, $id);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'User ID is required']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}

function getUser($conn, $username)
{
    // Prepare the SQL statement with a placeholder for the username
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');

    // Bind the parameter. Assuming $username is a string ('s')
    $stmt->bind_param('s', $username);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the user data
    $user = $result->fetch_assoc();

    // Check if user data was found
    if ($user) {
        // Store user data in session
        // $_SESSION['user'] = $user;

        http_response_code(200);
        echo json_encode(['status' => true, 'user' => $user]);
    } else {
        // http_response_code(404);
        // echo json_encode(['status' => false, 'error' => 'User not found']);
        http_response_code(200);
        echo json_encode(['status' => false]);
    }

    // Close the statement
    $stmt->close();
}

function checkAvailable($conn, $username)
{
    // Prepare the SQL statement with a placeholder for the username
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');

    // Bind the parameter. Assuming $username is a string ('s')
    $stmt->bind_param('s', $username);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the user data
    $user = $result->fetch_assoc();

    // Check if user data was found
    if ($user) {
        // Store user data in session
        // $_SESSION['user'] = $user;

        http_response_code(200);
        echo json_encode(['status' => true]);
    } else {
        // http_response_code(404);
        // echo json_encode(['status' => false, 'error' => 'User not found']);
        http_response_code(200);
        echo json_encode(['status' => false]);
    }

    // Close the statement
    $stmt->close();
}

function createUser($conn)
{
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['username']) && isset($data['password'])) {
        // Hash the password before storing
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->bind_param('ss', $data['username'], $hashedPassword);
        $stmt->execute();

        $_SESSION['user']['username'] = $data['username'];

        http_response_code(201);
        echo json_encode(['id' => $conn->insert_id]);

        $stmt->close();
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Bad Request: username and password are required']);
    }
}

function updateUser($conn, $id)
{
    // Get the input data
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the 'password' field is set
    if (isset($data['newPassword'])) {
        // Hash the new password
        $hashedPassword = password_hash($data['newPassword'], PASSWORD_DEFAULT);

        // Prepare the SQL statement to update the password
        $stmt = $conn->prepare('UPDATE users SET password = ? WHERE username = ?');
        $stmt->bind_param('si', $hashedPassword, $id);

        // Execute the statement
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows) {
            http_response_code(200);
            echo json_encode(['success' => 'Password updated']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'User not found or no change']);
        }

        // Close the statement
        $stmt->close();
    } else {
        // If 'password' field is missing in the request
        http_response_code(400);
        echo json_encode(['error' => 'No password provided']);
    }
}


function deleteUser($conn, $id)
{
    $stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();

    if ($stmt->affected_rows) {
        http_response_code(200);
        echo json_encode(['success' => 'User deleted']);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'User not found']);
    }
    $stmt->close();
}

function loginUser($conn)
{
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['username']) && isset($data['password'])) {
        // Prepare the SQL statement with a placeholder for the username
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bind_param('s', $data['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($data['password'], $user['password'])) {
            // Store user data in session
            $_SESSION['user']['username'] = $user['username'];

            http_response_code(200);
            echo json_encode(['success' => 'Login successful', 'user' => $user]);
        } else {
            http_response_code(200);
            echo json_encode(['error' => 'Invalid username or password']);
        }

        $stmt->close();
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Bad Request: username and password are required']);
    }
}
?>