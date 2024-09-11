<?php
session_start();

require "connection.php";

?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Link | Worker Profile</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php

    require "wheader.php";

    if (isset($_SESSION["u"]["category_id"])) {

        $email = $_SESSION["u"]["email"];

        $workerRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id=cate_id
            INNER JOIN `status` ON worker.status_s_id=status.s_id INNER JOIN `gender` ON worker.gender_id=gender.id 
             INNER JOIN `woker_img` ON worker.email=woker_img.worker_email WHERE `email`='" . $email . "' ");

        $workerdata = $workerRs->fetch_assoc();

        $add = Database::search("SELECT * FROM `worker` INNER JOIN `worker_address` ON worker.email=worker_address.worker_email 
        INNER JOIN `city` ON worker_address.city_city_id=city.city_id 
        INNER JOIN `district` ON city.district_district_id=district.district_id 
        INNER JOIN `province` ON district.province_province_id=province.province_id WHERE `worker_email`='" . $email . "' ");

        $adData = $add->fetch_assoc();

    ?>
        <div class="container-fluid text-white bgm">
            <div class="row py-4">
                <div class="col-md-4 text-center border-end viewn">
                    <div class="col-12 mt-5">
                        <br /><br /><br />
                        <h1 class="fw-bold text-white">Worker Profile Settings</h1>
                    </div>
                    <div class="col-6 offset-3 mt-5 pt-5">
                        <img src="img/el.png" class="logo3" />
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 text-white">
                    <div class="p-3 py-3">
                        <div class="d-flex flex-column justify-content-center align-items-center mb-5">

                            <?php
                            if (empty($workerdata["profile_path"])) {
                            ?>
                                <img src="img/wicon.png" class="my-4 logo rounded rounded-circle border border-info p-1" />
                            <?php
                            } else {
                            ?>
                                <img src="<?php echo ($workerdata["profile_path"]); ?>" class="my-4 logo rounded rounded-circle border border-info p-1" alt="No Load Profile Image" />
                            <?php
                            }
                            ?>
                            <input type="file" id="pimg" class="d-none" />
                            <label for="pimg" class="btn btn-info p-2 px-3 my-3">
                                <i class="bi bi-file-image me-2"></i> Update Profile Image
                            </label>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6 mb-4">
                                <?php
                                $workerRs = Database::search("SELECT fname FROM `worker` WHERE `email`='" . $email . "'");
                                $workerdata = $workerRs->fetch_assoc();
                                ?>

                                <label class="form-label text-danger-emphasis">First Name</label>
                                <input type="text" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($workerdata["fname"]); ?>" placeholder="mark" disabled />

                            </div>

                            <div class="col-6 mb-4">
                                <?php
                                $workerRs = Database::search("SELECT lname FROM `worker` WHERE `email`='" . $email . "'");
                                $workerdata = $workerRs->fetch_assoc();
                                ?>
                                <label class="form-label text-danger-emphasis">Last Name</label>
                                <input type="text" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($workerdata["lname"]); ?>" placeholder="zuckerberg" disabled />
                            </div>

                            <?php
                            $workerRs = Database::search("SELECT nic FROM `worker` WHERE `email`='" . $email . "'");
                            $workerdata = $workerRs->fetch_assoc();
                            ?>

                            <?php
                            if (empty($workerdata["nic"])) {
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
                                    <input type="text" id="nic" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($workerdata["nic"]); ?>" disabled />
                                </div>
                            <?php
                            }
                            ?>
                            <div class="col-6 mb-4">
                                <?php
                                $workerRs = Database::search("SELECT email FROM `worker` WHERE `email`='" . $email . "'");
                                $workerdata = $workerRs->fetch_assoc();
                                ?>
                                <label class="form-label text-danger-emphasis">Email</label>
                                <input type="text" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($workerdata["email"]); ?>" disabled />
                            </div>
                           
                            <div class="col-6 mb-4">
                                <?php
                                $workerRs = Database::search("SELECT mobile FROM `worker` WHERE `email`='" . $email . "'");
                                $workerdata = $workerRs->fetch_assoc();
                                ?>
                                <label class="form-label text-danger-emphasis">Mobile Number</label>
                                <input type="text" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($workerdata["mobile"]); ?>" disabled />
                            </div>
                            <?php
                            if (empty($adData["add_line1"])) {
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
                                    <input type="text" id="line1" class="form-control" value="<?php echo ($adData["add_line1"]); ?>" />
                                </div>
                            <?php
                            }

                            if (empty(($adData["add_line2"]))) {
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
                                    <input type="text" id="line2" class="form-control" value="<?php echo ($adData["add_line2"]); ?>" />
                                </div>
                            <?php
                            }

                            $city_rs = Database::search("SELECT * FROM `city`");
                            $dist_rs = Database::search("SELECT * FROM `district`");
                            $prov_rs = Database::search("SELECT * FROM `province`");

                            $city_num = $city_rs->num_rows;
                            $dist_num = $dist_rs->num_rows;
                            $prov_num = $prov_rs->num_rows;

                            ?>

                            <div class="col-6 mb-4">
                                <label class="form-label">City</label>
                                <select class="form-select" id="city">
                                    <option value="0">Select City</option>
                                    <?php
                                    for ($z = 0; $z < $city_num; $z++) {
                                        $city_data = $city_rs->fetch_assoc();
                                    ?>
                                        <option value='<?php echo ($city_data["city_id"]); ?>' <?php
                                                                                                if (!empty($workerdata["city_city_id"])) {
                                                                                                    if ($city_data["city_id"] == $workerdata["city_city_id"]) {
                                                                                                ?> selected <?php
                                                                                                        }
                                                                                                    }
                                                                                                            ?>>
                                            <?php echo ($city_data["city_name"]); ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-6 mb-4">
                                <label class="form-label">District</label>
                                <select class="form-select" id="district">
                                    <option value="0">Select District</option>
                                    <?php
                                    for ($y = 0; $y < $dist_num; $y++) {
                                        $dis_data = $dist_rs->fetch_assoc();
                                    ?>
                                        <option value='<?php echo ($dis_data["district_id"]); ?>' <?php
                                                                                                    if (!empty($workerdata["district_district_id"])) {
                                                                                                        if ($dis_data["district_id"] == $workerdata["district_district_id"]) {
                                                                                                    ?> selected <?php
                                                                                                            }
                                                                                                        } ?>>
                                            <?php echo ($dis_data["district_name"]); ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-6 mb-4">
                                <label class="form-label">Province</label>
                                <select class="form-select" id="province">
                                    <option value="0">Select Province</option>
                                    <?php
                                    for ($x = 0; $x < $prov_num; $x++) {
                                        $prov_data = $prov_rs->fetch_assoc();
                                    ?>
                                        <option value='<?php echo ($prov_data["province_id"]); ?>' <?php if (!empty($workerdata["province_province_id"])) {
                                                                                                        if ($prov_data["province_id"] == $workerdata["province_province_id"]) {
                                                                                                    ?> selected <?php
                                                                                                            }
                                                                                                        } ?>>
                                            <?php echo ($prov_data["province_name"]); ?>
                                        </option>
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
                            <?php 
                            if (empty($adData["gig_d"])) {
                            ?>
                            <div class="col-6 mb-4">
                                <label class="form-label">Gig Discription</label>
                                <input type="text" id="GIg_d" class="form-control" placeholder="Enter Your Gig Discription" />
                            </div>
                            <?php 
                            } else {
                                ?>
                                  <div class="col-6 mb-4">
                                    <label class="form-label">Gig Discription</label>
                                    <input type="text" id="GIg_d" class="form-control" value="<?php echo ($adData["gig_d"]); ?>" />
                                </div>

                                <?php
                            }
                            ?>

                            <div class="col-6 mb-4">
                                <label class="form-label">Gig Image</label>
                                <input type="file" id="gig_image" class="form-control" />
                            </div>
                            <div class="col-6 mb-4">
                                <?php
                                $workerRs = Database::search("SELECT cate_name FROM `worker` INNER JOIN `category` ON worker.category_id=cate_id WHERE `email`='" . $email . "'");
                                $workerdata = $workerRs->fetch_assoc();
                                ?>
                                <label class="form-label text-danger-emphasis">Worker Category</label>
                                <input type="text" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($workerdata["cate_name"]); ?>" Disabled />
                            </div>

                            <?php
                            $workerRs = Database::search("SELECT payment FROM `worker` WHERE `email`='" . $email . "'");
                            $workerdata = $workerRs->fetch_assoc();
                            ?>

                            <?php
                            if (empty($workerdata["payment"])) {
                            ?>
                                <div class="col-6 mb-4">
                                    <label class="form-label">Payment</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" id="pay" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="1000000XXXX" />
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-6 mb-4">
                                    <label class="form-label text-danger-emphasis">Payment</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-danger-emphasis bg-danger-subtle border-danger">Rs.</span>
                                        <input type="text" id="pay" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" aria-label="Amount (to the nearest dollar)" value="<?php echo ($workerdata["payment"]); ?>" disabled />
                                        <span class="input-group-text text-danger-emphasis bg-danger-subtle border-danger">.00</span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <div class="col-6 mb-4">
                                <?php
                                $workerRs = Database::search("SELECT regdate FROM `worker` WHERE `email`='" . $email . "'");
                                $workerdata = $workerRs->fetch_assoc();
                                ?>

                                <label class="form-label text-danger-emphasis">Registered Date</label>
                                <input type="text" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($workerdata["regdate"]); ?>" Disabled />
                            </div>
                            <div class="col-6 mb-4">
                                <?php
                                $workerRs = Database::search("SELECT gender FROM `worker` INNER JOIN `gender` ON worker.gender_id=gender.id  WHERE  `email`='" . $email . "'");
                                $workerdata = $workerRs->fetch_assoc();
                                ?>
                                <label class="form-label text-danger-emphasis">Gender</label>
                                <input type="text" class="form-control text-center text-danger-emphasis bg-danger-subtle border-danger" value="<?php echo ($workerdata["gender"]); ?>" Disabled />
                            </div>

                            <?php
                            $workerRs = Database::search("SELECT discription FROM `worker` WHERE `email`='" . $email . "'");
                            $workerdata = $workerRs->fetch_assoc();
                            ?>


                            <?php
                            if (empty($workerdata["discription"])) {
                            ?>
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control p-3" id="dis" placeholder="Add Your Profile Description Here." style="height: 100px;"></textarea>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-12">
                                    <label class="form-label text-danger-emphasis">Description</label>
                                    <textarea class="form-control p-3" id="dis" style="height: 100px;"><?php echo ($workerdata["discription"]); ?></textarea>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="offset-2 col-8 d-grid mt-5">
                                <button class="btn btn-info" onclick="updateProfile();">Update My Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    require "footer.php";
    ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>