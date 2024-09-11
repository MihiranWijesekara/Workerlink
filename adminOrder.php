<?php
session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {
    $pageno;

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Worker Link &middot; Admin Panel</title>
        <link rel="icon" href="img/el.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </head>

    <body class="sec-bg9">
        <!-- Navigation bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <div class="navbar-brand me-2 text-warning"><i class="bi bi-speedometer2 me-4 fs-4"></i>Worker Link &ndash; Admin Panel</div>
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

        <!-- Content -->
        <div class="container">
            <!-- Search form -->
            <div class="row mt-4 bg-dark1 py-2">
                <div class="col-2 offset-1">
                </div>
                <div class="col-2 offset-1">
                </div>
                <div class="col-4 offset-1">

                    <div class="input-group mb-1">
                        <input type="text" class="form-control" placeholder="Search Worker" id="SearcOrderhworker" />
                        <button class="btn btn-outline-secondary fs-6" type="button" onclick="AdWorkerOrdersearch();">
                            <i class="bi bi-search fs-6 me-2"></i>Search
                        </button>
                    </div>
                </div>
            </div>

            <!-- User table -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <hr />
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th scope="col">Worker Email</th>
                                <th scope="col">User Email</th>
                                <th scope="col">Order Start Date</th>
                                <th scope="col">Worker category</th>
                                <th scope="col">Worker Name</th>
                                <th scope="col-5">User Name</th>
                                <th scope="col">Order status</th>

                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                            <?php
                            $nAdminOrderRs = Database::search("SELECT `order`.*, worker.fname as worker_fname, worker.lname as worker_lname, user.fname as user_fname, user.lname as user_lname , category.cate_name as category_name  FROM `order` INNER JOIN `worker` ON `order`.`worker_email` = `worker`.`email`
                             INNER JOIN `user` ON `order`.`user_email` = `user`.`email` INNER JOIN `category` ON `worker`.`category_id` = `category`.`cate_id` ");

                            $newAdminOrderNum = $nAdminOrderRs->num_rows;

                            if ($newAdminOrderNum  == "0") {
                            ?>
                                <tr>
                                    <td class="text-center text-danger-emphasis fs-2 border-0" colspan="7" style="height: 150px; padding-top:90px;">
                                        <i class="bi bi-bag-check fs-1 pe-3"></i> No Orders...
                                    </td>
                                </tr>
                                <?php
                            } else {
                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }
                                if ($newAdminOrderNum <= 7) {
                                    $result_per_page = $newAdminOrderNum;
                                } else {
                                    $result_per_page = 8;
                                }
                                $count_pages = ceil($newAdminOrderNum / $result_per_page);
                                $page_results = ($pageno - 1) * $result_per_page;

                                $selectAdminOrderRs = Database::search("SELECT `order`.*, worker.fname as worker_fname, worker.lname as worker_lname, user.fname as user_fname, user.lname as user_lname,category.cate_name as category_name
                                FROM `order`
                                INNER JOIN `worker` ON `order`.`worker_email` = `worker`.`email`
                                INNER JOIN `user` ON `order`.`user_email` = `user`.`email`
                                INNER JOIN `category` ON `worker`.`category_id` = `category`.`cate_id`
                                ORDER BY `order_time` DESC LIMIT " . $result_per_page . " OFFSET " . $page_results . " ");

                                $selectAdminOrderNum =  $selectAdminOrderRs->num_rows;

                                if ($selectAdminOrderNum == 0) {
                                ?>
                                    <tr>
                                        <td class="text-center text-danger-emphasis fs-2 border-0" colspan="7" style="height: 150px; padding-top:90px;">
                                            <i class="bi bi-bag-check fs-1 pe-3"></i> No Orders...
                                        </td>
                                    </tr>
                                    <?php
                                } else {
                                    for ($x = 0; $x < $selectAdminOrderNum; $x++) {
                                        $newAdminOrderData = $selectAdminOrderRs->fetch_assoc();

                                    ?>
                                        <tr>
                                            <td><?php echo $newAdminOrderData['worker_email']; ?></td>
                                            <td><?php echo $newAdminOrderData['user_email']; ?></td>
                                            <td><?php echo $newAdminOrderData['order_time']; ?></td>
                                            <td><?php echo $newAdminOrderData['category_name']; ?></td>
                                            <td><?php echo $newAdminOrderData['worker_fname'] . ' ' . $newAdminOrderData['worker_lname']; ?></td>
                                            <td><?php echo $newAdminOrderData['user_fname'] . ' ' . $newAdminOrderData['user_lname']; ?></td>
                                            <td>
                                                <?php
                                                $orderStatus =  $newAdminOrderData['order_status_order_st_id'];
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
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- User table end -->

            <?php

            if ($newAdminOrderNum > 8) {
            ?>
                <div class="d-flex align-content-center justify-content-center col-12 text-center mb-3 mt-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-lg justify-content-center" id="pageMove">
                            <li class="page-item">
                                <a class="page-link text-secondary" href="
                    <?php if ($pageno <= 1) {
                        echo ("#");
                    } else {
                        echo "?page=" . ($pageno - 1);
                    } ?>" aria-label="Previous">
                                    <span aria-hidden="true"><i class="bi bi-caret-left-fill fs-5"></i></span>
                                </a>
                            </li>

                            <?php

                            for ($y = 1; $y <= $count_pages; $y++) {
                                if ($y == $pageno) {
                            ?>
                                    <li class="page-item active">
                                        <a class="page-link bg-secondary btn btn-secondary" href="<?php echo "?page=" . $y; ?>"> <?php echo $y; ?> </a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo "?page=" . $y; ?> "> <?php echo $y; ?> </a>
                                    </li>
                            <?php
                                }
                            }
                            ?>

                            <li class="page-item">
                                <a class="page-link text-secondary" href="
                    <?php if ($pageno >= $count_pages) {
                        echo ("#");
                    } else {
                        echo "?page=" . ($pageno + 1);
                    } ?>
                " aria-label="Next">
                                    <span aria-hidden="true"><i class="bi bi-caret-right-fill fs-5"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php
            }

            ?>
        </div>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
}
?>