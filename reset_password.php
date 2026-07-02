<?php
require('db.php');
session_start();

if (isset($_SESSION['reset_user']) && isset($_POST['newpwd'])) {
    $uname = $_SESSION['reset_user'];
    $newpwd = stripslashes($_POST['newpwd']);
    $newpwd = mysqli_real_escape_string($con, $newpwd);

    // Update password in the database
    $query = "UPDATE `bloodonor` SET pwd='$newpwd' WHERE uname='$uname'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script type='text/javascript'>alert('Password successfully reset. You can now log in with your new password.'); window.location.href = 'donorlogin.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Failed to reset password. Try again!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | Blood and Organ Donation System</title>
    <link rel="shortcut icon" type="image/x-icon" href="static/images/logo.png" />
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/nav.css" rel="stylesheet">
   <style type="text/css">
    
        body {
            background-image: url("static/images/hype22.jpg");
            background-color: #cccccc;
            background-repeat: no-repeat;
            background-size: 115vw 100vh;
            background-attachment: fixed;
        }
        .container {
            margin-top: 50px;
            width: 40%;
        }
        .jumbotron {
            padding: 30px;
        }
        .navbar-brand img{
            padding: 0;
            display: inline;
        }
        
    </style>
</head>
<body>
    <nav class="navbar navbar-default" style="background-color: #000000">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand"><img src="static/images/logo.png" alt="" height="30px">  LIFE SAVING RESOURCE COORDINATION</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.html">Home</a></li>
                <li><a href="donorlogin.php">Donor Portal</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Staff Portal <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="doclogin.php">Doctor Portal</a></li>
                        <li><a href="adminlogin.php">Admin</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="regdonor.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="jumbotron">
            <h1>Reset Password</h1>
            <form action="reset_password.php" method="post">
                <div class="form-group">
                    <label for="newpwd">New Password</label>
                    <input type="password" class="form-control" name="newpwd" placeholder="Enter New Password" required>
                </div>
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
