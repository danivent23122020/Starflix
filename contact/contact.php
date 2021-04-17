<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS/Boostrap/Font Awesome-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="form.css">

        <header class="header">
            <img src="logo.png" alt="Logo" id="logo">
        </header>

<?php
if ($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $email_title = "";
    $visitor_message = "";
    $email_body = "<div>";

    if(isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                            <label><b>Visitor Name : </b></label>&nbsp;<span>".$visitor_name."</span>
                      </div>";
    }

    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                            <label><br>Visitor Email : </b></label>&nbsp; <span>".$visitor_email."</span>
                       </div>";
    }

    if(isset($_POST['email_title'])) {
        $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                            <label><br>Request subject : </br></label>$nbsp; <span>".$email_title."</span>
                       </div>";
    }

    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
        $email_body .= "<div>
                            <label><br>Visitor Message : </br></label>
                            <div>".$visitor_message."</div>
                       </div>"; 
    }

    $email_body = "</div>";

    $headers = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";

    if(mail($email_title, $email_body, $headers)) {
        echo "<p>Merci de nous avoir contacté, $visitor_name. Vous recevrez une réponse sous 24 heures.</p>";
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }
} else {
    echo '<p>Something went wrong</p>';
}
?>

<?php 
    if(isset($_POST['submit'])){
        $to = "email@example.com"; // this is your Email address
        $from = $_POST['email']; // this is the sender's Email address
        $visitor_name = $_POST['visitor_name'];
        $email_title = "Form submission";
        $subject2 = "Copy of your form submission";
        $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
        $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

        $headers = "From:" . $from;
        $headers2 = "From:" . $to;
        mail($to,$subject,$message,$headers);
        mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
        echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
        // You can also use header('Location: thank_you.php'); to redirect to another page.
        }
?>
