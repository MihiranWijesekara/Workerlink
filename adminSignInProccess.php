<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["email"];

$adminRs = Database::search("SELECT * FROM `admin` WHERE `admin_email`='" . $email . "' ");
$adminNum = $adminRs->num_rows;
$adminData = $adminRs->fetch_assoc();

if (empty($email)) {
    echo ("Please Enter Your Email.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL) or $adminNum != "1") {
    echo ("Invalid Email Address.");
} else if ($adminData["admin_email"] == $email) {

    $vcode = uniqid();

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'workerlinks@gmail.com';
    $mail->Password = 'vtld cwpc zqtv qnzz';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('workerlinks@gmail.com', 'Admin Sign In');
    $mail->addReplyTo('workerlinks@gmail.com', 'Admin Sign In');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Worker Link Admin Sign In Varification Code';
    $bodyContent = '<h1 style="color:green;">WL &ndash; ' . $vcode . '<span style="color:orange;"> Is Admin Sign In Varification Code.</span> </h1>';
    $mail->Body = $bodyContent;

    Database::iud("UPDATE `admin` SET `verification_code`='" . $vcode . "' WHERE `admin_email`='" . $email . "'");

    if (!$mail->send()) {
        echo ("Email Not Sending. Please Check Your Connection And Try Again.");
    } else {
        echo ("success");
    }
}
?>