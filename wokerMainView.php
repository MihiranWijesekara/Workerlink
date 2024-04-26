<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Link | Home</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php

    require('wheader.php');

    if (isset($_SESSION["u"]["category_id"])) {

        $email = $_SESSION["u"]["email"];

        $workerRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id=category.cate_id 
        INNER JOIN `status` ON worker.status_s_id=status.s_id INNER JOIN `gender` ON worker.gender_id=gender.id 
        INNER JOIN `woker_img` ON worker.email=woker_img.worker_email WHERE `email`='" . $email . "' ");
        $workerdata = $workerRs->fetch_assoc();

    ?>

        <div class="container-fluid sec-bg1 text-white d-flex flex-column align-content-center">
            <div class="row justify-content-around my-5">
                <div class="col-12 col-md-3 box justify-content-center p-3 px-5">

                    <center>
                        <?php
                        if (empty($workerdata["profile_path"])) {
                        ?>
                            <img src="img/wicon.png" class="my-4 logo rounded rounded-circle border border-dark p-1 bg-dark" alt="No Profile Image" />
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo $workerdata["profile_path"]; ?>" class="my-4 logo rounded rounded-circle border border-dark fw-bold p-1" alt="Profile Image" />
                        <?php
                        }
                        ?>
                    </center>

                    <?php
                    $workerRs = Database::search("SELECT fname, lname FROM `worker` WHERE `email`='" . $email . "'");
                    $workerdata = $workerRs->fetch_assoc();
                    ?>
                    <p class="text-dark text-center"> <b> <?php echo $workerdata["fname"] . " " . $workerdata["lname"]; ?></b> </p>

                    <?php
                    $workerRs = Database::search("SELECT cate_name FROM `worker` INNER JOIN `category` ON worker.category_id=cate_id  WHERE `email`='" . $email . "'");
                    $workerdata = $workerRs->fetch_assoc();
                    ?>
                    <p class=" text-dark text-center"> <b><?php echo ($workerdata["cate_name"]); ?></b> </p>

                    <?php
                    $workerRs = Database::search("SELECT mobile FROM `worker` INNER JOIN `category` ON worker.category_id=cate_id  WHERE `email`='" . $email . "'");
                    $workerdata = $workerRs->fetch_assoc();
                    ?>
                    <p class="text-dark text-center"> <b> <?php echo ($workerdata["mobile"]); ?> </b> </p>
                    
                                                <div class="text-dark text-center"  >
                                                    <?php
                                                     $workerRs = Database::search("SELECT r_Like FROM `worker`  WHERE `email`='" . $email . "'");
                                                     $workerdata = $workerRs->fetch_assoc();
                                                    $workerLike = $workerdata['r_Like'];
                                                    ?>
                                                    <?php
                                                    if ($workerLike == '0' or $workerLike < 5) {
                                                    ?>
                                                        <i style="margin-left: 10px;" class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                    <?php
                                                    } else if ($workerLike <= 5 or $workerLike < 20) {
                                                    ?>
                                                        <i style="margin-left: 10px; color: yellow;" class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                    <?php
                                                    } else if ($workerLike <= 20 or $workerLike < 40) {
                                                    ?>
                                                        <i style="margin-left: 10px; color: yellow;" class="bi bi-star-fill"></i>
                                                        <i style=" color: yellow;" class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                    <?php
                                                    } else if ($workerLike <= 40 or $workerLike < 60) {
                                                    ?>
                                                        <i style="margin-left: 10px; color: yellow;" class="bi bi-star-fill"></i>
                                                        <i style=" color: yellow;" class="bi bi-star-fill"></i>
                                                        <i style=" color: yellow;" class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                    <?php
                                                    } else if ($workerLike <= 60 or $workerLike < 80) {
                                                    ?>
                                                        <i style="margin-left: 10px; color: yellow;" class="bi bi-star-fill"></i>
                                                        <i style=" color: yellow;" class="bi bi-star-fill"></i>
                                                        <i style=" color: yellow;" class="bi bi-star-fill"></i>
                                                        <i style=" color: yellow;" class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star"></i>
                                                    <?php
                                                    } else if($workerLike > 80){
                                                        ?>
                                                        <i style="margin-left: 10px; color: yellow;" class="bi bi-star-fill"></i>
                                                        <i style=" color: yellow;" class="bi bi-star-fill"></i>
                                                        <i style=" color: yellow;" class="bi bi-star-fill"></i>
                                                        <i style=" color: yellow;" class="bi bi-star-fill"></i>
                                                        <i style=" color: yellow;" class="bi bi-star-fill"></i>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                </div>

                <div class="col-12 col-md-5 box" style="height:300px;">

                    <?php
                    $workerRs = Database::search("SELECT discription FROM `worker` INNER JOIN `category` ON worker.category_id=cate_id  WHERE `email`='" . $email . "'");
                    $workerdata = $workerRs->fetch_assoc();
                    ?>

                    <p class="text-dark fw-bold" style="margin-top:30px; font-size:medium;" ; > <?php echo ($workerdata["discription"]); ?> </p>
                </div>

            </div>
        </div>
    <?php
    }
    include('footer.php');

    ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>