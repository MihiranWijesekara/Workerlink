<?php

session_start();

require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$workerOrderEmail =  $_SESSION["u"]["email"];
$action = ($_GET["ac"]);
$orderId = ($_GET["id"]);

$_SESSION["order_id"] = $orderId;
$OrderProcessRs = Database::search("SELECT * FROM `Order` WHERE `worker_email`='" . $workerOrderEmail . "' AND `order_id`= '" . $orderId . "' ");
$OrderProcessRsNum = $OrderProcessRs->num_rows;

if ($OrderProcessRsNum > 0) {
    $OrderProcessData = $OrderProcessRs->fetch_assoc();

    $orderStatus = $OrderProcessData['order_status_order_st_id'];

    if ($orderStatus == 1) {
        echo "complete";

    } elseif ($orderStatus == 4) {

        if ($action == "active") {
            $vcode = uniqid();

            Database::iud("UPDATE `order` SET `order_status_order_st_id`='1', `order_code` = '".$vcode ."' WHERE `worker_email`='" . $workerOrderEmail . "' AND `order_id`= '" . $orderId . "' AND `user_email`='" . $OrderProcessData['user_email'] . "' ");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'workerlinks@gmail.com';
            $mail->Password = 'vtld cwpc zqtv qnzz';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('workerlinks@gmail.com', 'Order Code');
            $mail->addReplyTo('workerlinks@gmail.com', 'Order Code');
            $mail->addAddress($OrderProcessData['user_email']);
            $mail->isHTML(true);
            $mail->Subject = 'Worker Link Order Code ';
            $bodyContent = '<h1 style="color:green;">WL &ndash; ' . $vcode . ' Is Your Worker Link Order Code.</h1>';
            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                echo ("Email Not Sending. Please Check Your Connection And Try Again.");
            } else {
                echo ("success");
            }
            
        }else if($action == "cancel"){
            Database::iud("UPDATE `order` SET `order_status_order_st_id`='2' WHERE `worker_email`='" . $workerOrderEmail . "' AND `order_id`= '" . $orderId . "'");
            echo "success";
        }
    }    
    
} else if ($orderStatus == 2) {
    echo "Order Cancel";
} else if ($orderStatus == 5) {
    echo "complete";
} else {
    echo "error";
}
?>
