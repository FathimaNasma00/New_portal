<?php 
include 'db_connect.php';

$sql = mysqli_query($conn, "SELECT * FROM `documents` WHERE `recruiter`='R02'  ORDER BY `id` DESC LIMIT 1");
$print_data = mysqli_fetch_row($sql);

echo $print_data[1] +1;


?>