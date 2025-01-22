<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['msg']));

    // Email where the form message should be sent
    $to = "balaedsty@gmail.com";  // Replace with your email
    $subject = "New Message from Contact Form";

    // Email body
    $body = "You have received a new message from your contact form.\n\n";
    $body .= "Email: " . $email . "\n\n";
    $body .= "Message: \n" . $message . "\n";

    // Email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send the message. Please try again later.";
    }
} else {
    echo "Invalid request!";
}
?>
