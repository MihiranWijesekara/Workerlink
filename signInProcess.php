<?php

session_start();
require "connection.php";

$e = $_POST["e"];
$p = $_POST["p"];
$r = $_POST["r"];



$wrs = Database::search("SELECT * FROM `worker` INNER JOIN `status` ON worker.status_s_id = status.s_id WHERE `email`='" . $e . "' AND `password`='" . $p . "' ");
$urs = Database::search("SELECT * FROM `user` INNER JOIN `status` ON user.status_s_id = status.s_id WHERE `email`='" . $e . "' AND `password`='" . $p . "' ");
$wn = $wrs->num_rows;
$un = $urs->num_rows;

if (empty($e)) {
    echo ("Please Enter Your Email Address.");
} else if (strlen($e) > 100) {
    echo ("Email Address Must Have Less Than 100 Characters.");
} else if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address.");
} else if (empty($p)) {
    echo ("Please Enter Your Password.");
} else if (strlen($p) < 5 || strlen($p) > 20) {
    echo ("Password Lenth Must be been 5 - 20 Characters.");
} else {
    if ($wn == "1") {
        $wdata = $wrs->fetch_assoc();
        if ($wdata["status_s_id"] == "1") {
            echo ("Deactivate");
        } else if ($wdata["status_s_id"] == "3") {
            echo ("Prohibit");
        } else {
            $_SESSION["u"] = $wdata;
            if ($r == "true") {
                setcookie("email", $e, time() + (60 * 60 * 24 * 7));
                setcookie("password", $p, time() + (60 * 60 * 24 * 7));
            } else {
                setcookie("email", "", -1);
                setcookie("password", "", -1);
            }
            echo ("w");
        }
    } else if ($un == "1") {
        $wdata = $urs->fetch_assoc();
        if ($wdata["status_s_id"] == "3") {
            echo ("Prohibit");
        } else {

            $add = Database::search("SELECT * FROM `user` WHERE `email`='" . $e . "' ");

            $adData = $add->fetch_assoc();

            if ($adData["nic"] == null) {
                $_SESSION["u"] = $wdata;
                echo ("update");
            } else {
                echo ("u");
                
            $_SESSION["u"] = $wdata;
            if ($r == "true") {
                setcookie("email", $e, time() + (60 * 60 * 24 * 7));
                setcookie("password", $p, time() + (60 * 60 * 24 * 7));
            } else {
                setcookie("email", "", -1);
                setcookie("password", "", -1);
            }
            }
        }
    } else {
        echo ("Invalid Email Address OR Password");
    }
}
