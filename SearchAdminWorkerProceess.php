<?php

require "connection.php";

$email = $_GET["se"];

$workerRs = Database::search("SELECT * FROM `worker` INNER JOIN `category` ON worker.category_id = category.cate_id  WHERE `email`='" . $email . "'");

if ($workerRs->num_rows != "1") {
    echo ("Invalid Email");
} else {

    $newWorkerData = $workerRs->fetch_assoc();

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
                    <input class="form-check-input bg-warning border-dark" type="checkbox" role="switch" onchange="DeactivateWorkerAdminAcc('<?php echo $newWorkerData['mobile']; ?>', this);" id="flexSwitchCheck<?php echo $newWorkerData['mobile']; ?>" <?php echo ($newWorkerData['status_s_id'] == '3' || (isset($_SESSION['switchState_' . $newWorkerData['mobile']]) && $_SESSION['switchState_' . $newWorkerData['mobile']] == 'true')) ? 'checked' : ''; ?> />
                    <label class="form-check-label text-warning1 fw-bold" for="flexSwitchCheck<?php echo $newWorkerData['mobile']; ?>">Deactivate</label>
                </div>
            </div>
        </td>
    </tr>
<?php
}
?>