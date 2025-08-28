
<?php
session_start();
include('db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION["login_id"])) {
    header("Location: login.php");
    exit;
}

?>

    <?php 
        $losession = $_SESSION['login_email'];
        $query = "SELECT email , password,type FROM `users` WHERE `email` = $losession ";
        $result = mysqli_query($conn, $query);
         while($row = mysqli_fetch_array($result))  
                 { 
    ?>
    
  
      <?php echo $row["email"]; ?>
        
			
    
    <?php  } ?>
 