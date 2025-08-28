<?php
include 'db_connect.php';

date_default_timezone_set("Asia/Colombo");
$current_date = date('Y-m-d H:i:s');

$id = $_GET['d_id'];
$status = $_GET['status'];
$appby = $_GET['accesby'];

// Use single quotes around $status and $appby, and convert $current_date to a valid MySQL date format.
$qry = "UPDATE documents SET status='$status', accesby='$appby', accdt='$current_date' WHERE id=$id";

mysqli_query($conn, $qry);

$id = $id;
$statuss = $status;
$appbys = $appby;
header("location:satus2.php?id=$id&status=$statuss&accesby=$appbys");
?>
