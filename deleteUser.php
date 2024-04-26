<?php
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        $sqlUserImg = "DELETE FROM user_img WHERE user_email = '$email'";
        Database::iud($sqlUserImg);

        $sqlUser = "DELETE FROM user WHERE email = '$email'";
        Database::iud($sqlUser);

        echo "Record deleted successfully";

    } else {
        echo "Invalid request";
    }
} else {
    echo "Invalid request method";
}
?>
