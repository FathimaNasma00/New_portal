<?php
include 'db_connect.php';

$id = $_GET['d_id'];


session_start();

$qry_select = "SELECT * FROM `customer_support_tickets` WHERE id=$id";
$result = mysqli_query($conn, $qry_select);

if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);


    $qry_insert = "INSERT INTO `customer_support_history_tickets` 
                   ( `id`, `subject`, `description`, `status`, `department_id`, `customer_id`, `staff_id`, `admin_id`, `date_created`) 
                   VALUES 
                   ('{$row['id']}', '{$row['subject']}', '{$row['description']}', '{$row['status']}', '{$row['department_id']}', '{$row['customer_id']}', '{$row['staff_id']}', '{$row['admin_id']}', '{$row['date_created']}')";

    mysqli_query($conn, $qry_insert);

    $qry_delete = "DELETE FROM `customer_support_tickets` WHERE id=$id";
    mysqli_query($conn, $qry_delete);

    $_SESSION['status'] = "Data Deleted Successfully";
} else {
    $_SESSION['status'] = "Data not found";
}

header("location:index2.php?page=cs_my_ticket");

?>
