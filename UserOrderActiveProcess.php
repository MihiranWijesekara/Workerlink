<?php

session_start();

require "connection.php";

    $OrderProcess =  $_SESSION["u"]["email"];
    $id = ($_GET["id"]);

    $OrderProcessRs = Database::search("SELECT * FROM `Order` WHERE `user_email`='".$OrderProcess."' AND `order_id` ='".$id."' ");
    $OrderProcessRsNum = $OrderProcessRs->num_rows; 
    
    if ($OrderProcessRsNum > 0) {
        $OrderProcessData = $OrderProcessRs->fetch_assoc();

        $orderStatus = $OrderProcessData['order_status_order_st_id'];

        if ($orderStatus == 4) {
            Database::iud("UPDATE `order` SET `order_status_order_st_id`='2' WHERE `user_email`='".$OrderProcess."' AND `order_id` ='".$id."' ");
               echo "success";
        } else if ($orderStatus == 2)  {
            echo 'Order is canceled!';
        }else if($orderStatus == 1 OR $orderStatus == 5 ){
            echo 'You Can not cancel Order!';
        }
        
    } else {
        echo "error";
    }
?>
