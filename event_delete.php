<?php

include 'event_dppdo.php';

if(isset($_POST["id"]))
{

 $query = "
 DELETE from events_calender WHERE id=:id
 ";
 $statement = $conn->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>
