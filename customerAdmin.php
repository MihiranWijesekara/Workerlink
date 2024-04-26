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
                        <input type="text" class="form-control" placeholder="Search Customer" id="Searchcustomer" />
                        <button class="btn btn-outline-secondary fs-6" type="button" onclick="AdCustomersearch();">
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
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Email</th>
                                <th scope="col-5">Mobile</th>
                                <th scope="col">Actions</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody">
                            <?php
                            $nCustomerRs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON `user`.`gender_id` = `gender`.`id`");
                            $newCustomerNum = $nCustomerRs->num_rows;

                            if ($newCustomerNum  == "0") {
                            ?>
                                <tr>
                                    <td class="text-center text-danger-emphasis fs-2 border-0" colspan="7" style="height: 150px; padding-top:90px;">
                                        <i class="bi bi-person-exclamation fs-1 pe-3"></i> Not Customers Registerd Recently.
                                    </td>
                                </tr>
                                <?php
                            } else {
                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }
                                if ($newCustomerNum <= 7) {
                                    $result_per_page = $newCustomerNum;
                                } else {
                                    $result_per_page = 8;
                                }
                                $count_pages = ceil($newCustomerNum / $result_per_page);
                                $page_results = ($pageno - 1) * $result_per_page;

                                $selectCustomerRs = Database::search(" SELECT * FROM `user` INNER JOIN `gender` ON `user`.`gender_id` = `gender`.`id` ORDER BY `regdate` DESC LIMIT " . $result_per_page . " OFFSET " . $page_results . " ");

                                $selectCustomerNum =  $selectCustomerRs->num_rows;

                                if ($selectCustomerNum == 0) {
                                ?>
                                    <tr>
                                        <td class="text-center text-danger-emphasis fs-2 border-0" colspan="7" style="height: 150px; padding-top:90px;">
                                            <i class="bi bi-person-exclamation fs-1 pe-3"></i> Not Customer Registerd Recently.
                                        </td>
                                    </tr>
                                    <?php
                                } else {
                                    for ($x = 0; $x < $selectCustomerNum; $x++) {
                                        $newCustomerData = $selectCustomerRs->fetch_assoc();

                                    ?>
                                        <tr>
                                            <td><?php echo $newCustomerData['fname']; ?></td>
                                            <td><?php echo $newCustomerData['lname']; ?></td>
                                            <td><?php echo $newCustomerData['gender']; ?></td>
                                            <td><?php echo $newCustomerData['email']; ?></td>
                                            <td><?php echo $newCustomerData['mobile']; ?></td>
                                            <td>
                                                <div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input bg-warning border border-dark" type="checkbox" role="switch" onchange="deactivateCustomerAcc(<?php echo $newCustomerData['mobile']; ?>, this);" id="flexSwitchCheck<?php echo $newCustomerData['mobile']; ?>" <?php echo ($newCustomerData['status_s_id'] == '3') ? 'checked' : ''; ?>>
                                                        <label class="form-check-label text-warning1 fw-bold" for="flexSwitchCheck<?php echo $newCustomerData['mobile']; ?>">Deactivate</label>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <button class="btn btn-danger delete-btn" data-email="<?php echo $newCustomerData['email']; ?>">Delete</button>
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

            if ($newCustomerNum > 8) {
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
        <script>
            $(document).ready(function() {
                $(".delete-btn").click(function() {
                    var emailToDelete = $(this).data("email");

                    $.ajax({
                        type: "POST",
                        url: "deleteUser.php",
                        data: {
                            email: emailToDelete
                        },
                        success: function(response) {
                            console.log(response);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        },
                        error: function(error) {
                            console.error("Error:", error);
                        }
                    });
                });
            });
        </script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
}
?>
