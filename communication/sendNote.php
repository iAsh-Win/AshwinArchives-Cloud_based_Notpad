<?php
require_once '../db.php'; // Ensure this file contains your database connection
require '../vendor/autoload.php'; // Include Composer's autoload file for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $body, $attachments = [])
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use Gmail's SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = ''; // Replace with your SMTP username
        $mail->Password = ''; // Replace with your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('', 'AshwinArchives'); // Replace with your email
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Add attachments
        foreach ($attachments as $attachment) {
            $mail->addStringAttachment($attachment['content'], $attachment['name']);
        }

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log or handle the error
        return false;
    }
}

function generateUniqueFileName()
{
    // Generate a unique 5-digit number
    return 'AshwinArchives_' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT) . '.txt';
}

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($data['email'])) {
        $recipientEmail = $data['email'];

        if (isset($data['note_id'])) {
            // Sending a single note
            $noteId = intval($data['note_id']);
            $stmt = $conn->prepare('SELECT content FROM notes WHERE id = ?');
            $stmt->bind_param('i', $noteId);
            $stmt->execute();
            $result = $stmt->get_result();
            $note = $result->fetch_assoc();

            if ($note) {
                $fileContent = $note['content'];
                $fileName = generateUniqueFileName(); // Generate unique filename

                $emailSent = sendEmail(
                    $recipientEmail,
                    'Your Requested Note is Here',
                    'Below is your note',
                    [['content' => $fileContent, 'name' => $fileName]]
                );

                if ($emailSent) {
                    echo json_encode(['status' => 'success', 'message' => 'Email sent successfully!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to send email.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Note not found.']);
            }

            $stmt->close();
        } elseif (isset($data['send_all_notes']) && $data['send_all_notes'] === true) {
            // Sending all notes
            $stmt = $conn->prepare('SELECT id, content FROM notes');
            $stmt->execute();
            $result = $stmt->get_result();
            $attachments = [];

            while ($note = $result->fetch_assoc()) {
                $fileContent = $note['content'];
                $fileName = generateUniqueFileName(); // Generate unique filename
                $attachments[] = ['content' => $fileContent, 'name' => $fileName];
            }

            if (count($attachments) > 0) {
                $emailSent = sendEmail(
                    $recipientEmail,
                    'All Your Notes are Here',
                    'Below are all your notes',
                    $attachments
                );

                if ($emailSent) {
                    echo json_encode(['status' => 'success', 'message' => 'All notes sent successfully!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to send notes.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No notes found.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Recipient email is required.']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
