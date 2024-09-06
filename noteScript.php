<?php
// noteScript.php
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
        if (isset($queryParams['action']) && $queryParams['action'] === 'create') {
            createNote($conn);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid action']);
        }
        break;

    case 'GET':
        // Check for 'id' parameter in query string
        if (isset($queryParams['id'])) {
            $id = filter_var($queryParams['id'], FILTER_SANITIZE_NUMBER_INT);
            getNote($conn, $id);
        } else {
            getAllNotes($conn);
        }
        break;

    case 'PUT':
        if (isset($queryParams['action']) && $queryParams['action'] === 'update' && isset($queryParams['id'])) {
            $id = filter_var($queryParams['id'], FILTER_SANITIZE_NUMBER_INT);
            updateNote($conn, $id);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Note ID is required']);
        }
        break;

    case 'DELETE':
        if (isset($queryParams['id'])) {
            $id = filter_var($queryParams['id'], FILTER_SANITIZE_NUMBER_INT);
            deleteNote($conn, $id);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Note ID is required']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}

// Create a new note
function createNote($conn)
{
    // Ensure session is started
    $data = json_decode(file_get_contents('php://input'), true);
    $content = trim($data['note'] ?? '');

    // Validation
    if (empty($content)) {
        http_response_code(400);
        echo json_encode(['error' => 'Note content cannot be empty']);
        exit;
    }

    // Get username from session
    if (!isset($_SESSION['user']['username'])) {
        http_response_code(403);
        echo json_encode(['error' => 'User not logged in']);
        exit;
    }
    $username = htmlspecialchars($_SESSION['user']['username']);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO notes (content, username) VALUES (?, ?)");
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param('ss', $content, $username);

        // Execute statement
        if ($stmt->execute()) {
            $noteId = $stmt->insert_id;
            echo json_encode([
                'status' => 'success',
                'message' => 'Note created successfully',
                'id' => $noteId
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create note']);
        }

        // Close statement
        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to prepare statement']);
    }
}


// Retrieve a single note
function getNote($conn, $id)
{
    // Validate that the ID is a numeric value
    if (!is_numeric($id)) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Invalid note ID']);
        return;
    }


    // Check if the username is set in the session
    if (!isset($_SESSION['user']['username'])) {
        http_response_code(401); // Unauthorized
        echo json_encode(['error' => 'User not logged in']);
        return;
    }

    $currentUsername = $_SESSION['user']['username'];

    // Prepare the SQL statement to select the note by its ID
    $stmt = $conn->prepare("SELECT * FROM notes WHERE id = ? AND username = ?");
    if ($stmt) {
        // Bind the ID and username parameters to the SQL query
        $stmt->bind_param('is', $id, $currentUsername);
        $stmt->execute();

        // Get the result of the query
        $result = $stmt->get_result();
        $note = $result->fetch_assoc();

        // Check if a note was found
        if ($note) {
            echo json_encode(['status' => 'success', 'data' => $note]);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'Note not found or not accessible']);
        }

        // Close the statement
        $stmt->close();
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to prepare statement']);
    }
}


// Retrieve all notes
function getAllNotes($conn)
{
    // Start session if not already started

    // Check if the username is set in the session
    if (!isset($_SESSION['user']['username'])) {
        http_response_code(401); // Unauthorized
        echo json_encode(['error' => 'User not logged in']);
        return;
    }

    $username = $_SESSION['user']['username'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM notes WHERE username = ?");

    if ($stmt) {
        // Bind the username parameter to the SQL query
        $stmt->bind_param('s', $username);
        $stmt->execute();

        // Get the result and fetch all notes
        $result = $stmt->get_result();
        $notes = $result->fetch_all(MYSQLI_ASSOC);

        // Return the notes as a JSON response
        echo json_encode(['status' => 'success', 'data' => $notes]);

        // Close the statement
        $stmt->close();
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to prepare statement']);
    }
}


// Update an existing note
function updateNote($conn, $id)
{
    if (!is_numeric($id)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid note ID']);
        return;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $content = trim($data['content'] ?? '');

    // Validation
    if (empty($content)) {
        http_response_code(400);
        echo json_encode(['error' => 'Note content cannot be empty']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE notes SET content = ? WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param('si', $content, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Successful update, include id in the response
            echo json_encode(['status' => 'success', 'message' => 'Note updated successfully', 'id' => $id]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Note not found']);
        }
        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to prepare statement']);
    }
}


// Delete a note
function deleteNote($conn, $id)
{
    if (!is_numeric($id)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid note ID']);
        return;
    }

    $stmt = $conn->prepare("DELETE FROM notes WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Note deleted successfully']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Note not found']);
        }
        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to prepare statement']);
    }
}
?>