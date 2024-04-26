<?php

session_start();

if(isset($_SESSION["u"])){

    $_SESSION["u"]=null;
    session_destroy();
    setcookie("email", "", -1);
    setcookie("password", "", -1);
    echo("success");
    
}

?>