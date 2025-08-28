<?php
include 'db_connect.php';

date_default_timezone_set("Asia/colombo");
$current_date = strtotime(date('Y-m-d H:i:s'));

 
$id= $_GET['inac_id'];
$status =$_GET['status'];
$appby =$_GET['accesby'];


$qry ="update users set active=$status where id=$id";
mysqli_query($conn,$qry);
header("location: index2.php?page=user_list");
session_start();
$_SESSION['inacstatus'] = "Inactivated User SuccessFull";


?>