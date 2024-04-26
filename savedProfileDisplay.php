<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Link | Saved Profile</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include('wheader.php') ?>
    <!-- content -->
    <?php
    $userSaveEmail = $_SESSION["u"]["email"];
    ?>
    
    <?php
    $saveWorkerProfileRS = Database::search("SELECT * FROM save_profile WHERE `user_email` = '" . $userSaveEmail . "' AND `save_Status` = '1' ORDER BY id DESC ");
    $saveWorkerProfilNum = $saveWorkerProfileRS->num_rows;

    if ($saveWorkerProfilNum > 0) {
        for ($a = 0; $a < $saveWorkerProfilNum; $a++) {
            $saveWorkerProfileData = $saveWorkerProfileRS->fetch_assoc();
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
                                        LEFT JOIN `order` AS order_status_order_st_id ON worker.email = order_status_order_st_id.worker_email
                                        WHERE `email`='" . $saveWorkerProfileData['worker_email'] . "' 
                                        AND `status_s_id`='2' 
                                        AND `discription` IS NOT NULL
                                        AND (order_status_order_st_id IS NULL OR order_status_order_st_id NOT IN (2, 5))
                                    ");

                                $WorkerNum = $WorkerRs->num_rows;

                                if ($WorkerNum > 0) {

                                    $selectWorkerRs = Database::search("SELECT * FROM `worker`
                                         LEFT JOIN `order` AS order_status_order_st_id ON worker.email = order_status_order_st_id.worker_email
                                        WHERE `email`='" . $saveWorkerProfileData['worker_email'] . "' 
                                        AND `status_s_id`='2' 
                                        AND `discription` IS NOT NULL
                                        AND (order_status_order_st_id IS NULL OR order_status_order_st_id NOT IN (2, 5))
                                        ");

                                    $selectWorkerNum = $selectWorkerRs->num_rows;

                                    if ($selectWorkerNum > 0) {
                                        for ($b = 0; $b < $selectWorkerNum; $b++) {
                                            $selectWorkerData = $selectWorkerRs->fetch_assoc();
                                ?>

                                            <div class="card col-3 border rounded-3 border-dark-subtle">
                                                <img src="img/001.jpg" class="card-img-top mt-2 border rounded-3" />
                                                <div class="card-body">
                                                    <h5 class="card-title text-center fw-bolder text-secondary-emphasis">
                                                        <?php echo $selectWorkerData['fname'] . " " . $selectWorkerData['lname']; ?>
                                                    </h5>
                                                    <p class="card-text my-4">
                                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit molestias eveniet
                                                        consectetur tenetur commodi perferendis rerum, iusto eaque voluptate inventore,
                                                        repudiandae cumque quis ad quae, at quo nesciunt laborum mollitia.
                                                    </p>
                                                    <ul class="list-group list-group-flush">
                                                        <?php
                                                        if (isset($selectWorkerData['order_status_order_st_id'])) {
                                                            $orderStatus = $selectWorkerData['order_status_order_st_id'];
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
                                                        <span style="font-weight: bold; font-size: 16px; margin-left: 10px;">LIKE(<?php echo $selectWorkerData['r_Like'] ?>)</span>
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

        <?php
        }
    } else {
        ?>
        <div class="text-danger text-center fs-2" style="margin-top:100px;">
            <i class="bi bi-person-exclamation fs-1 pe-3"></i> No Save Workers...
        </div>
    <?php
    }

    include('footer.php');
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>