<?php

session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {
    $pageno;
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

        <!-- Content -->
        <div class="container">
            <div class="row mt-4 bg-dark1 py-2">
                
                    <div class="col-2 offset-1">
                        <div class="input-group">
                            <select class="form-select form-select-lg mb-3 btn btn-secondary dropdown-toggle" id="selectcate" onchange="manageload();">
                                <option value="0" selected>Worker Category</option>
                                <?php

                                $wCategoryRs = Database::search("SELECT * FROM `category`");
                                $wCategoryNum = $wCategoryRs->num_rows;

                                for ($x = 0; $x < $wCategoryNum; $x++) {
                                    $wdata = $wCategoryRs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($wdata["cate_id"]); ?>">
                                        <?php echo ($wdata["cate_name"]); ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-5 offset-2">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search Workers" id="SearchWork" />
                            <button class="btn btn-outline-secondary fs-6" type="button" onclick="AdWosearch();">
                                <i class="bi bi-search fs-6 me-2"></i>Search
                            </button>
                        </div>
                    </div>
                
            </div>

            <!-- Table -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <hr />
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Category</th>
                                <th scope="col">CV</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="wdtable">
                            <?php
                            $nWorkerCaRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` 
                          ON worker.category_id = category.cate_id WHERE `status_s_id`='1'");

                            $newWorkerNum = $nWorkerCaRs->num_rows;

                            if ($newWorkerNum == "0") {
                            ?>
                                <tr>
                                    <td class="text-center text-danger-emphasis fs-2 border-0" colspan="7" style="height: 150px; padding-top:90px;">
                                        <i class="bi bi-person-exclamation fs-1 pe-3"></i> Not Workers Registerd Recently.
                                    </td>
                                </tr>

                                <?php
                            } else {
                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }
                                if ($newWorkerNum <= 7) {

                                    $result_per_page = $newWorkerNum;
                                } else {
                                    $result_per_page = 8;
                                }

                                $count_pages = ceil($newWorkerNum / $result_per_page);

                                $page_results = ($pageno - 1) * $result_per_page;

                                $selectWorkerRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id = category.cate_id 
                                                                WHERE `status_s_id`='1' ORDER BY `regdate` DESC LIMIT " . $result_per_page . " OFFSET " . $page_results . " ");

                                $selectWorkerNum = $selectWorkerRs->num_rows;

                                if ($selectWorkerNum == "0") {
                                ?>
                                    <tr>
                                        <td class="text-center text-danger-emphasis fs-2 border-0" colspan="7" style="height: 150px; padding-top:90px;">
                                            <i class="bi bi-person-exclamation fs-1 pe-3"></i> Not Workers Registerd Recently.
                                        </td>
                                    </tr>

                                    <?php
                                } else {
                                    for ($x = 0; $x < $selectWorkerNum; $x++) {
                                        $newWorkerData = $selectWorkerRs->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo ($newWorkerData["fname"]); ?>
                                            </td>
                                            <td>
                                                <?php echo ($newWorkerData["lname"]); ?>
                                            </td>
                                            <td>
                                                <?php echo ($newWorkerData["email"]); ?>
                                            </td>
                                            <td>
                                                <?php echo ($newWorkerData["mobile"]); ?>
                                            </td>
                                            <td>
                                                <?php echo ($newWorkerData["cate_name"]); ?>
                                            </td>
                                            <td>
                                                <a class="text-danger" href="<?php echo ($newWorkerData["file_path"]); ?>" title="Download Here.">
                                                    <i class="bi bi-file-earmark-zip-fill fs-5"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input bg-warning border border-dark" type="checkbox" role="switch" onchange="activeAcc(<?php echo ($newWorkerData['mobile']); ?>);" />
                                                    <label class="form-check-label text-warning1 fw-bold">Active</label>
                                                </div>
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
            <!-- Table end -->
            <!-- Pagenation -->
            <?php

            if ($newWorkerNum > 8) {

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
                                        <a class="page-link bg-secondary btn btn-secondary" href="<?php echo "?page=" . $y; ?>">
                                            <?php echo $y; ?>
                                        </a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo "?page=" . $y; ?> ">
                                            <?php echo $y; ?>
                                        </a>
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
            <!-- Pagenation -->
        </div>
        <!-- Content end -->
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>
    </html>
<?php
}
?>