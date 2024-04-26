<?php

session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Link | Workers Category</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include('wheader.php');

    if (isset($_SESSION["u"])) {

    ?>
        <!-- content -->
        <div class="container-fluid w-100 d-flex justify-content-center sec-bg1">
            <!-- items -->
            <div class="col-12 my-5">
                <div class="row">
                    <div class="col-12">
                        <div class="row justify-content-around gap-5 mb-5">
                            <?php
                            $crs = Database::search("SELECT * FROM `category`");
                            $cnum = $crs->num_rows;
                            for ($x = 0; $x < $cnum; $x++) {
                                $cdata = $crs->fetch_assoc();
                            ?>
                                <div class="card col-lg-3 col-12 border rounded-3 border-dark-subtle my-4">
                                    <img src="<?php echo ($cdata["cate_img_path"]); ?>" class="card-img-top mt-2 border rounded-3" style="height: 220px;" />
                                    <div class="card-body card-background">
                                        <h4 class="card-title text-center fw-bolder text-secondary-emphasis text-uppercasen head">
                                            <?php echo ($cdata["cate_name"]); ?>
                                        </h4>
                                        <p class="card-text my-4 font-style" style="height: 120px;">
                                            <?php echo ($cdata["cate_disc"]); ?>
                                        </p>
                                        <a class="btn btn-secondary text-white d-grid fw-bolder mb-3 fs-6" href="workerCategory.php?cid=<?php echo $cdata['cate_id']; ?>">
                                            Select Workers
                                        </a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- items End -->
        </div>
        </div>
        <!-- content End-->
    <?php
    }
    include('footer.php');
    ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
