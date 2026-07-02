<?php
// contact.php

use PHPMailer\phpmailer\PHPMailer;
use PHPMailer\phpmailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['act'])) {
    $fname = $_POST['fname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];

    // Insert data into the database
    $query = "INSERT INTO `contact` (fname, phone, email, msg) VALUES ('$fname', '$phone', '$email', '$msg')";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'techtitans0724@gmail.com'; // SMTP username
            $mail->Password = 'kbmfifsyrblapwyz'; // SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('techtitans0724@gmail.com', 'LIFE SAVING RESOURCE COORDINATION');
            $mail->addAddress($email, $fname);

            // Content
            $mail->isHTML(true);
            $mail->Subject = "Feedback Received";
            $mail->Body    = "Dear $fname <br>
            Thank you for taking the time to provide us with your inquiry.
             We greatly appreciate your input as it helps us to continually improve our services and better meet your needs.
             Your comments have been received and will be reviewed by our team. Should we require any further information, we will reach out to you directly.
             Once again, thank you for your valuable feedback. We are committed to using your insights to enhance our offerings and provide you with the best possible experience.<br>

            Best regards,<br>
            [LIFE SAVING RESOURCE COORDINATION] ";

            $mail->send();
            echo "<script type='text/javascript'>alert('Thank You! Your Message has been Sent!!'); document.location.href = 'index.html';</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script type='text/javascript'>alert('Some Error Occured! Try Again!'); document.location.href = 'index.html';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In | Blood and Organ Donation System</title>
    <link rel="shortcut icon" type="image/x-icon" href="static/images/logo.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            background-image: url("static/images/hype12.jpeg");
            background-repeat: no-repeat;
            background-size: 100vw 110vh;
            background-attachment: fixed;
        }
        .navbar-default {
            background-color: #000000;
            border-color: #000000;
        }
        .navbar-default .navbar-brand {
            color: #fafeff;
        }
        .navbar-default .navbar-brand:hover,
        .navbar-default .navbar-brand:focus {
            color: #fefefe;
        }
        .navbar-default .navbar-text {
            color: #fafeff;
        }
        .navbar-default .navbar-nav > li > a {
            color: #fafeff;
        }
        .navbar-default .navbar-nav > li > a:hover,
        .navbar-default .navbar-nav > li > a:focus {
            color: #fefefe;
        }
        .navbar-default .navbar-nav > .active > a,
        .navbar-default .navbar-nav > .active > a:hover,
        .navbar-default .navbar-nav > .active > a:focus {
            color: #fefefe;
            background-color: #dc0000;
        }
        .navbar-default .navbar-nav > .open > a,
        .navbar-default .navbar-nav > .open > a:hover,
        .navbar-default .navbar-nav > .open > a:focus {
            color: #fefefe;
            background-color: #dc0000;
        }
        .navbar-default .navbar-toggle {
            border-color: #dc0000;
        }
        .navbar-brand img {
            padding: 0;
            display: inline;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand"><img src="static/images/logo.png" alt="" height="30px"> LIFE SAVING RESOURCE COORDINATION</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="donorlogin.php">Donor Portal</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Staff Portal
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="doclogin.php">Doctor Portal</a></li>
                        <li><a href="adminlogin.php">Admin</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Contact Start -->
    <div class="container">
        <div class="jumbotron">
            <h1>Send Us A Message</h1>
            <form class="form-horizontal" action="contact.php" name="contact" method="post">
                <div class="form-group">
                    <label for="username">Full Names</label>
                    <input type="text" class="form-control" name="fname" placeholder="Your Full Names" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Phone Number</label>
                    <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="message">Please Enter Your Message</label>
                    <textarea name="msg" class="form-control" placeholder="Your Message" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" name="act">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
