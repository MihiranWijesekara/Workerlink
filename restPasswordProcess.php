<?php

require "connection.php";

$e = $_POST["e"];
$np = $_POST["np"];
$rp = $_POST["rp"];
$vc = $_POST["vc"];

$wrs = Database::search("SELECT * FROM `worker` WHERE `email`='" . $e . "' ");
$wn = $wrs->num_rows;
$urs = Database::search("SELECT * FROM `user` WHERE `email`='" . $e . "' ");
$un = $urs->num_rows;

if($wn=="1"){
    $data=$wrs->fetch_assoc();
}else{
    $data=$urs->fetch_assoc();
}

if (empty($np)) {
    echo ("Please Enter Your New Password.");
} else if (strlen($np) < 5 || strlen($np) > 20) {
    echo ("Password Lenth Must be been 5 - 20 Characters.");
} else if (empty($rp)) {
    echo ("Please Enter Retype Password.");
} else if ($rp != $np) {
    echo ("Does Not Match Password.");
} else if (empty($vc)) {
    echo ("Please Enter Varification Code.");
} else if($data["varification_code"]!=$vc) {
    echo ("Invalid Varification Code.");
}else {
    if($wn=="1"){
        Database::iud("UPDATE `worker` SET `password`='".$np."' WHERE `email`='".$e."' ");
    }else{
        Database::iud("UPDATE `user` SET `password`='".$np."' WHERE `email`='".$e."' ");
    }
    echo("success");
}


