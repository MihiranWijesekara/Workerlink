<?php

require "connection.php";

$catid = $_GET["c"];

$nWorkerCaRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` 
ON worker.category_id = category.cate_id WHERE `status_s_id`='1'");

$newWorkerNum = $nWorkerCaRs->num_rows;

$selectWorkerRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id= category.cate_id 
        WHERE `category_id`='" . $catid . "' AND `status_s_id`='1' ");

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

$selectWorkerRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id= category.cate_id 
WHERE `category_id`='" . $catid . "' AND `status_s_id`='1' ");

$selectWorkerNum = $selectWorkerRs->num_rows;

?>

<li class="page-item">
    <a class="page-link text-secondary" href="
                                <?php if ($pageno <= 1) 
                                {
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