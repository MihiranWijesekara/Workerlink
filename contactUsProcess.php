<?php

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$cName = $_POST["cName"];
$cEmail = $_POST["cEmail"];
$cMessage = $_POST["cMessage"];

if (empty($cName )) {
    echo ("Please Enter Your Name.");
} else if (empty($cEmail)) {
    echo ("Please Enter Your Email.");
} else if (empty($cMessage)) {
    echo ("Please Enter Your Message.");
} else {
    
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'workerlinks@gmail.com';
    $mail->Password = 'vtld cwpc zqtv qnzz';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('workerlinks@gmail.com', 'Customer Problem');
    $mail->addReplyTo('workerlinks@gmail.com', 'Customer Problem');
    $mail->addAddress('achinthamihiran654@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'Customer Problem ';
    $bodyContent1 = '<h1 style="color:black;">Customer Name: ' . $cName . ' .</h1>';
    $bodyContent2 = '<h1 style="color:black;">Customer Email: ' . $cEmail . ' </h2>';
    $bodyContent3 = '<h1 style="color:black;">Customer Message: ' . $cMessage . ' </h3>';

    $mail->Body = $bodyContent1 . $bodyContent2 . $bodyContent3;

    if (!$mail->send()) {
        echo ("Email Not Sending. Please Check Your Connection And Try Again.");
    } else {
        echo ("success");
    }

}
?>

