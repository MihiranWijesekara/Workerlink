<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $wemail = $_GET["wemail"];

    $uemail = $_SESSION["u"]["email"];

    $orRs = Database::search("SELECT * FROM `order` WHERE `user_email`='" . $uemail . "' AND `worker_email`='" . $wemail . "' 
                            AND `order_status_order_st_id`='4' OR `order_status_order_st_id`='1'");

    $orNum = $orRs->num_rows;

    if ($orNum == 0) {

        $date = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $date->setTimezone($tz);
        $d = $date->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `order`(`order_time`,`order_status_order_st_id`,`user_email`,`worker_email`)
                        VALUES('" . $d . "','4','" . $uemail . "','" . $wemail . "' )");
        Database::iud( "UPDATE `user` SET `Notify` = 1 WHERE `email` = '" . $uemail . "'");
        Database::iud( "UPDATE `worker` SET `Notify` = 1 WHERE `email` = '" . $wemail . "'");
        echo("Pending Order...");

    }else{
        echo("Already Order Proccesing...");
    }
}
