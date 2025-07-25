<?php
// PHP Email Handler
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);
    
    // Validate input
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set recipient email
        $to = "dev@example.com";
        
        // Create email headers
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        // Compose email body
        $email_body = "
        <html>
        <head>
            <title>Contact Form Submission</title>
        </head>
        <body>
            <h2>Contact Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Subject:</strong> {$subject}</p>
            <p><strong>Message:</strong></p>
            <p>{$message}</p>
        </body>
        </html>
        ";
        
        // Send email
        if (mail($to, "Contact Form: " . $subject, $email_body, $headers)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "validation_error";
    }
} else {
    // If not a POST request, redirect to the form page
    header("Location: index.html");
    exit();
}
?>
