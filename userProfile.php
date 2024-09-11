<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Link | User Profile</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body clas="">

    <?php
    session_start();
    require "connection.php";

    require "wheader.php";

    $email = $_SESSION["u"]["email"];
    $userRs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON user.gender_id=gender.id INNER JOIN `user_img` ON user.email=user_img.user_email WHERE `email`='" . $email . "' ");
    $userdata = $userRs->fetch_assoc();

    $add = Database::search("SELECT * FROM `user` INNER JOIN `user_address` ON user.email=user_address.user_email 
    INNER JOIN `city` ON user_address.city_city_id=city.city_id 
    INNER JOIN `district` ON city.district_district_id=district.district_id 
    INNER JOIN `province` ON district.province_province_id=province.province_id WHERE `user_email`='" . $email . "' ");

    $adData = $add->fetch_assoc();

    ?>

    <div class="container-fluid text-white sec-bg2">
        <div class="row py-4">
            <div class="col-md-4 text-center border-end">
                <div class="col-12 mt-5">
                    <br /><br /><br />
                    <h1 class="fw-bold text-white">User Profile Settings</h1>
                </div>
                <div class="col-6 offset-3 mt-5 pt-5">
                    <img src="img/el.png" class="logo3" />
                </div>
            </div>

            <div class="col-sm-12 col-md-8">
                <div class="p-3 py-3">
                    <div class="d-flex flex-column justify-content-center align-items-center mb-5">

                        <?php
                        if (empty($userdata["user_pro_img"])) {
                        ?>
                            <img src="img/wicon.png" class="my-4 logo rounded rounded-circle border border-info p-1" />
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo ($userdata["user_pro_img"]); ?>" class="my-4 logo rounded rounded-circle border border-info p-1" alt="No Load Profile Image" />
                        <?php
                        }
                        ?>

                        <input type="file" id="pimg" class="d-none" />
                        <label for="pimg" class="btn btn-info p-2 px-3 my-3">
                            <i class="bi bi-file-image me-2"></i>Update Profile Image
                        </label>
                    </div>
                    <div class="row mt-4">
                    <div class="col-6 mb-4">
                                <?php
                                $workerRs = Database::search("SELECT fname FROM `user` WHERE `email`='" . $email . "'");
                                $userdata = $workerRs->fetch_assoc();
                                ?>

                                <label class="form-label text-danger-emphasis">First Name</label>
                                <input type="text" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($userdata["fname"]); ?>" placeholder="mark" disabled />

                            </div>

                        <div class="col-6 mb-4">
                        <?php
                                $workerRs = Database::search("SELECT lname FROM `user` WHERE `email`='" . $email . "'");
                                $userdata = $workerRs->fetch_assoc();
                                ?>
                            <label class="form-label">Last Name</label>
                            <input type="text" id="lname " class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($userdata["lname"]); ?>" placeholder="zuckerberg" disabled />
                        </div>

                        <?php
                                $workerRs = Database::search("SELECT nic FROM `user` WHERE `email`='" . $email . "'");
                                $workerdata = $workerRs->fetch_assoc();
                                ?>

                        <?php
                        if (empty($userdata["nic"])) {
                        ?>
                            <div class="col-6 mb-4">
                                <label class="form-label">NIC Number</label>
                                <input type="text" id="nic" class="form-control" placeholder="xxxxxxxxxxxx" />
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-6 mb-4">
                                <label class="form-label text-danger-emphasis">NIC Number</label>
                                <input type="text" id="nic" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($userdata["nic"]); ?>" disabled />
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-6 mb-4">
                        <?php
                                $workerRs = Database::search("SELECT email FROM `user` WHERE `email`='" . $email . "'");
                                $userdata = $workerRs->fetch_assoc();
                                ?>
                            <label class="form-label text-danger-emphasis">Email</label>
                            <input type="text" id="email" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($userdata["email"]);  ?>" placeholder="mark@gmail.com" disabled />
                        </div>

                       
                        <div class="col-6 mb-4">
                        <?php
                                $workerRs = Database::search("SELECT mobile FROM `user` WHERE `email`='" . $email . "'");
                                $userdata = $workerRs->fetch_assoc();
                                ?>
                            <label class="form-label">Mobile Number</label>
                            <input type="text" id="mobile" class="form-control" value="<?php echo ($userdata["mobile"]); ?>" placeholder="070 111 234 5" />
                        </div>

                        <?php
                        if (empty($adData["ad_line1"])) {
                        ?>
                            <div class="col-6 mb-4">
                                <label class="form-label">Address Line 01</label>
                                <input type="text" id="line1" class="form-control" placeholder="Enter Address Line 01" />
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-6 mb-4">
                                <label class="form-label">Address Line 01</label>
                                <input type="text" id="line1" class="form-control" value="<?php echo ($adData["ad_line1"]); ?>" />
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if (empty($adData["ad_line2"])) {
                        ?>
                            <div class="col-6 mb-4">
                                <label class="form-label">Address Line 02</label>
                                <input type="text" id="line2" class="form-control" placeholder="Enter Address Line 02" />
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-6 mb-4">
                                <label class="form-label">Address Line 02</label>
                                <input type="text" id="line2" class="form-control" value="<?php echo ($adData["ad_line2"]); ?>" />
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-6 mb-4">
                            <label class="form-label">Province</label>
                            <select class="form-select" id="province">
                                <option value = "0"> Select your Province  </option>
                                <?php
                                $prov_rs = Database::search("SELECT * FROM `province`");
                                $prov_num = $prov_rs->num_rows;

                                for ($x = 0; $x < $prov_num; $x++) {
                                    $prov_data = $prov_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($prov_data["province_id"]); ?>"> <?php echo ($prov_data["province_name"]); ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-6 mb-4">
                            <label class="form-label">District</label>
                            <select class="form-select" id="district">
                            <option value = "0"> Select your district  </option>

                                <?php
                                $dist_rs = Database::search("SELECT * FROM `district`");
                                $dist_num = $dist_rs->num_rows;

                                for ($x = 0; $x < $dist_num; $x++) {
                                    $dist_data = $dist_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo ($dist_data["district_id"]); ?>"><?php echo ($dist_data["district_name"]); ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-6 mb-4">
                            <label class="form-label">City</label>
                            <select class="form-select" id="city">
                            <option value = "0"> Select your city  </option>

                                <?php
                                $city_rs = Database::search("SELECT * FROM `city`");
                                $city_num = $city_rs->num_rows;

                                for ($x = 0; $x < $city_num; $x++) {
                                    $city_data = $city_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo ($city_data["city_id"]); ?>"><?php echo ($city_data["city_name"]); ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                            if (empty($adData["postal_code"])) {
                            ?>
                                <div class="col-6 mb-4">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" id="pc" class="form-control" placeholder="Enter Your Postal Code" />
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-6 mb-4">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" id="pc" class="form-control" value="<?php echo ($adData["postal_code"]); ?>" />
                                </div>
                            <?php
                            }
                            ?>

                        <div class="col-6 mb-4">
                        <?php
                                $workerRs = Database::search("SELECT regdate FROM `user` WHERE `email`='" . $email . "'");
                                $userdata = $workerRs->fetch_assoc();
                                ?>
                            <label class="form-label text-danger-emphasis">Registered Date</label>
                            <input type="text" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($userdata["regdate"]);  ?>" Disabled />
                        </div>
                        <div class="col-6 mb-4">
                        <?php
                                $workerRs = Database::search("SELECT gender FROM `user` INNER JOIN `gender` ON user.gender_id=gender.id  WHERE  `email`='" . $email . "'");
                                $userdata = $workerRs->fetch_assoc();
                                ?>
                            <label class="form-label text-danger-emphasis">Gender</label>
                            <input type="text" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($userdata["gender"]); ?>" Disabled />
                        </div>
                        <div class="offset-2 col-8 d-grid mt-5">
                            <button class="btn btn-info" onclick="updateUserProfile();">Update My Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "footer.php"; ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
