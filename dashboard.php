<?php

session_start();
require "connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Worker Link &middot; Admin Panel</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="sec-bg9">
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="navbar-brand me-2 text-warning"><i class="bi bi-speedometer2 me-4 fs-4"></i>Worker Link &ndash;
                Admin Panel</div>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-5" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item me-2">
                        <a class="nav-link" href="admin.php"><i class="bi bi-person-plus"></i> Register</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="adminOrder.php"><i class="bi bi-cart"></i> Order</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="customerAdmin.php"><i class="bi bi-people"></i> Customers</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="workerAdmin.php"><i class="bi bi-person-workspace"></i> Workers</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" onclick="adminLogout();" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation bar end -->
    <div class="container">


        <div class="row mt-5">
            <div class="col-sm-4  ">
                <?php
                $result = Database::search("SELECT COUNT(*) AS total_customers FROM user");
                if ($row = $result->fetch_assoc()) {
                    $total_customers = $row['total_customers'];
                } else {
                    $total_customers = 0;
                }
                ?>

                <div class="card background-c" style="width: 18rem; height:15rem">
                    <div class="card-body">
                        <h4 class="card-title text-align: center; " style="color:white" >Total Customers</h4>
                        <h1 class="card-text1" style="color:white" > <?php echo $total_customers; ?></h1>

                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <?php
                $result = Database::search("SELECT COUNT(*) AS total_workers FROM worker");
                if ($row = $result->fetch_assoc()) {
                    $total_workers = $row['total_workers'];
                } else {
                    $total_workers = 0;
                }
                ?>
                <div class="card total_worker " style="width: 18rem; height:15rem">
                    <div class="card-body">
                        <h4 class="card-title" style="color:white" >Total Workers</h4>
                        <p class="card-text1" style="color:white"> <?php echo $total_workers; ?> </p>

                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <?php
                $result = Database::search("SELECT COUNT(*) AS total_suspend_workers FROM worker Where status_s_id = 3 ");
                if ($row = $result->fetch_assoc()) {
                    $total_suspend_workers = $row['total_suspend_workers'];
                } else {
                    $total_suspend_workers = 0;
                }
                ?>
                <div class="card background-sW " style="width: 18rem; height:15rem">
                    <div class="card-body">
                        <h5 class="card-title" style="font-size:20px; color:white">Total Suspend Workers</h5>
                        <p class="card-text1"style="color:white"> <?php echo $total_suspend_workers; ?></p>

                    </div>
                </div>
            </div>
        </div>
        <!-- second ---->
        <div class="row mt-4">

            <div class="col-sm-4">
                <?php

                $result = Database::search("SELECT COUNT(*) AS total_complete_order FROM `order` WHERE order_status_order_st_id = 5");

                if ($row = $result->fetch_assoc()) {
                    $total_complete_order = $row['total_complete_order'];
                } else {
                    $total_complete_order = 0;
                }

                ?>
                <div class="card complet_order " style="width: 18rem; height:15rem">
                    <div class="card-body">
                        <h4 class="card-title" style="color:white">Total Complete Order</h4>
                        <p class="card-text1" style="color:white" ><?php echo $total_complete_order; ?></p>

                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <?php

                $result = Database::search("SELECT COUNT(*) AS total_pending_order FROM `order` WHERE order_status_order_st_id = 4");

                if ($row = $result->fetch_assoc()) {
                    $total_pending_order = $row['total_pending_order'];
                } else {
                    $total_pending_order = 0;
                }

                ?>
                <div class="card pending_order " style="width: 18rem; height:15rem">
                    <div class="card-body">
                        <h4 class="card-title"style="color:white">Total Pending Order</h4>
                        <p class="card-text1" style="color:white"><?php echo $total_pending_order; ?></p>

                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <?php

                $result = Database::search("SELECT COUNT(*) AS total_cancel_order FROM `order` WHERE order_status_order_st_id = 2");

                if ($row = $result->fetch_assoc()) {
                    $total_cancel_order = $row['total_cancel_order'];
                } else {
                    $total_cancel_order = 0;
                }

                ?>
                <div class="card cancel_order " style="width: 18rem; height:15rem">
                    <div class="card-body">
                        <h4 class="card-title"style="color:white">Total Cancel Order</h4>
                        <p class="card-text1"style="color:white"><?php echo $total_cancel_order; ?></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
