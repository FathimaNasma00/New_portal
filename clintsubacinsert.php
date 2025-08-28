<?php

//insert.php


$conn = new PDO("mysql:host=localhost;dbname=mvjobvac_mycareers", "mvjobvac_mycareers", "LkCarrers@123");


$query = "
INSERT INTO clintsubaccount 
(clintname, subacount) 
VALUES (:clintname, :subacount)
";

for($count = 0; $count<count($_POST['hidden_clintname']); $count++)
{
 $data = array(
  ':clintname' => $_POST['hidden_clintname'][$count],
  ':subacount' => $_POST['hidden_subacount'][$count]
 );
 $statement = $conn->prepare($query);
 $statement->execute($data);
}

?>
