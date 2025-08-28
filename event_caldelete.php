<?php
include 'db_connect.php';

$id= $_GET['d_id'];
$qry ="DELETE FROM `events_calender` WHERE id=$id";
mysqli_query($conn,$qry);
header("location:index2.php?page=event_list");
session_start();
$_SESSION['status'] = "Data Deleted Successfully";


?>