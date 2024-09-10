<?php
session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Link | Name Workers</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include('wheader.php') ?>
    <!-- content -->
    <?php
    if (isset($_GET['cid'])) {
        $catid = $_GET['cid'];
        $pageno;
    ?>

        <div class="container-fluid w-100 d-flex justify-content-center sec-bg1">
            <!-- items -->
            <div class="col-12 my-5">
                <div class="row">
                    <div class="col-12">
                        <div class="row justify-content-around gap-5 mb-5">
                            <?php

                            $WorkerRs = Database::search("SELECT * 
                            FROM `worker`
                            INNER JOIN `category` ON worker.category_id = category.cate_id 
                            LEFT JOIN `order` AS order_status_order_st_id ON worker.email = order_status_order_st_id.worker_email
                            WHERE `cate_id`='" . $catid . "' 
                              AND `status_s_id`='2' 
                              AND `discription` IS NOT NULL
                              
                            ");

                            $WorkerNum = $WorkerRs->num_rows;

                            if ($WorkerNum == "0") {
                            ?>
                                <div class="text-danger text-center fs-2" style="margin-top:100px;">
                                    <i class="bi bi-person-exclamation fs-1 pe-3"></i> Not Registerd This Workers Category.
                                </div>
                                <?php
                            } else {

                                if (isset($_GET['pageno'])) {
                                    $pageno = $_GET["pageno"];
                                } else {
                                    $pageno = 1;
                                }

                                $result_per_page = 5;

                                $count_pages = ceil($WorkerNum / $result_per_page);

                                $page_results = ($pageno - 1) * $result_per_page;

                                $selectWorkerRs = Database::search("SELECT * FROM `worker`
                                INNER JOIN `category` ON worker.category_id = category.cate_id 
                                INNER JOIN `woker_img` ON worker.email = woker_img.worker_email
                                 WHERE `cate_id`='" . $catid . "' 
                                 AND `status_s_id`='2' 
                                 AND `discription` IS NOT NULL 
                                 LIMIT " . $result_per_page . " OFFSET " . $page_results);

                                $selectWorkerNum = $selectWorkerRs->num_rows;

                                if ($selectWorkerNum == "0") {
                                ?>
                                    <tr>
                                        <td class="text-center text-danger-emphasis fs-2 border-0" colspan="7" style="height: 150px; padding-top:90px;">
                                            <i class="bi bi-person-exclamation fs-1 pe-3"></i> Not Registerd This Workers Category.
                                        </td>
                                    </tr>
                                    <?php
                                } else {

                                    for ($a = 0; $a < $selectWorkerNum; $a++) {
                                        $selectWorkerData = $selectWorkerRs->fetch_assoc();
                                    ?>

                                        <div class="card col-3 border rounded-3 border-dark-subtle">
                                            <!--   <img src="img/001.jpg" class="card-img-top mt-2 border rounded-3" /> -->
                                          
                                            <img src="<?php echo ($selectWorkerData["cover_img_path"]); ?>" class="card-img-top mt-2 border rounded-3" alt="No Load Profile Image" />
                                            <div class="card-body">
                                                <h5 class="card-title text-center fw-bolder text-secondary-emphasis">
                                                    <?php echo $selectWorkerData['fname'] . " " . $selectWorkerData['lname']; ?>
                                                </h5>
                                                <p class="card-text my-4">

                                                    <?php echo $selectWorkerData['gig_d']; ?>
                                                </p>
                                                <ul class="list-group list-group-flush">
                                                    <?php
                                                    $WorkerOrderStatusRs = Database::search("SELECT * FROM `order` WHERE worker_email = '{$selectWorkerData['email']}' ORDER BY order_id DESC LIMIT 1");
                                                    $WorkerOrderStatusData = $WorkerOrderStatusRs->fetch_assoc();

                                                    if (isset($WorkerOrderStatusData['order_status_order_st_id'])) {
                                                        $orderStatus = $WorkerOrderStatusData['order_status_order_st_id'];
                                                        if ($orderStatus == '1' or $orderStatus == '4') {
                                                    ?>
                                                            <li class="list-group-item text-danger fw-bolder">Hired</li>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <li class="list-group-item text-success fw-bolder">Available</li>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <li class="list-group-item text-success fw-bolder">Available</li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>

                                                <div>
                                                    <span style="font-weight: bold; font-size: 16px; margin-left: 10px;"><i class="bi bi-hand-thumbs-up-fill  " style="color: blue; font-size: 25px ; margin-left: 1px; "></i>(<?php echo $selectWorkerData['r_Like'] ?>)</span>
                                                </div>
                                                <div>
                                                    <?php
                                                    $workerLike = $selectWorkerData['r_Like'];
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
                                                    } else if ($workerLike > 80) {
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

                                                <br>
                                                <a href="workerDetails.php?email=<?php echo $selectWorkerData['email']; ?>" class="btn btn-secondary text-white d-grid">More Details</a>
                                            </div>
                                        </div>

                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- items End -->
        </div>

        <!-- content End-->

        <!-- pagination -->
        <?php
        if ($WorkerNum != "0") {


            $catid = isset($_GET['cid']) ? $_GET['cid'] : null;
            $pageno = isset($_GET["pageno"]) ? $_GET["pageno"] : 1;

        ?>
            <div class="d-flex align-content-center justify-content-center col-12 text-center mb-3 mt-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center" id="pageMove">
                        <li class="page-item">
                            <a class="page-link text-secondary" href="<?php echo ($pageno <= 1) ? "#" : "workerCategory.php?cid=" . $catid . "&pageno=" . ($pageno - 1); ?>" aria-label="Previous">
                                <span aria-hidden="true"><i class="bi bi-caret-left-fill fs-5"></i></span>
                            </a>
                        </li>

                        <?php
                        for ($y = 1; $y <= $count_pages; $y++) {
                            if ($y == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link bg-secondary btn btn-secondary" href="workerCategory.php?cid=<?php echo $catid; ?>&pageno=<?php echo $y; ?>">
                                        <?php echo $y; ?>
                                    </a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="workerCategory.php?cid=<?php echo $catid; ?>&pageno=<?php echo $y; ?>">
                                        <?php echo $y; ?>
                                    </a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link text-secondary" href="<?php echo ($pageno >= $count_pages) ? "#" : "workerCategory.php?cid=" . $catid . "&pageno=" . ($pageno + 1); ?>" aria-label="Next">
                                <span aria-hidden="true"><i class="bi bi-caret-right-fill fs-5"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php
        }
        ?>
        <!-- pagination end -->

    <?php
    }
    include('footer.php')
    ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>