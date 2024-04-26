<?php

require "connection.php";

if (isset($_GET["se"])) {
    $email = $_GET["se"];

    $workerOrderRs = Database::search("SELECT `order`.*, worker.fname as worker_fname, worker.lname as worker_lname, user.fname as user_fname, user.lname as user_lname 
                                  FROM `order` 
                                  INNER JOIN `worker` ON `order`.`worker_email` = `worker`.`email`
                                  INNER JOIN `user` ON `order`.`user_email` = `user`.`email` 
                                  WHERE `order`.`worker_email`='" . $email . "' 
                                  ORDER BY `order_time` DESC");
    $newAdminOrderNum = $workerOrderRs->num_rows;

    if ($newAdminOrderNum > 0) {
        for ($x = 0; $x < $newAdminOrderNum; $x++) {
            $newAdminOrderData = $workerOrderRs->fetch_assoc();
?>
            <tr>
                <td><?php echo $newAdminOrderData['worker_email']; ?></td>
                <td><?php echo $newAdminOrderData['user_email']; ?></td>
                <td><?php echo $newAdminOrderData['order_time']; ?></td>
                <td><?php echo $newAdminOrderData['worker_fname'] . ' ' . $newAdminOrderData['worker_lname']; ?></td>
                <td><?php echo $newAdminOrderData['user_fname'] . ' ' . $newAdminOrderData['user_lname']; ?></td>
                <td>
                    <?php
                    $orderStatus = $newAdminOrderData['order_status_order_st_id'];
                    if ($orderStatus == 1) {
                    ?>
                        <span class="badge rounded-pill text-bg-primary p-2 px-4 fs-6">Active</span>
                    <?php
                    } elseif ($orderStatus == 2) {
                    ?>
                        <span class="badge rounded-pill text-bg-danger p-2 px-4 fs-6">Cancel</span>
                    <?php
                    } elseif ($orderStatus == 4) {
                    ?>
                        <span class="badge rounded-pill text-bg-warning p-2 px-4 fs-6">Pending</span>
                    <?php
                    } elseif ($orderStatus == 5) {
                    ?>
                        <span class="badge rounded-pill text-bg-success p-2 px-4 fs-6">Completed</span>
                    <?php
                    }
                    ?>
                </td>
            </tr>
<?php
        }
    } else {
        echo "Invalid Email";
    }
} else {
    echo "Email parameter not set";
}
?>
