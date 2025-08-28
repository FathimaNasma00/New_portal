<?php
include 'db_connect.php';
if(isset($_GET['poc_id']))
{
$id= $_GET['poc_id'];
$qry ="DELETE FROM poc_mange WHERE id=$id";
mysqli_query($conn,$qry);
header("location:index2.php?page=poc_list");
session_start();
$_SESSION['status'] = "Data Deleted Successfully";
}

?>