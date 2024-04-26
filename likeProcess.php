<?php
session_start();
require "connection.php";

$userLikeEmail = $_SESSION["u"]["email"];
$workerLikeEmail = $_GET["likeemail"];

$likeReviewRs = Database::search("SELECT * FROM `review` WHERE `user_email`='$userLikeEmail' AND `worker_email`= '$workerLikeEmail'");
$likeReviewRsNum = $likeReviewRs->num_rows;
$likeReviewRsData = $likeReviewRs->fetch_assoc();

if ($likeReviewRsNum > 0) {
    if ($likeReviewRsData['Like_status'] == '2') {

        $currentReview = Database::search("SELECT `r_Like` FROM `worker` WHERE `email` = '$workerLikeEmail'");
        $currentReviewData = $currentReview->fetch_assoc();
        $newReview = $currentReviewData['r_Like'] + 1;


        Database::iud("UPDATE `review` SET `Like_status` = '1' WHERE `user_email` = '$userLikeEmail' AND `worker_email` = '$workerLikeEmail'");
        Database::iud("UPDATE `worker` SET `r_Like` = '$newReview' WHERE `email` = '$workerLikeEmail'");
        echo "AddLike";
    } elseif ($likeReviewRsData['Like_status'] == '1') {

        $currentReview = Database::search("SELECT `r_Like` FROM `worker` WHERE `email` = '$workerLikeEmail'");
        $currentReviewData = $currentReview->fetch_assoc();
        $newReview = $currentReviewData['r_Like'] - 1;


        Database::iud("UPDATE `review` SET `Like_status` = '2' WHERE `user_email` = '$userLikeEmail' AND `worker_email` = '$workerLikeEmail'");
        Database::iud("UPDATE `worker` SET `r_Like` = '$newReview' WHERE `email` = '$workerLikeEmail'");
        echo "RemoveLike";
    }
} else {

    $currentReview = Database::search("SELECT `r_Like` FROM `worker` WHERE `email` = '$workerLikeEmail'");
    $currentReviewData = $currentReview->fetch_assoc();
    $newReview = $currentReviewData['r_Like'] + 1;


    Database::iud("INSERT INTO `review`(`Like_status`,`user_email`,`worker_email`) VALUES('1' ,'$userLikeEmail','$workerLikeEmail')");
    Database::iud("UPDATE `worker` SET `r_Like` = '$newReview' WHERE `email` = '$workerLikeEmail'");
    echo "AddLike";
}
