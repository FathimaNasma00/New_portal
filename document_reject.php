<?php
include 'db_connect.php';

date_default_timezone_set("Asia/colombo");
$current_date = date('Y-m-d H:i:s');

        
$id= $_GET['d_id'];
$status =$_GET['status'];
$rjby = $_GET['accesby'];

$qry ="update documents set status=$status,accesby=$rjby, accdt='$current_date' where id=$id";
mysqli_query($conn,$qry);
header("location:index2.php?page=reson_reject&id=$id");

?>