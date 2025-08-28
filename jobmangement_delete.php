<?php
include 'db_connect.php';

$id = $_GET['d_id'];


session_start();

$qry_select = "SELECT * FROM `job_management` WHERE id=$id";
$result = mysqli_query($conn, $qry_select);

if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);


    $qry_insert = "INSERT INTO `job_management_deletehistory` 
                   (`id`, `jb_refco`, `jb_ref`, `jb_title`, `jb_type`, `emp_type`, `jb_client`, `jb_workingtype`, `jb_descrption`, `jb_fiels`, `currency`, `paid_details`, `min_sal`, `max_sal`, `deadline`, `jb_recuiters`, `user_id`, `jb_date`, `status`, `created_date`) 
                   VALUES 
                   ('{$row['id']}', '{$row['jb_refco']}', '{$row['jb_ref']}', '{$row['jb_title']}', '{$row['jb_type']}', '{$row['emp_type']}', '{$row['jb_client']}', '{$row['jb_workingtype']}', '{$row['jb_descrption']}', '{$row['jb_fiels']}', '{$row['currency']}', '{$row['paid_details']}', '{$row['min_sal']}', '{$row['max_sal']}', '{$row['deadline']}', '{$row['jb_recuiters']}', '{$row['user_id']}', '{$row['jb_date']}', '{$row['status']}', '{$row['created_date']}')";

    mysqli_query($conn, $qry_insert);

    $qry_delete = "DELETE FROM `job_management` WHERE id=$id";
    mysqli_query($conn, $qry_delete);

    $_SESSION['status'] = "Data Deleted Successfully and moved to history";
} else {
    $_SESSION['status'] = "Data not found";
}

header("location:index2.php?page=jobmanagement_list");

?>
