<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $e = $_SESSION["u"]["email"];

    $nic = $_POST["n"];
    $a1 = $_POST["ad1"];
    $a2 = $_POST["ad2"];
    $ci = $_POST["c"];
    $pc = $_POST["pc"];
    $pay = $_POST["pay"];
    $disc = $_POST["dis"];
    $GIg_d = $_POST["GIg_d"];

    if (empty($nic)) {
        echo ("Please Enter Your NIC Number.");
    } else if (strlen($nic) < 12) {
        echo ("Invalid Your NIC Number.");
    } else if (empty($a1)) {
        echo ("Please Enter Your Address.");
    } else if (strlen($a1) > 50) {
        echo ("Address Line 01 Length Must be less than or equal to 50 Characters.");
    } else if (empty($a2)) {
        echo ("Please Enter Your Address.");
    } else if (strlen($a2) > 50) {
        echo ("Address Line 02 Length Must be less than or equal to 50 Characters.");
    } else if ($ci == 0) {
        echo ("Please Select Your City.");
    } else if (empty($pc)) {
        echo ("Please Enter Your Postal Code.");
    } else if (strlen($pc) != 5) {
        echo ("Postal Code Length Must be 5 Characters.");
    } else if (empty($pay)) {
        echo ("Please Enter Service Charge.");
    } else if (!filter_var($pay, FILTER_VALIDATE_INT)) {
        echo ("Please Enter a Valid Service Charge (integer value).");
    } else if ($pay > 9999) {
        echo ("The service charge should be less than RS: 9999");
    } else if (empty($disc)) {
        echo ("Please Enter Your Description.");
    } else if (empty($GIg_d)) {
        echo ("Please Enter Your Gig Description .");
    
    } else  {

        if (isset($_FILES["pi"])) {
            $img = $_FILES["pi"];
            $imgex = $img["type"];
    
            $allow_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    
            if (in_array($imgex, $allow_extensions)) {
                if ($img["size"] > (1024 * 1024 * 2)) {
                    echo ("Image maximum allowed file size is 2MB.");
                } else {
                    $imgType;
                    if ($imgex == "image/jpg") {
                        $imgType = ".jpg";
                    } else if ($imgex == "image/jpeg") {
                        $imgType = ".jpeg";
                    } else if ($imgex == "image/png") {
                        $imgType = ".png";
                    } else if ($imgex == "image/svg+xml") {
                        $imgType = ".svg";
                    } else if($imgex == "image/avif"){
                        $imgType = ".avif";
                    }
    
                    $pro_img_path = "doc//profile_images//" . $nic . "_" . uniqid() . $imgType;
                    move_uploaded_file($img["tmp_name"], $pro_img_path);
    
                    $wimgRs = Database::search("SELECT * FROM `woker_img` WHERE `worker_email`='" . $e . "' ");
                    $winum = $wimgRs->num_rows;
    
                    if ($winum == 0) {
                        Database::iud("INSERT INTO `woker_img`(`profile_path`,`worker_email`) VALUES ('" . $pro_img_path . "','" . $e . "')");
                    } else {
                        Database::iud("UPDATE `woker_img` SET `profile_path`='" . $pro_img_path . "' WHERE `worker_email`='" . $e . "'");
                    }
                }
            } else {
                echo ("Your Image Not allowed extensions.");
            }
        }

       if (isset($_FILES["gig_image"])) {
            $gig_img = $_FILES["gig_image"];
            $gig_imgex = $gig_img["type"];
    
            $gig_allow_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    
            if (in_array($gig_imgex, $gig_allow_extensions)) {
                if ($gig_img ["size"] > (1024 * 1024 * 2)) {
                    echo ("Image maximum allowed file size is 2MB.");
                } else {
                    $gig_imgType;
                    if ($gig_imgex == "image/jpg") {
                        $gig_imgType = ".jpg";
                    } else if ($gig_imgex == "image/jpeg") {
                        $gig_imgType = ".jpeg";
                    } else if ($gig_imgex == "image/png") {
                        $gig_imgType = ".png";
                    } else if ($gig_imgex == "image/svg+xml") {
                        $gig_imgType = ".svg";
                    } else if($gig_imgex == "image/avif"){
                        $gig_imgType = ".avif";
                    }
    
                    $gig_img_path = "doc//Gig_image//" . $nic . "_" . uniqid() . $gig_imgType;
                    move_uploaded_file($gig_img["tmp_name"], $gig_img_path);
    
                    $wimgRs = Database::search("SELECT * FROM `woker_img` WHERE `worker_email`='" . $e . "' ");
                    $winum = $wimgRs->num_rows;
    
                    if ($winum == 0) {
                        Database::iud("INSERT INTO `woker_img`(`cover_img_path`) VALUES ('" . $gig_img_path . "')");
                    } else {
                        Database::iud("UPDATE `woker_img` SET `cover_img_path`='" . $gig_img_path . "' WHERE `worker_email`='" . $e . "'");
                    }
                }
            } else {
                echo ("Gig Image has unsupported extensions.");
            }
       }

        $waddRs = Database::search("SELECT * FROM `worker_address` WHERE `worker_email`='" . $e . "'");
        $wnum = $waddRs->num_rows;

        if ($wnum == 1) {
            Database::iud("UPDATE `worker_address` SET `add_line1`='" . $a1 . "',`add_line2`='" . $a2 . "',`city_city_id`='" . $ci . "',
            `postal_code`='" . $pc . "' WHERE `worker_email`='" . $e . "' ");
        } else {
            Database::iud("INSERT INTO `worker_address`(`add_line1`,`add_line2`,`worker_email`,`city_city_id`,`postal_code`) VALUES 
            ('" . $a1 . "','" . $a2 . "','" . $e . "','" . $ci . "','" . $pc . "')");
        }

        $workerRs = Database::search("SELECT * FROM `worker` WHERE `email`='" . $e . "'");
        $workerNum = $workerRs->num_rows;

        if ($workerNum == 1) {
            Database::iud("UPDATE `worker` SET `nic`='" . $nic . "',`payment`='" . $pay . "',
            `discription`='" . $disc . "',`gig_d`='" . $GIg_d . "' WHERE `email`='" . $e . "' ");
        } else {
            Database::iud("INSERT INTO `worker`(`nic`,`email`,`payment`,`discription`,`gig_d`) VALUES 
            ('" . $nic . "','" . $e . "','" . $pay . "','" . $disc . "','" . $GIg_d . "')");
        }

        setcookie("email", "", -1);
        setcookie("password", "", -1);
        echo ("Ok");

    }
}

?>
