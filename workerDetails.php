<!DOCTYPE html>
<html lang="en">

<?php

session_start();
require "connection.php";

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Link | Worker Profile</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php

    require('wheader.php');
    ?>

    <?php
    if (isset($_GET['email'])) {
        
        $workerId = $_GET['email'];
        $userLikeEmail = $_SESSION["u"]["email"];
      //  echo  $userLikeEmail;

        $workerDetailreviewsRs = Database::search("SELECT * FROM `review`  WHERE `user_email` = '" . $userLikeEmail . "' AND `worker_email` = '" . $workerId . "' ");
        $workerDetailreviewsNum = $workerDetailreviewsRs->num_rows;
        $workerDetailreviewsData = $workerDetailreviewsRs->fetch_assoc();

        $workerDetailsave_profileRs = Database::search("SELECT * FROM `save_profile`  WHERE `user_email` = '" . $userLikeEmail . "' AND `worker_email` = '" . $workerId . "' ");
        $workerDetailsave_profileRsNum = $workerDetailsave_profileRs->num_rows;
        $workerDetailsave_profileData = $workerDetailsave_profileRs->fetch_assoc();

        $workerOrderRs = Database::search("SELECT * FROM `order` WHERE `worker_email` = '" . $workerId . "' ORDER BY order_id DESC LIMIT 1");
        $workerOrderRsNum = $workerOrderRs->num_rows;
        $workerOrderData = $workerOrderRs->fetch_assoc();

        if ($workerDetailsave_profileRsNum > 0 && $workerDetailreviewsNum > 0) {

            $workerDetailsRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id = category.cate_id  
            INNER JOIN `woker_img` ON worker.email=woker_img.worker_email
            INNER JOIN worker_address add_line1 ON worker.email = add_line1.worker_email
            INNER JOIN worker_address add_line2 ON worker.email = add_line2.worker_email 
            WHERE `email`='" . $workerId . "'");

            $workerDetailNum = $workerDetailsRs->num_rows;

            for ($a = 0; $a < $workerDetailNum; $a++) {
                $workerDetailsData = $workerDetailsRs->fetch_assoc();

    ?>

                <div>
                    <?php
                    if ($workerDetailreviewsData['Like_status'] == '2') {
                    ?>
                        <button style="margin-left: 1340px; margin-top: 10px;" type="button" id="like" onclick="userLike('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-primary"><i class="bi bi-hand-thumbs-up-fill" style="font-size: 25px;"></i></button>
                    <?php
                    } else if ($workerDetailreviewsData['Like_status'] == '1') {
                    ?>
                        <button style="margin-left: 1340px; margin-top: 10px;" type="button" id="like" onclick="userLike('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-primary"><i class="bi bi-hand-thumbs-up-fill" style="font-size: 25px;"></i></button>
                    <?php
                    } else {
                    ?>
                        <button style="margin-left: 1340px; margin-top: 10px;" type="button" id="like" onclick="userLike('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-primary"><i class="bi bi-hand-thumbs-up-fill" style="font-size: 25px;"></i></button>
                    <?php
                    }
                    ?>

                    <?php
                    if ($workerDetailsave_profileData['save_Status'] == '2') {
                    ?>
                        <button style=" margin-left: 15px; margin-top: 10px;" type="button" id="save" onclick="userSave('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-danger"><i class="bi bi-heart-fill fw-bold" style="font-size: 25px;"></i></button>
                    <?php
                    } else if ($workerDetailsave_profileData['save_Status'] == '1') {
                    ?>
                        <button style=" margin-left: 15px; margin-top: 10px;" type="button" id="save" onclick="userSave('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-danger"><i class="bi bi-heart-fill fw-bold" style="font-size: 25px;"></i></button>
                    <?php
                    } else {
                    ?>
                        <button style=" margin-left: 15px; margin-top: 10px;" type="button" id="save" onclick="userSave('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-danger"><i class="bi bi-heart-fill fw-bold" style="font-size: 25px;"></i></button>
                    <?php
                    }
                    ?>
                </div>

                <div class="container-fluid sec-bg1 text-white d-flex flex-column align-content-center">
                    <div class="row justify-content-around my-5">
                        <div class="col-12 col-md-2 box d-flex justify-content-center border-0 rounded-circle p-4">
                            <img src="<?php echo $workerDetailsData["profile_path"]; ?>" class="align-content-center logo3 rounded rounded-circle border border-info p-1 text-center bg-dark" />
                        </div>
                        <div class="col-12 col-md-4 box text-dark text-start p-5">
                            <div class="row">
                                <table>
                                    <tbody>
                                        <tr class="p-2">
                                            <th class="col-4 text-dark1 fw-bold">Name :</th>
                                            <td class="text-white1"> <?php echo  $workerDetailsData["fname"] . " " .  $workerDetailsData["lname"]; ?> </td>

                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Worker Category :</th>
                                            <td class="text-white1"><?php echo  $workerDetailsData["cate_name"]; ?></td>

                                        </tr>
                                        <tr class="p-2">

                                            <th class="text-dark1 fw-bold">Address :</th>
                                            <td class="text-white1"> <?php echo  $workerDetailsData["add_line1"] . " " .  $workerDetailsData["add_line2"]; ?> </td>
                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Contact No. :</th>
                                            <td class="text-white1"><?php echo  $workerDetailsData["mobile"]; ?></td>
                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Daily Rate :</th>
                                            <td class="text-white1"> RS. <?php echo  $workerDetailsData["payment"]; ?><b>.</b>00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-10 offset-1 detailsDescription my-4 p-3 px-5">
                        <h4 class="des fw-bold">Description</h4>
                        <br />
                        <p class="fs-6 f-colour ">
                            <?php echo  $workerDetailsData["discription"]; ?>
                        </p>
                    </div>
                    <!-- session_u -->
                    <div>
                        <?php
                        $orderStatus = $workerOrderData['order_status_order_st_id'];
                        if (($orderStatus == '2' or $orderStatus == '5')) {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order(this);">ORDER NOW</button>
                        <?php
                        } else if ($orderStatus == '1' or $orderStatus == '4') {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order1();">ORDER NOW</button>
                        <?php
                        } else {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order(this);">ORDER NOW</button>
                        <?php
                        }
                        ?>
                    </div>
                    <a href="https://wa.me/<?php echo $workerDetailsData['mobile']; ?>" target="_blank">
                        <i class="bi bi-whatsapp  whatsapp-icon"></i>
                    </a>

                </div>
            <?php
            }
        } else if ($workerDetailsave_profileRsNum > 0) {

            $workerDetailsRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id = category.cate_id  
            INNER JOIN `woker_img` ON worker.email=woker_img.worker_email
            INNER JOIN worker_address add_line1 ON worker.email = add_line1.worker_email
            INNER JOIN worker_address add_line2 ON worker.email = add_line2.worker_email 
            WHERE `email`='" . $workerId . "'");

            $workerDetailNum = $workerDetailsRs->num_rows;

            for ($a = 0; $a < $workerDetailNum; $a++) {
                $workerDetailsData = $workerDetailsRs->fetch_assoc();

            ?>
                <div>
                    <button style="margin-left: 1340px; margin-top: 10px;" type="button" id="like" onclick="userLike('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-primary"><i class="bi bi-hand-thumbs-up-fill" style="font-size: 25px;"></i></button>

                    <?php
                    if ($workerDetailsave_profileData['save_Status'] == '2') {
                    ?>
                        <button style=" margin-left: 15px; margin-top: 10px;" type="button" id="save" onclick="userSave('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-danger"><i class="bi bi-heart-fill fw-bold" style="font-size: 25px;"></i></button>
                    <?php
                    } else if ($workerDetailsave_profileData['save_Status'] == '1') {
                    ?>
                        <button style=" margin-left: 15px; margin-top: 10px;" type="button" id="save" onclick="userSave('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-danger"><i class="bi bi-heart-fill fw-bold" style="font-size: 25px;"></i></button>
                    <?php
                    } else {
                    ?>
                        <button style=" margin-left: 15px; margin-top: 10px;" type="button" id="save" onclick="userSave('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-danger"><i class="bi bi-heart-fill fw-bold" style="font-size: 25px;"></i></button>
                    <?php
                    }
                    ?>


                </div>

                <div class="container-fluid sec-bg1 text-white d-flex flex-column align-content-center">
                    <div class="row justify-content-around my-5">
                        <div class="col-12 col-md-2 box d-flex justify-content-center border-0 rounded-circle p-4">

                            <img src="<?php echo $workerDetailsData["profile_path"]; ?>" class="align-content-center logo3 rounded rounded-circle border border-info p-1 text-center bg-dark" />


                        </div>
                        <div class="col-12 col-md-4 box text-dark text-start p-5">
                            <div class="row">
                                <table>
                                    <tbody>
                                        <tr class="p-2">
                                            <th class="col-4 text-dark1 fw-bold">Name :</th>
                                            <td class="text-white1"> <?php echo  $workerDetailsData["fname"] . " " .  $workerDetailsData["lname"]; ?> </td>

                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Worker Category :</th>
                                            <td class="text-white1"><?php echo  $workerDetailsData["cate_name"]; ?></td>

                                        </tr>
                                        <tr class="p-2">

                                            <th class="text-dark1 fw-bold">Address :</th>
                                            <td class="text-white1"> <?php echo  $workerDetailsData["add_line1"] . " " .  $workerDetailsData["add_line2"]; ?> </td>
                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Contact No. :</th>
                                            <td class="text-white1"><?php echo  $workerDetailsData["mobile"]; ?></td>
                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Daily Rate :</th>
                                            <td class="text-white1"> RS. <?php echo  $workerDetailsData["payment"]; ?><b>.</b>00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-10 offset-1 detailsDescription my-4 p-3 px-5">
                        <h4 class="des fw-bold">Description</h4>
                        <br />
                        <p class="fs-6 f-colour ">
                            <?php echo  $workerDetailsData["discription"]; ?>
                        </p>
                    </div>
                    <!-- session_u -->
                    <div>
                        <?php
                        $orderStatus = $workerOrderData['order_status_order_st_id'];
                        if (($orderStatus == '2' or $orderStatus == '5')) {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order(this);">ORDER NOW</button>
                        <?php
                        } else if ($orderStatus == '1' or $orderStatus == '4') {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order1();">ORDER NOW</button>
                        <?php
                        } else {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order(this);">ORDER NOW</button>
                        <?php
                        }
                        ?>
                    </div>
                    <a href="https://wa.me/<?php echo $workerDetailsData['mobile']; ?>" target="_blank">
                        <i class="bi bi-whatsapp  whatsapp-icon"></i>
                    </a>
                </div>
            <?php
            }
        } else if ($workerDetailreviewsNum > 0) {

            $workerDetailsRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id = category.cate_id  
            INNER JOIN `woker_img` ON worker.email=woker_img.worker_email
            INNER JOIN worker_address add_line1 ON worker.email = add_line1.worker_email
            INNER JOIN worker_address add_line2 ON worker.email = add_line2.worker_email 
            WHERE `email`='" . $workerId . "'");

            $workerDetailNum = $workerDetailsRs->num_rows;

            for ($a = 0; $a < $workerDetailNum; $a++) {
                $workerDetailsData = $workerDetailsRs->fetch_assoc();

            ?>

                <div>
                    <?php
                    if ($workerDetailreviewsData['Like_status'] == '2') {
                    ?>
                        <button style="margin-left: 1340px; margin-top: 10px;" type="button" id="like" onclick="userLike('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-primary"><i class="bi bi-hand-thumbs-up-fill" style="font-size: 25px;"></i></button>
                    <?php
                    } else if ($workerDetailreviewsData['Like_status'] == '1') {
                    ?>
                        <button style="margin-left: 1340px; margin-top: 10px;" type="button" id="like" onclick="userLike('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-primary"><i class="bi bi-hand-thumbs-up-fill" style="font-size: 25px;"></i></button>
                    <?php
                    } else {
                    ?>
                        <button style="margin-left: 1340px; margin-top: 10px;" type="button" id="like" onclick="userLike('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-primary"><i class="bi bi-hand-thumbs-up-fill" style="font-size: 25px;"></i></button>
                    <?php
                    }
                    ?>

                    <button style=" margin-left: 15px; margin-top: 10px;" type="button" id="save" onclick="userSave('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-danger"><i class="bi bi-heart-fill fw-bold" style="font-size: 25px;"></i></button>

                </div>

                <div class="container-fluid sec-bg1 text-white d-flex flex-column align-content-center">
                    <div class="row justify-content-around my-5">
                        <div class="col-12 col-md-2 box d-flex justify-content-center border-0 rounded-circle p-4">

                            <img src="<?php echo $workerDetailsData["profile_path"]; ?>" class="align-content-center logo3 rounded rounded-circle border border-info p-1 text-center bg-dark" />


                        </div>
                        <div class="col-12 col-md-4 box text-dark text-start p-5">
                            <div class="row">
                                <table>
                                    <tbody>
                                        <tr class="p-2">
                                            <th class="col-4 text-dark1 fw-bold">Name :</th>
                                            <td class="text-white1"> <?php echo  $workerDetailsData["fname"] . " " .  $workerDetailsData["lname"]; ?> </td>

                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Worker Category :</th>
                                            <td class="text-white1"><?php echo  $workerDetailsData["cate_name"]; ?></td>

                                        </tr>
                                        <tr class="p-2">

                                            <th class="text-dark1 fw-bold">Address :</th>
                                            <td class="text-white1"> <?php echo  $workerDetailsData["add_line1"] . " " .  $workerDetailsData["add_line2"]; ?> </td>
                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Contact No. :</th>
                                            <td class="text-white1"><?php echo  $workerDetailsData["mobile"]; ?></td>
                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Daily Rate :</th>
                                            <td class="text-white1"> RS. <?php echo  $workerDetailsData["payment"]; ?><b>.</b>00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-10 offset-1 detailsDescription my-4 p-3 px-5">
                        <h4 class="des fw-bold">Description</h4>
                        <br />
                        <p class="fs-6 f-colour ">
                            <?php echo  $workerDetailsData["discription"]; ?>
                        </p>
                    </div>
                    <!-- session_u -->
                    <div>
                        <?php
                        $orderStatus = $workerOrderData['order_status_order_st_id'];
                        if (($orderStatus == '2' or $orderStatus == '5')) {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order(this);">ORDER NOW</button>
                        <?php
                        } else if ($orderStatus == '1' or $orderStatus == '4') {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order1();">ORDER NOW</button>
                        <?php
                        } else {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order(this);">ORDER NOW</button>
                        <?php
                        }
                        ?>
                    </div>
                    <a href="https://wa.me/<?php echo $workerDetailsData['mobile']; ?>" target="_blank">
                        <i class="bi bi-whatsapp  whatsapp-icon"></i>
                    </a>
                </div>
            <?php
            }
        } else  {
//if($workerDetailsave_profileRsNum == 0 && $workerDetailreviewsNum == 0)
            $workerDetailsRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id = category.cate_id  
            INNER JOIN `woker_img` ON worker.email=woker_img.worker_email
            INNER JOIN worker_address add_line1 ON worker.email = add_line1.worker_email
            INNER JOIN worker_address add_line2 ON worker.email = add_line2.worker_email 
            WHERE `email`='" . $workerId . "'");

            $workerDetailNum = $workerDetailsRs->num_rows;

            for ($a = 0; $a < $workerDetailNum; $a++) {
                $workerDetailsData = $workerDetailsRs->fetch_assoc();

            ?>

                <div>
                    <button style="margin-left: 1340px; margin-top: 10px;" type="button" id="like" onclick="userLike('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-primary"><i class="bi bi-hand-thumbs-up-fill" style="font-size: 25px;"></i></button>
                    <button style=" margin-left: 15px; margin-top: 10px;" type="button" id="save" onclick="userSave('<?php echo $workerDetailsData['email']; ?>')" class="btn btn-outline-danger"><i class="bi bi-heart-fill fw-bold" style="font-size: 25px;"></i></button>
                </div>

                <div class="container-fluid sec-bg1 text-white d-flex flex-column align-content-center">
                    <div class="row justify-content-around my-5">
                        <div class="col-12 col-md-2 box d-flex justify-content-center border-0 rounded-circle p-4">

                            <img src="<?php echo $workerDetailsData["profile_path"]; ?>" class="align-content-center logo3 rounded rounded-circle border border-info p-1 text-center bg-dark" />

                        </div>
                        <div class="col-12 col-md-4 box text-dark text-start p-5">
                            <div class="row">
                                <table>
                                    <tbody>
                                        <tr class="p-2">
                                            <th class="col-4 text-dark1 fw-bold">Name :</th>
                                            <td class="text-white1"> <?php echo  $workerDetailsData["fname"] . " " .  $workerDetailsData["lname"]; ?> </td>
                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Worker Category :</th>
                                            <td class="text-white1"><?php echo  $workerDetailsData["cate_name"]; ?></td>
                                        </tr>
                                        <tr class="p-2">

                                            <th class="text-dark1 fw-bold">Address :</th>
                                            <td class="text-white1"> <?php echo  $workerDetailsData["add_line1"] . " " .  $workerDetailsData["add_line2"]; ?> </td>
                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Contact No. :</th>
                                            <td class="text-white1"><?php echo  $workerDetailsData["mobile"]; ?></td>
                                        </tr>
                                        <tr class="p-2">
                                            <th class="text-dark1 fw-bold">Daily Rate :</th>
                                            <td class="text-white1"> RS. <?php echo  $workerDetailsData["payment"]; ?><b>.</b>00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-10 offset-1 detailsDescription my-4 p-3 px-5">
                        <h4 class="des fw-bold">Description</h4>
                        <br />
                        <p class="fs-6 f-colour ">
                            <?php echo  $workerDetailsData["discription"]; ?>
                        </p>
                    </div>
                    <!-- session_u -->
                    <div>
                        <?php
                        $orderStatus = $workerOrderData['order_status_order_st_id'];
                        if (($orderStatus == '2' or $orderStatus == '5')) {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order(this);">ORDER NOW</button>
                        <?php
                        } else if ($orderStatus == '1' or $orderStatus == '4') {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order1();">ORDER NOW</button>
                        <?php
                        } else {
                        ?>
                            <button class="col-6 offset-3 btn buttonColour my-4 fs-5 fw-bolder text-white" data-name="<?php echo $workerId; ?>" onclick="order(this);">ORDER NOW</button>
                        <?php
                        }
                        ?>
                    </div>
                    <a href="https://wa.me/<?php echo $workerDetailsData['mobile']; ?>" target="_blank">
                        <i class="bi bi-whatsapp  whatsapp-icon"></i>
                    </a>
                </div>
        <?php
            }
        }
        ?>

    <?php
    } else {
        echo '<p>No email provided in the URL.</p>';

    }
    include('footer.php');
    ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>