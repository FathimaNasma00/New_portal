<?php
$host     = 'localhost';
$username = 'username';
$password = 'pass';
$dbname   ='db';

$conn = new mysqli($host, $username, $password, $dbname);
if(!$conn){
    die("Cannot connect to the database.". $conn->error);
}


?>
