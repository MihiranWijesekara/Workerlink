<?php

require "connection.php";

$fn = $_POST["fname"];
$ln = $_POST["lname"];
$e = $_POST["email"];
$ps = $_POST["ps"];
$rps = $_POST["rps"];
$m = $_POST["mobile"];
$g = $_POST["gen"];
$accType = $_POST["at"];

// set time
$date = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$date->setTimezone($tz);
$d = $date->format("Y-m-d H:i:s");

$wrs = Database::search("SELECT * FROM `worker` WHERE `email`='" . $e . "' OR `mobile`='" . $m . "'");
$wn = $wrs->num_rows;
$urs = Database::search("SELECT * FROM `user` WHERE `email`='" . $e . "' OR `mobile`='" . $m . "'");
$un = $urs->num_rows;

if (empty($fn)) {
    echo ("Please Enter Your First Name.");
} else if (strlen($fn) > 45) {
    echo ("First Name Must Have Less Than 45 Characters.");
} else if (empty($ln)) {
    echo ("Please Enter Your Last Name.");
} else if (strlen($ln) > 45) {
    echo ("Last Name Must Have Less Than 45 Characters.");
} else if (empty($e)) {
    echo ("Please Enter Your Email Address.");
} else if (strlen($e) > 100) {
    echo ("Email Address Must Have Less Than 100 Characters.");
} else if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address.");
} else if (empty($ps)) {
    echo ("Please Enter Your Password.");
} else if (strlen($ps) < 5 || strlen($ps) > 20) {
    echo ("Password Lenth Must be been 5 - 20 Characters.");
} else if (empty($rps)) {
    echo ("Please Enter Retype Password.");
} else if ($rps != $ps) {
    echo ("Does Not Match Password.");
} else if (!preg_match('/^\+94[0-9]{9}$/', $m)) {
    echo "Invalid Mobile Number. Please use the +94 format.";
} else if ($g == "0") {
    echo ("Please Select Your Gender.");
} else if (empty($accType)) {
    echo ("Please Select Your Account.");
} else if ($accType == "1") {
    $catType = $_POST["ct"];
    if (empty($catType)) {
        echo ("Please Select Your Worker Account Category.");
    } else if (!isset($_FILES["wcv"])) {
        echo ("Please Upload Your CV.");
    } else {
        if ($wn > 0 OR $un> 0) {
            echo ("This Email OR Mobile Number Already Exists.");
        } else {

            $access_fileUpload = array("application/x-zip-compressed","application/x-rar-compressed","application/zip");

            $cv = $_FILES["wcv"];

            $fType = $cv["type"];

            if (in_array($fType, $access_fileUpload)) {

                if (($cv["size"]) > (1024 * 1024)) {
                    echo ("File Size Limit Exceeded  maximum allowed file size is 1MB.");
                } else {
                    $newtype = "";
                    if ($fType == "application/x-zip-compressed") {
                        $newtype = ".zip";
                    }
                    
                    $newfilepath = "doc//cv//" . $fn . "_" . $m . $newtype;
                    move_uploaded_file($cv["tmp_name"], $newfilepath);

                    Database::iud("INSERT INTO `worker`(`email`,`fname`,`lname`,`password`,`mobile`,`file_path`,`regdate`,`gender_id`,`category_id`,`status_s_id`,`r_Like`) 
                    VALUES ('" . $e . "','" . $fn . "','" . $ln . "','" . $ps . "','" . $m . "','" . $newfilepath . "','" . $d . "','" . $g . "','" . $catType . "','1','0')");
                    echo ("success");
                }
            } else {
                echo ("You Can Upload Zip File Type Only");
            }
        }
    }
} else {
    if ($un > 0 OR $wn>0) {
        echo ("This Email OR Mobile Number Already Exists.");
    } else {
        Database::iud("INSERT INTO `user`(`email`,`fname`,`lname`,`password`,`mobile`,`gender_id`,`regdate`,`status_s_id`) 
        VALUES ('" . $e . "','" . $fn . "','" . $ln . "','" . $ps . "','" . $m . "','" . $g . "','" . $d . "','2')");
        echo ("success");
    }
}
