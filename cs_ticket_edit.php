<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM customer_support_tickets where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'cs_ticket_edit_data.php';
?>