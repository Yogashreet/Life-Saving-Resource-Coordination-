<?php
require('db.php');
session_start();

if (isset($_POST['uname']) && isset($_POST['id_num'])) {
    $uname = stripslashes($_POST['uname']);
    $uname = mysqli_real_escape_string($con, $uname);
    $id_num = stripslashes($_POST['id_num']);
    $id_num = mysqli_real_escape_string($con, $id_num);

    // Check if user exists in the database
    $query = "SELECT * FROM `bloodonor` WHERE uname='$uname' AND id_num='$id_num'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        // User found, allow them to set a new password
        $_SESSION['reset_user'] = $uname;
        header("Location: reset_password.php");
    } else {
        echo "<script type='text/javascript'>alert('Incorrect username or user ID. Try again!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | Blood and Organ Donation System</title>
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
                <a class="navbar-brand"><img src="static/images/logo.png" alt="" height="30px"> LIFE SAVING RESOURCE COORDINATION</a>
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
            <h1>Forgot Password</h1>
            <form action="forgot_password.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="uname" placeholder="Enter Username" required>
                </div>
                <div class="form-group">
                    <label for="id_num">User ID</label>
                    <input type="text" class="form-control" name="id_num" placeholder="Enter User ID" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
