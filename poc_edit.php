<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM poc_mange where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'poc_ed.php';
?>