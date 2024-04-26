<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Worker Link &middot; Sign Up</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!-- container -->
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 align-items-center mt-4 pt-3">
                <div class="col-12 border rounded">
                    <div class="row g-0">
                        <!-- bgimg -->
                        <div class="d-none col-md-6 d-md-block position-relative">
                            <div class="img-fluid"></div>
                            <div class="position-absolute top-0 start-0 w-100 h-100 overlay"></div>
                        </div>
                        <!-- bgimg end-->

                        <!-- view -->
                        <div class="col-md-6 overflow-y-auto overflow-x-hidden" style="height:635px;">

                            <div class="card-body my-3">
                                <div class="text-center">
                                    <a href="index.php" class="text-decoration-none">
                                        <img class="logos rounded-circle" src="img/el.jpg" />
                                    </a>
                                </div>
                            </div>

                            <!-- Signup -->

                            <div class="row justify-content-center">
                                <div class="col-11 mt-3 justify-content-center form-floating">
                                    <div class="row">
                                        <div id="msgdiv" class="d-none col-12">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating justify-content-center">
                                                <input type="text" class="form-control mb-3" id="fname" placeholder="Enter your first name" />
                                                <label for="fname">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating justify-content-center">
                                                <input type="text" class="form-control mb-3" id="lname" placeholder="Enter your last name" />
                                                <label for="lname">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating justify-content-center">
                                                <input type="email" class="form-control mb-3" id="email" placeholder="yourname@gmail.com" />
                                                <label for="email">Email</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating justify-content-center">
                                                <input type="password" class="form-control mb-3" id="ps" placeholder="Enter Password" />
                                                <label>Enter Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating justify-content-center">
                                                <input type="password" class="form-control mb-3" id="rps" placeholder="Enter Retype Password" />
                                                <label>Enter Retype Password</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating justify-content-center">
                                                <input type="tel" class="form-control mb-3" id="mobile" placeholder="Your Mobile Number" />
                                                <label for="mobile">WhatsApp Number</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">
                                                <label class="input-group-text">
                                                    <i class="bi bi-person-standing fw-bolder fs-5" style="font-size:15px;"></i>
                                                </label>
                                                <select class="form-select" id="gen" style="height:50px;">
                                                    <option value="0">Select Gender</option>
                                                    <?php
                                                        $g = Database::search("SELECT * FROM `gender`");
                                                        $g_num = $g->num_rows;
                                                        for ($x = 0; $x < $g_num; $x++) {
                                                            $g_data = $g->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo($g_data["id"]); ?>"><?php echo($g_data["gender"]); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="input-group">
                                                <label class="input-group-text border border-danger for=" >
                                                    <i class="bi bi-person-circle text-danger fw-bolder fs-6" style="font-size:10px;"></i>
                                                </label>
                                                <select class="form-select text-danger border border-danger fw-bolder" id="at" style="height:35px;" onchange="showWorkerdetail();">
                                                    <option value="0">Select Your Account Type</option>
                                                    <option value="1">Worker Account</option>
                                                    <option value="2">Customer Account</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row d-none mt-2 mb-4 mt-2" id="cvd">
                                            <div class="col-7">
                                                <div class="input-group">
                                                    <label class="input-group-text border border-success" for="ct">
                                                        <i class="bi bi-person-workspace text-success fw-bolder fs-6" style="font-size:10px;"></i>
                                                    </label>
                                                    <select class="form-select text-success border border-success fw-bolder" id="ct" style="height:35px;">
                                                        <option value="0">Select Category</option>
                                                        <?php
                                                        $crs = Database::search("SELECT * FROM `category` ");
                                                        $crs_num = $crs->num_rows;

                                                        for ($x = 0; $x < $crs_num; $x++) {
                                                            $crs_data = $crs->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo ($crs_data["cate_id"]); ?>"><?php echo ($crs_data["cate_name"]); ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-5 d-grid">
                                                <input type="file" class="d-none" id="wcv" />
                                                <label for="wcv" class="col-12 btn btn-danger fw-bolder fs-6 ms-3" title="Zip File Only.">
                                                    <i class="bi bi-file-earmark-zip fs-6 fw-bold me-2"></i> Upload Your CV
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-10 my-2 mt-3 d-grid offset-1">
                                            <div class="btn btn-primary btn-block fw-bold" id="si" onclick="signup();">Register</div>
                                        </div>
                                        <div class="col-10 my-2 mb-4 d-grid offset-1">
                                            <div class="btn btn-dark btn-block fw-bold" id="lo" onclick="redirectedSignin();">
                                                Already have an account? Login here
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-4">
                                Copyright &copy; 2023 <b> Worker Link </b> Pvt Ltd. || All Rights Reserved.
                            </div>
                            <!-- Signup End -->
                            <!-- view End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container end-->
    </div>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>