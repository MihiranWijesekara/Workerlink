<?php

session_start();

require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_SESSION["admin"])){

    $m = "+".strval($_GET["m"]);

   $wAcRs = Database::search("SELECT * FROM `worker` WHERE `mobile`='".$m."' AND `status_s_id`='1' ");
   $wAcDataRs = $wAcRs->fetch_assoc();

   if($wAcRs->num_rows == "1"){
        Database::iud("UPDATE `worker` SET `status_s_id`='2' WHERE `mobile`='".$m."' ");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'workerlinks@gmail.com';
        $mail->Password = 'vtld cwpc zqtv qnzz';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('workerlinks@gmail.com', 'Active Account');
        $mail->addReplyTo('workerlinks@gmail.com', 'Active Account');
        $mail->addAddress($wAcDataRs['email']);
        $mail->isHTML(true);
        $mail->Subject = 'Active Account ';
        $bodyContent1 = '<center><img src="img/el.jpg"></center>';
        $bodyContent2 = '<h3 style="color:black;">Your worker account has been activated. We think you will provide good service to customers. And we wish you success... </h3>';
        
        $mail->Body = $bodyContent1 . $bodyContent2;
    
        if (!$mail->send()) {
            echo ("Email Not Sending. Please Check Your Connection And Try Again.");
        } else {
            echo ("success");
        }

       // echo("success");
   }else{
     echo("error");
   }
    
}

?>