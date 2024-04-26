<?php
session_start();
require "connection.php";

if (isset($_SESSION["admin"]) && isset($_GET["m"])) {
    $m = "+" . strval($_GET["m"]);

    $userExistsRs = Database::search("SELECT * FROM `user` WHERE `mobile`='$m'");

    if ($userExistsRs->num_rows > 0) {
        $userData = $userExistsRs->fetch_assoc();

        $currentStatus = $userData['status_s_id'];

        if ($currentStatus == '2') {

            Database::iud("UPDATE `user` SET `status_s_id`='3' WHERE `mobile`='$m'");
            echo "success";
        } elseif ($currentStatus == '3') {

            Database::iud("UPDATE `user` SET `status_s_id`='2' WHERE `mobile`='$m'");
            echo "success";
        } else {

            echo "Invalid user status";
        }
    } else {

        echo "User not found";
    }
}
