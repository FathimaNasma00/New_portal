<?php 
include'db_connect.php'; 
     //Get Update id and status  
 if (isset($_GET['id']) && isset($_GET['statusid'])) {  
      $id=$_GET['id'];  
      $status=$_GET['statusid'];  
      mysqli_query($conn,"update sale_target set status='$status' where id='$id'");  
      header("location:./index.php?page=payment_list");  
      die();  
 } 
?>