
<?php

include 'event_dppdo.php';


if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO events_calender 
 (title, start_event, end_event) 
 VALUES (:title, :start_event, :end_event)
 ";
 $statement = $conn->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
}


?>