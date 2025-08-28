<?php
include('db_connect.php'); // Replace with the actual database connection file

if(isset($_POST['clientId'])) {
  $clientId = $_POST['clientId'];
  
  $jobRefNos = $conn->query("SELECT job_management.id, job_management.jb_ref, job_management.jb_title, job_management.jb_type,
                              job_management.jb_workingtype, job_management.status, job_management.user_id, job_management.deadline,
                              CONCAT(users.firstname, ', ', users.middlename, ' ', users.lastname) AS name, clintmanege.clint_name
                              FROM job_management
                              INNER JOIN users ON (job_management.jb_recuiters = users.id)
                              INNER JOIN clintmanege ON (job_management.jb_client = clintmanege.clint_id)
                              WHERE job_management.status ='1' AND job_management.jb_client = $clientId AND job_management.id IN (
                                SELECT MAX(id)
                                FROM job_management
                                WHERE job_management.status = '1' 
                                GROUP BY jb_ref
                              )
                              ORDER BY job_management.id DESC");
  
  $options = '<option></option>';
  while($row = $jobRefNos->fetch_assoc()){
    $jb_type = '';
    if($row['jb_type'] == "NW"){
      $jb_type = 'New';
    } elseif($row['jb_type'] == "RO") {
      $jb_type = 'Re-open';
    } elseif($row['jb_type'] == "Closed") {
      $jb_type = 'Closed';
    }
    $options .= '<option value="'.$row['id'].'" '.(isset($job_refno) && in_array($row['id'], explode(',', $job_refno)) ? "selected" : '').'>
                  '.ucwords($row['jb_title']).' - '.$row['jb_ref'].' - '.$row['clint_name'].' - '.$jb_type.'
                </option>';
  }
  
  echo $options;
}
?>

