<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Link | User Order View</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    require "wheader.php";

    $UserOrderEmail =  $_SESSION["u"]["email"];

    $UserOrderDetailsRs = Database::search("SELECT * FROM `order` WHERE `user_email`='$UserOrderEmail'ORDER BY `order_time` DESC");
    $UserOrderDetailNum = $UserOrderDetailsRs->num_rows;


    ?>
    <div class="container-fluid bgm-userOrderView text-white justify-content-center">
        <div class="row align-content-center">
            <div class="col-12 my-4 px-3">
                <table class="table usertable col-12 text-black tborder">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="col-2 tborder">First Name</th>
                            <th scope="col" class="col-3 tborder">Last Name</th>
                            <th scope="col" class="col-2 tborder"> Category</th>
                            <th scope="col" class="col-1 tborder">Status</th>
                            <th scope="col" class="col-2 tborder">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($UserOrderDetailNum > 0) {
                            for ($a = 0; $a < $UserOrderDetailNum; $a++) {
                                $UserOrderDetailsData = $UserOrderDetailsRs->fetch_assoc();
                                $WorkerDetailsRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id = category.cate_id 
                             WHERE `email`='$UserOrderDetailsData[worker_email]'");
                                $WorkerDetailsData = $WorkerDetailsRs->fetch_assoc();

                        ?>
                                <tr>
                                    <td scope="row" class="col-2 px-3  tborder"><?php echo $WorkerDetailsData["fname"]; ?></td>
                                    <td class="col-3 px-3 tborder"><?php echo $WorkerDetailsData["lname"]; ?></td>
                                    <td class="col-2 px-3 tborder"><?php echo $WorkerDetailsData["cate_name"]; ?></td>
                                    <td class="col-1 px-3 tborder">

                                        <?php
                                        $orderStatus = $UserOrderDetailsData['order_status_order_st_id'];
                                        if ($orderStatus == 1) {
                                        ?>
                                            <span class="badge rounded-pill text-bg-primary p-2 px-4 fs-6">Active</span>
                                        <?php
                                        } elseif ($orderStatus == 2) {
                                        ?>
                                            <span class="badge rounded-pill text-bg-danger p-2 px-4 fs-6">Cancel</span>
                                        <?php
                                        } elseif ($orderStatus == 4) {
                                        ?>
                                            <span class="badge rounded-pill text-bg-warning p-2 px-4 fs-6">Pending</span>
                                        <?php
                                        } elseif ($orderStatus == 5) {
                                        ?>
                                            <span class="badge rounded-pill text-bg-success p-2 px-4 fs-6">Complete</span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="col-2 px-3 tborder">
                                        <div class="form-check form-switch d-flex justify-content-center">
                                            <?php
                                            $orderStatus = $UserOrderDetailsData['order_status_order_st_id'];
                                            if ($orderStatus == 1) {
                                                echo '<p style="color: blue; font-weight: bold;"> Active Order...</p>';
                                            } elseif ($orderStatus == 2) {
                                                echo '<p style="color: red; font-weight: bold;">Cancel Order...</p>';
                                            } elseif ($orderStatus == 4) {

                                                echo '<button class="btn btn-danger ms-5 fw-bolder p-1 px-4 fs-6" onclick="UserOrderProcess(\'' . $UserOrderDetailsData["order_id"] . '\',\'cancel\')">Cancel</button>';
                                            } else if ($orderStatus == 5) {
                                                echo '<p style="color: green; font-weight: bold;"> Complete Order...</p>';
                                            }

                                            ?>
                                        </div>
                                    </td>
                                    
                                </tr>

                        <?php
                            }
                        } else {
                            echo '<tr>
                                    <td class="text-center text-danger-emphasis fs-2 border-0" colspan="7" style="height: 150px; padding-top:90px;">
                                    <i class="bi bi-bag-check fs-1 pe-3"></i>
                                    No Orders...
                                    </td>
                                </tr>';
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <?php

    include('footer.php');

    ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>