<?php
include 'db_connect.php';
date_default_timezone_set("Asia/colombo");
$date = date("Y-m-d");
$time = date("h:i:sa");
$id= $_GET['id'];
$status =$_GET['status'];
$appby =$_GET['accesby'];


$qry ="INSERT INTO data_status  (job_id,status,user_id,date,time) 
       VALUES ('$id', '$status', '$appby','$date','$time')";
mysqli_query($conn,$qry);
$i=md5($id);
header("location:index2.php?page=jobmangement_active");



?>