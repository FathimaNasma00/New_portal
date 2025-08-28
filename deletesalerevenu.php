<?php
include 'db_connect.php';
$id= $_GET['delete_id'];
$qry ="DELETE FROM `sale_target` WHERE id=$id";
mysqli_query($conn,$qry);
header("location:index.php?page=listofsaletr");
session_start();
$_SESSION['status'] = "Data Deleted Successfully";

?>
