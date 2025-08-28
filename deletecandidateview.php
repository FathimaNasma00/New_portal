<?php

include 'db_connect.php';
if(isset($_GET['cand_id']) && isset($_GET['logid'])) 
{
$id= $_GET['cand_id'];
$logid= $_GET['logid'];
$qry ="DELETE FROM `candidate_summery` WHERE `id`=$id";
mysqli_query($conn,$qry);
$logid1= $logid;
header("location:./index2.php?page=view_documentz&id=$logid1");
session_start();
$_SESSION['status'] = "Data Deleted Successfully";
}

?>