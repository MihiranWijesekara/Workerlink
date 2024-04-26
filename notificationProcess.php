<?php

session_start();

require "connection.php";

$type = $_GET["worker"];
$Email = $_GET["email"]; 
   
if ($type == 'worker') {
    Database::iud("UPDATE `worker` SET `Notify` = 2 WHERE `email` = '" . $Email . "'");
} else{
    Database::iud("UPDATE `user` SET `Notify` = 2 WHERE `email` = '" . $Email . "'");
}
?>
