<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php

    $Email =  $_SESSION["u"]["email"];
    $workerDetailsRs = Database::search("SELECT * FROM `worker` WHERE `email`='$Email'");
    $workerData = $workerDetailsRs->fetch_assoc();

    $userDetailsRs = Database::search("SELECT * FROM `user` WHERE `email`='$Email'");
    $userData = $userDetailsRs->fetch_assoc();
    ?>
    <div class="col-12 p-3 bg-black text-white d-flex flex-column justify-content-center">
        <div class="row align-content-center">
            <div class="col-1 ps-5">
                <a href="index.php" class="text-text-decoration-none">
                    <img src="img/el.png" alt="Logo" class="d-inline-block align-text-top" style="height:75px;" />
                </a>
            </div>
            <?php
            if (isset($_SESSION["u"])) {
            ?>
                <div class="col-3 offset-1 pt-4">
                    <h3 class="text-center text-warning">Hi <?php echo ($_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]); ?></h3>
                </div>
                <?php
                if (isset($_SESSION["u"]["category_id"])) {
                ?>
                    <div class="col-5 offset-2 pt-4">
                        <ul class="list-unstyled list-inline align-content-end fw-bolder">
                            <li class="list-inline-item ho">
                                <?php
                                $notifyStatus = $workerData['Notify'];
                                if ($notifyStatus == 1) {
                                ?>
                                    <a class="text-decoration-none mx-4 text-white fw-bold fs-5 link-primary" onclick="handleOrdersViewClick('worker', '<?php echo $workerData['email']; ?>')" href="workerOrder.php">
                                        <i class="bi bi-cart fw-bold fs-5 me-2"></i>
                                        Orders View
                                        <span><i class="bi bi-exclamation-circle fw-bold fs-5 me-2 link-danger"></i></span>
                                    </a>

                                <?php
                                } else {
                                ?>
                                    <a class="text-decoration-none mx-4 text-white fw-bold fs-5 link-primary" href="workerOrder.php">
                                        <i class="bi bi-cart fw-bold fs-5 me-2"></i>
                                        Orders View

                                    </a>
                                <?php
                                }
                                ?>
                            </li>

                            <li class="list-inline-item">
                                <a class="text-decoration-none mx-4 text-white fw-bold fs-5 link-primary" href="wokerProfile.php">
                                    <i class="bi bi-person-gear fw-bold fs-4 me-2"></i>Worker Profile
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-decoration-none mx-4 text-white fw-bold fs-5 link-primary" href="#" onclick="signout();">
                                    <i class="bi bi-box-arrow-right fw-bold fs-4 me-2"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php
                } else {
                ?>
                    <div class="col-5 offset-2 pt-4">
                        <ul class="list-unstyled list-inline align-content-end fw-bolder">
                            <li class="list-inline-item">
                                <a class="text-decoration-none mx-4 text-white fw-bold fs-5 link-primary" href="userProfile.php">
                                    <i class="bi bi-person-gear fw-bold fs-4 me-2"></i> User Profile
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <?php
                                $notifyStatus = $userData['Notify'];
                                if ($notifyStatus == 1) {
                                ?>
                                    <a class="text-decoration-none mx-4 text-white fw-bold fs-5 link-primary" onclick="handleOrdersViewClick('user', '<?php echo $userData['email']; ?>')" href="userOrderView.php">
                                        <i class="bi bi-cart fw-bold fs-5 me-2"></i>
                                        Orders View
                                        <span><i class="bi bi-exclamation-circle fw-bold fs-5 me-2 link-danger"></i></span>
                                    </a>

                                <?php
                                } else {
                                ?> 
                                        <a class="text-decoration-none mx-4 text-white fw-bold fs-5 link-primary" href="userOrderView.php">
                                        <i class="bi bi-cart fw-bold fs-5 me-2"></i>
                                        Orders View
                                    </a>
                                <?php
                                }
                                ?>
                            </li>

                            <li class="list-inline-item">
                                <a class="text-decoration-none mx-4 text-white fw-bold fs-5 link-primary" href="#" onclick="signout();">
                                    <i class="bi bi-box-arrow-right fw-bold fs-4 me-2"></i> Sign Out
                                </a>
                            </li>
                            
                                <a class="text-decoration-none mx-3 text-white fw-bold fs-5 link-primary" href="savedProfileDisplay.php">
                                    <i class="bi bi-heart-fill fw-bold fs-4 me-2" id="heart-icon"></i>
                                </a>
                            
                            <div class="saved-profile" style="margin-left: 520px;" id="saved-profile">
                                Saved Profile 
                            </div>

                        </ul>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <!-- Header End-->
    <script src="script.js"></script>
</body>

</html>