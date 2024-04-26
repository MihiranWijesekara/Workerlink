<?php
session_start();
require "connection.php";

if(isset($_SESSION["admin"])){

    $m = "+" . strval(trim($_GET["m"]));
    
    $workerExistsRs = Database::search("SELECT * FROM `worker` WHERE `mobile`='$m' ");

    if ($workerExistsRs->num_rows > 0) {
        $workerData = $workerExistsRs->fetch_assoc();

        $currentStatus = $workerData['status_s_id'];

        if ($currentStatus == '2') {
            Database::iud("UPDATE `worker` SET `status_s_id`='3' WHERE `mobile`='$m'");
            echo "success";
        } elseif ($currentStatus == '3') {
            Database::iud("UPDATE `worker` SET `status_s_id`='2' WHERE `mobile`='$m'");
            echo "success";
        } else {
            echo "Invalid user status: " . $currentStatus;
        }
    } else {
        echo "User not found".$m ;
    }
}
?>
