<?php
session_start();

require "connection.php";
$workerOrderEmail =  $_SESSION["u"]["email"];
$orderId =  $_SESSION["order_id"];
$code = $_POST["vrifyCode"];

$OrderCodeRs = Database::search("SELECT * FROM `Order` WHERE `order_code`='" . $code . "' AND `order_id`= '" . $orderId . "' ");
$OrderCodeRsNum = $OrderCodeRs->num_rows;
if ($OrderCodeRsNum > 0) {
        Database::iud("UPDATE `order` SET `order_status_order_st_id`='5' WHERE `worker_email`='" . $workerOrderEmail . "' AND `order_id`= '" . $orderId . "' ");
        echo "success";
}else{
    echo "wrong";

}
?>
