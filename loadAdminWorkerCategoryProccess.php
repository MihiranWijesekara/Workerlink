<?php

require "connection.php";

if (isset($_GET["c"])) {

    $catid = $_GET["c"];

    $wCategoryRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id= category.cate_id 
    WHERE `category_id`='" . $catid . "' AND `status_s_id`='2'");

    $newWorkerNum = $wCategoryRs->num_rows;

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

        $selectWorkerRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id= category.cate_id 
        WHERE `category_id`='" . $catid . "' AND `status_s_id`='2' ORDER BY `regdate` DESC LIMIT " . $result_per_page . " OFFSET " . $page_results . " ");

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
                    <td><?php echo ($newWorkerData["fname"]); ?></td>
                    <td><?php echo ($newWorkerData["lname"]); ?></td>
                    <td><?php echo ($newWorkerData["email"]); ?></td>
                    <td><?php echo ($newWorkerData["mobile"]); ?></td>
                    <td><?php echo ($newWorkerData["cate_name"]); ?></td>
                    <td>
                        <a class="text-danger" href="<?php echo ($newWorkerData["file_path"]); ?>" title="Dawnload Here.">
                            <i class="bi bi-file-earmark-zip-fill fs-5"></i>
                        </a>
                    </td>
                    <td>
                        <div>
                            <div class="form-check form-switch">
                                <input class="form-check-input bg-warning border-0" type="checkbox" role="switch" onchange="activeAcc(<?php echo ($newWorkerData['mobile']); ?>);" />
                                <label class="form-check-label text-warning fw-bold"> Deactive </label>
                            </div>
                        </div>
                    </td>
                </tr>
<?php
            }
        }
    }
}

?>
