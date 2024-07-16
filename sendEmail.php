<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Recipient Email Address
    $to = "avdou83@gmail.com";
    
    // Subject of the email
    $subject = "New Contact Message from Mouloudia Actualités";
    
    // Compose the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";
    
    // Email headers
    $headers = "From: $name <$email>";
    
    // Attempt to send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // Email sent successfully
        $statusMsg = '<div class="alert alert-success">Your message has been sent successfully.</div>';
    } else {
        // Error sending email
        $statusMsg = '<div class="alert alert-danger">Sorry, there was an error sending your message.</div>';
    }
}
?>
