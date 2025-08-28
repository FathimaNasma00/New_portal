<?php
include 'db_connect.php';
$salereve= $_GET['salereve_id'];
$qry ="DELETE FROM `sale_target` WHERE id=$salereve";
mysqli_query($conn,$qry);
header("location:index.php?page=mysalerevue");
session_start();
$_SESSION['status'] = "Data Deleted Successfully";

?>