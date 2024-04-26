<?php
session_start();
require "connection.php";

$userSaveEmail = $_SESSION["u"]["email"];
$workerSaveEmail = $_GET["saveemail"];

$saveProfileRs = Database::search("SELECT * FROM `save_profile` WHERE `user_email`='$userSaveEmail' AND `worker_email`= '$workerSaveEmail'");
$saveProfileNum = $saveProfileRs->num_rows;
$saveProfileData = $saveProfileRs->fetch_assoc();

if ($saveProfileNum > 0) {
    if ($saveProfileData['save_Status'] == '2') {

        Database::iud("UPDATE `save_profile` SET `save_Status` = '1' WHERE `user_email` = '$userSaveEmail' AND `worker_email` = '$workerSaveEmail'");
        echo "Addsave";

    } elseif ($saveProfileData['save_Status'] == '1') {

        Database::iud("UPDATE `save_profile` SET `save_Status` = '2' WHERE `user_email` = '$userSaveEmail' AND `worker_email` = '$workerSaveEmail'");
        echo "Removesave";
    }
} else {
    
    Database::iud("INSERT INTO `save_profile`(`save_Status`,`user_email`,`worker_email`) VALUES('1' ,'$userSaveEmail','$workerSaveEmail')");
    echo "Addsave";
}
