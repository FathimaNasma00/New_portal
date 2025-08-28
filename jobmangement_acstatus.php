<?php
include 'db_connect.php';

date_default_timezone_set("Asia/colombo");
$current_date = strtotime(date('Y-m-d H:i:s'));

 
$id= $_GET['ac_id'];
$status =$_GET['status'];
$appby =$_GET['accesby'];


$qry ="update job_management set status=$status where id=$id";
mysqli_query($conn,$qry);
$id= $id;
$statuss =$status;
$appbys =$appby;
header("location:jb_active.php?id=$id&status=$statuss&accesby=$appbys");



?>