<?php

require "connection.php";

$email = $_GET["se"];

$CustomerRs  = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON `user`.`gender_id` = `gender`.`id` WHERE `email`='" . $email . "' ");

if ($CustomerRs->num_rows != "1") {
    echo ("Invalid Email");
} else {

    $newCustomerData = $CustomerRs->fetch_assoc();

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
                    <input class="form-check-input" type="checkbox" role="switch" onchange="deactiveCustomerAcc(<?php echo ($newCustomerData['mobile']); ?>);" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Deactive</label>
                </div>
            </div>
        </td>
        
        <td>
            <button class="btn btn-danger delete-btn" data-email="<?php echo $newCustomerData['email']; ?>">Delete</button>
        </td>
    </tr>
<?php
}
?>
