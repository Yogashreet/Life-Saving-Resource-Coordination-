<html>
<body>
<form name='sendmsg' method='post'>
    <div class='form-group'>
        <label for='username'>Message</label>
        <input type='text' class='form-control' name='msg' aria-describedby='emailHelp' placeholder='Enter Message'>
    </div>
    <input type='submit' class='btn btn-success' name='sub' value='Send Email'/>
</form>

<?php
require('db.php');
if(isset($_POST['sub'])){
    $msg = $_POST['msg'];

    require 'phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'yshree254@gmail.com';
    $mail->Password = 'mvquaxeuqobxvqspq';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('yshree254@gmail.com', 'Yogashree');

    $county = $_GET['county'] ?? '';
    if (!$county) {
        echo 'County not specified.';
        exit;
    }

    $sq = mysqli_query($con, "SELECT email FROM bloodonor WHERE county='$county'");
    if ($sq === false) {
        echo 'Error querying database: ' . mysqli_error($con);
        exit;
    }

    if (mysqli_num_rows($sq) > 0) {
        $emailaddresses = [];
        while ($row = mysqli_fetch_assoc($sq)) {
            $emailaddresses[] = $row["email"];
        }
    } else {
        echo 'No email addresses found for the specified county.';
        exit;
    }

    foreach ($emailaddresses as $address) {
        $mail->addAddress($address);
    }

    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    $mail->isHTML(true);
    $mail->Subject = 'Confirmation of the blood donation dates and venue';
    $mail->Body = $msg;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}
?>
</body>
</html>
