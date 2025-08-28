<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM clintmanege where clint_id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'edit_client.php';
?>