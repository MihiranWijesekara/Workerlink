<?php

session_start();

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Link | Worker Order View</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="bgm-userOrderView">
    <?php require "wheader.php" ?>

    <?php

    $workerOrderEmail =  $_SESSION["u"]["email"];
    $workerOrderDetailsRs = Database::search("SELECT * FROM `order` WHERE `worker_email`='$workerOrderEmail' ORDER BY `order_time` DESC");
    $workerOrderDetailNum = $workerOrderDetailsRs->num_rows;
    ?>

    <div class="container">
        <!-- content -->
          

        <!-- table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <hr />
                <table class="table table-bordered mt-5 tborder">
                    <thead>
                        <tr class="text-center tborder">
                            <th class="text-dark tborder">First Name</th>
                            <th class="text-dark tborder">Last Name</th>
                            <th class="text-dark tborder">Mobile</th>
                            <th class="text-dark tborder">Address</th>
                            <th class="text-dark tborder">Order Status</th>
                            <th class="text-dark tborder">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($workerOrderDetailNum > 0) {
                            for ($a = 0; $a < $workerOrderDetailNum; $a++) {
                                $workerOrderDetailsData = $workerOrderDetailsRs->fetch_assoc();
                                $userDetailsRs = Database::search("SELECT * FROM `user` WHERE `email`='$workerOrderDetailsData[user_email]'");
                                $userAddressDetailsRs = Database::search("SELECT * FROM `user_address` WHERE `user_email`='$workerOrderDetailsData[user_email]'");
                                $userDetailsData = $userDetailsRs->fetch_assoc();
                                $userAddressDetailsData = $userAddressDetailsRs->fetch_assoc();
                        ?>
                                <tr class="tborder">
                                    <td class="text-dark tborder"><?php echo $userDetailsData["fname"]; ?></td>
                                    <td class="text-dark tborder"><?php echo $userDetailsData["lname"]; ?></td>
                                    <td class="text-dark tborder"><?php echo $userDetailsData["mobile"]; ?></td>
                                    <td class="text-dark tborder"><?php echo $userAddressDetailsData["ad_line1"] . " " . $userAddressDetailsData["ad_line2"]; ?></td>
                                    <td class="text-center text-white tborder">
                                        <?php
                                        $orderStatus = $workerOrderDetailsData['order_status_order_st_id'];
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
                                            <span class="badge rounded-pill text-bg-success p-2 px-4 fs-6">Completed</span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center tborder">
                                        <div class="form-check form-switch d-flex justify-content-center">
                                            <?php
                                            $orderStatus = $workerOrderDetailsData['order_status_order_st_id'];
                                            if ($orderStatus == 1) {
                                            ?>
                                            <button type="button" class="btn btn-success ms-5 fw-bolder p-1 px-4 fs-6" onclick='orderVcode("<?php echo $workerOrderDetailsData["order_id"]; ?>", "Complete");'>
                                                    Complete
                                                </button>
                                            <?php
                                            } elseif ($orderStatus == 2) {
                                            ?>
                                                <p style="color: red; font-weight: bold;">Cancel Order...</p>
                                            <?php
                                            } elseif ($orderStatus == 4) {
                                            ?>
                                                <button class="btn btn-primary ms-5 fw-bolder p-1 px-4 fs-60" onclick='orderVcode("<?php echo $workerOrderDetailsData["order_id"]; ?>", "active")'>Active</button>
                                                <button class="btn btn-danger ms-5 fw-bolder p-1 px-4 fs-6" onclick='orderVcode("<?php echo $workerOrderDetailsData["order_id"]; ?>", "cancel")'>Cancel</button>
                                            <?php
                                            } else if ($orderStatus == 5) {
                                            ?>
                                                <p style="color: green; font-weight: bold;"> Complete Order...</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php

                            }
                        } else {
                            ?>
                            <tr>
                                <td class="text-center text-danger-emphasis fs-2 border-0" colspan="7" style="height: 150px; padding-top:90px;">
                                    <i class="bi bi-bag-check fs-1 pe-3"></i> No Orders...
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
        <!-- table end -->
        <!-- content -->

        <!-- model -->
        <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="modelemvc">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Process Verification Code</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label class="fw-bold text-muted mb-2">Enter Verification Code</label>
                            </div>
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="emc" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick='compro();'>Verify Process.</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- model -->

    </div>

    <?php


    include('footer.php');
    ?>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>