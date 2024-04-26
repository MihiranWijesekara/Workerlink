<?php 

session_start();

require "connection.php";


if (isset($_SESSION["u"])) {

    $e = $_SESSION["u"]["email"];

    $nic = $_POST["n"];
    $ps = $_POST["p"];
    $a1 = $_POST["ad1"];
    $a2 = $_POST["ad2"];
     $pr = $_POST["pr"];
     $dist = $_POST["d"];
    $ci = $_POST["c"];
    $pc = $_POST["pc"];

    if (empty($nic)) {
        echo ("Please Enter Your NIC Number.");
    }else if(strlen($nic)< 12) {
        echo ("Invalid Your NIC Number.");
    } else if(empty($ps)){
        echo ("Please Enter ypur password.");
    }else if(strlen($ps)< 5 || strlen($ps) > 20 ) {
        echo ("Password Lenth Must be been 5 - 20 Characters.");
    }else if(empty($a1)){
        echo ("Please Enter your Address.");
    }else if(strlen($a1) > 50){
        echo ("Address Line 01 Lenth Must be been 50 Characters.");
    }else if(empty($a2)){
        echo ("Please Enter your Address.");
    }else if(strlen($a2) > 50){
        echo ("Address Line 02 Lenth Must be been 50 Characters.");
    }else if($ci == 0){
        echo ("Please Select Your City.");
    }else if(empty($pc)){
        echo ("Please Enter ypur Postal code");
    }else if (strlen($pc) != 5) {
        echo ("Postal Code Lenth Must be been 5 Characters.");
    }else {

        if (isset($_FILES["pi"])) {

            $img = $_FILES["pi"];
            $imgex = $img["type"];
    
            $allow_extensitions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    
            if (in_array($imgex, $allow_extensitions)) {
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
                    }
    
                    $pro_img_path = "doc//profile_images//" . $nic . "_" . uniqid() . $imgType;
                    move_uploaded_file($img["tmp_name"], $pro_img_path);
    
                    $wimgRs = Database::search("SELECT * FROM `user_img` WHERE `user_email`='" . $e . "' ");
                    $winum = $wimgRs->num_rows;
    
                    if ($winum == 0) {
                        Database::iud("INSERT INTO `user_img`(`user_pro_img`,`user_email`) VALUES ('" . $pro_img_path . "','" . $e . "')");
                    }else {
                        Database::iud("UPDATE `user_img` SET `user_pro_img`='" . $pro_img_path . "' WHERE `user_email`='" . $e . "'");
                    }
                }
            } else {
                echo ("Your Image Not allowed extentions.");
            }
        }

        $waddRs = Database::search("SELECT * FROM `user_address` WHERE `user_email`='" . $e . "'");
        $wnum = $waddRs->num_rows;

        if ($wnum == 1) {
            Database::iud("UPDATE `user_address` SET `ad_line1`='" . $a1 . "',`ad_line2`='" . $a2 . "',`city_city_id`='" . $ci . "',
            `postal_code`='" . $pc . "',`user_email`='" . $e . "' WHERE `user_email`='" . $e . "' ");
        } else {
            Database::iud("INSERT INTO `user_address`(`ad_line1`,`ad_line2`,`user_email`,`city_city_id`,`postal_code`) VALUES 
            ('" . $a1 . "','" . $a2 . "','" . $e . "','" . $ci . "','" . $pc . "')");
        }


        Database::iud("UPDATE `user` SET `nic`='" . $nic . "',`password`='" . $ps . "'  WHERE `email`='" . $e . "' ");

        setcookie("email", "", -1);
        setcookie("password", "", -1);
        echo ("Ok");

    }

}

?>