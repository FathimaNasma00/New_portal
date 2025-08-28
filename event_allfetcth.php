<?php
session_start();
include 'event_dppdo.php';


$data = array();
$query = "
SELECT 
    events_calender.*, 
    events_calender.id,
    events_calender.title AS eventitle,
    CONCAT(users.firstname, ', ', users.middlename, ' ', users.lastname) AS name,
    CONCAT(documents.title, ' ', documents.last_name) AS candidate,
    job_management.jb_title,
    job_management.jb_ref,
    events_calender.candidate_id,
    events_calender.job_id,
    events_calender.status,
    events_calender.user_id,
    clintmanege.clint_name
FROM 
    events_calender
INNER JOIN 
    users ON (events_calender.user_id = users.id)
LEFT JOIN 
    documents ON (events_calender.candidate_id = documents.id)
LEFT JOIN 
    clintmanege ON (events_calender.client_id = clintmanege.clint_id)
LEFT JOIN 
    job_management ON (events_calender.job_id = job_management.id)
ORDER BY 
    events_calender.id;";


$statement = $conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["clint_name"],
  'Eventtitle'   => $row["eventitle"],
  'candidate_id'   => $row["candidate_id"],
  'candidate'   => $row["candidate"],
  'clint_name'   => $row["clint_name"],
  'jb_title'   => $row["jb_title"],
  'jb_ref'   => $row["jb_ref"],
  'jbref_id'   => $row["job_id"],
  'start'   => $row["start_datetime"],
   'evstatus'   => $row["status"],
   'upby'   => $row["name"],
   'userid'   => $row["user_id"]
 );
}

echo json_encode($data);

?>