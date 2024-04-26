<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (($_GET["e"]) != null) {

    $email = $_GET["e"];

    $wrs = Database::search("SELECT * FROM `worker` WHERE `email`='" . $email . "' ");
    $wn = $wrs->num_rows;
    $wdata = $wrs->fetch_assoc();

    $urs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' ");
    $un = $urs->num_rows;

    if ($un == "1") {

        $vcode = uniqid();

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'workerlinks@gmail.com';
        $mail->Password = 'vtld cwpc zqtv qnzz';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('workerlinks@gmail.com', 'Reset Password');
        $mail->addReplyTo('workerlinks@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Worker Link Forgot Password Varification Code';
        $bodyContent = '<h1 style="color:green;">WL &ndash; ' . $vcode . ' Is Your Worker Link Varification Code.</h1>';
        $mail->Body = $bodyContent;

        Database::iud("UPDATE `user` SET `varification_code`='" . $vcode . "' WHERE `email`='" . $email . "'");

        if (!$mail->send()) {
            echo ("Email Not Sending. Please Check Your Connection And Try Again.");
        } else {
            echo ("success");
        }

    } else if ($wn != "1") {
        echo ("Invalid Email Address.");
    } else if ($wdata["status_s_id"] == "1") {
        echo ("1");
    } else if ($wdata["status_s_id"] == "3") {
        echo ("3");
    } else {

        $vcode = uniqid();

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'workerlinks@gmail.com';
        $mail->Password = 'vtld cwpc zqtv qnzz';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('workerlinks@gmail.com', 'Reset Password');
        $mail->addReplyTo('workerlinks@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Worker Link Forgot Password Varification Code';
        $bodyContent = '<h1 style="color:green;">WL &ndash; ' . $vcode . ' Is Your Worker Link Varification Code.</h1>';
        $mail->Body = $bodyContent;

        Database::iud("UPDATE `worker` SET `varification_code`='" . $vcode . "' WHERE `email`='" . $email . "'");

        if (!$mail->send()) {
            echo ("Email Not Sending. Please Check Your Connection And Try Again.");
        } else {
            echo ("success");
        }

    }

} else {
    echo ("Please Enter Your Email Address First.");
}
