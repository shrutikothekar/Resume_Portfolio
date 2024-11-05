<?php
// Set the response type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON data from the POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract form details
    $name = $data['name'];
    $email = $data['email'];
    $subject = $data['subject'];
    $message = $data['message'];

    // Set up email details
    $to = 'shrutikothekar01@gmail.com';
    $email_subject = "Contact Form Submission: $subject";
    $email_body = "You have received a new message from the contact form.\n\n".
                  "Here are the details:\n".
                  "Name: $name\n".
                  "Email: $email\n".
                  "Subject: $subject\n".
                  "Message:\n$message";

    $headers = "From: noreply@example.com\n"; // Change "example.com" to your domain
    $headers .= "Reply-To: $email";

    // Attempt to send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Unable to send email. Please try again later."]);
    }
} else {
    // If not a POST request, return an error
    echo json_encode(["success" => false, "error" => "Invalid request method."]);
}
?>
