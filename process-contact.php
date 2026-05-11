<?php
/**
 * Contact Form Handler for LASA Consultants
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $org_name = htmlspecialchars(trim($_POST['org_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject_input = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Simple validation
    if (empty($org_name) || empty($email) || empty($subject_input)) {
        die("Please fill in all required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Save to "database" (contacts.json)
    $contacts_file = 'contacts.json';
    $new_submission = [
        'id' => time(),
        'date' => date('Y-m-d H:i:s'),
        'org_name' => $org_name,
        'email' => $email,
        'subject' => $subject_input,
        'message' => $message,
        'status' => 'new'
    ];

    $current_data = [];
    if (file_exists($contacts_file)) {
        $json_data = file_get_contents($contacts_file);
        $current_data = json_decode($json_data, true);
        if (!is_array($current_data)) $current_data = [];
    }

    array_unshift($current_data, $new_submission);
    file_put_contents($contacts_file, json_encode($current_data, JSON_PRETTY_PRINT));

    // Redirect to a success page or back with a message
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Message Sent | LASA</title>
        <link rel='stylesheet' href='style.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
        <style>
            .success-container {
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                background: #0B132B;
                color: white;
            }
            .success-card {
                background: rgba(255,255,255,0.1);
                padding: 50px;
                border-radius: 20px;
                backdrop-filter: blur(10px);
                max-width: 500px;
            }
            .success-icon {
                font-size: 4rem;
                color: #C1E1A6;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class='success-container'>
            <div class='success-card'>
                <i class='fas fa-check-circle success-icon'></i>
                <h1>Thank You!</h1>
                <p>Your message has been sent successfully. We will get back to you shortly.</p>
                <br>
                <a href='index.php' class='btn-main btn-primary'>Back to Home</a>
            </div>
        </div>
    </body>
    </html>";
} else {
    header("Location: index.php");
    exit();
}
?>
