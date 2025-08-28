<?php
include 'db_connect.php';
date_default_timezone_set("Asia/colombo");
$date = date("Y-m-d");
$time = date("h:i:sa");
$id= $_GET['id'];
$status =$_GET['status'];
$appby =$_GET['accesby'];


$qry ="INSERT INTO data_status  (cv_id,status,acces_by,user_id,acces_date,acces_time) 
       VALUES ('$id', '$status', '$appby','$appby','$date','$time')";
mysqli_query($conn,$qry);
$i=md5($id);
header("location:index.php?page=adminpending");



?>
