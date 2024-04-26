<?php

session_start();

require "connection.php";

$email = $_POST["email"];
$avcode = $_POST["advc"];

$adrs = Database::search("SELECT * FROM `admin` WHERE `admin_email`='".$email."' AND `verification_code`='".$avcode."' ");

$adnum=$adrs->num_rows;

if($adnum == "1"){
    $_SESSION["admin"] = $email;
    echo("ok");
}else{
    echo("Invalid Email Address.");
}

?>