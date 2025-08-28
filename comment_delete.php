<?php
include 'db_connect.php';

$id= $_GET['d_id'];
$file_id= $_GET['file_id'];
$qry ="DELETE FROM `comment` WHERE id=$id";
mysqli_query($conn,$qry);
$id= $id;
header("location:index.php?page=view_documentz&id=$file_id");
session_start();
$_SESSION['status'] = "Data Deleted Successfully";
?>