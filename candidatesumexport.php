<?php  
//export.php  
include'db_connect.php';
$i = 1;
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT DISTINCT documents.ref_no, documents.title,documents.phonenumber,documents.email, documents.last_name, candidate_summery.application_id, 
                    clintmanege.clint_name, candidate_summery.feedback, documents.recruiter, candidate_summery.recuiter AS rec, 
                    candidate_summery.id, candidate_summery.date, CONCAT(users.firstname, ' ', users.lastname) AS name, 
                    job_management.jb_title, job_management.jb_ref,job_management.jb_date, 
                    (SELECT account_manager.recruiter
                     FROM users AS account_manager 
                     WHERE account_manager.id = job_management.jb_recuiters) AS account_manager
    FROM candidate_summery
    INNER JOIN documents ON candidate_summery.application_id = documents.id
    INNER JOIN clintmanege ON candidate_summery.clint_id = clintmanege.clint_id
    INNER JOIN users ON candidate_summery.source_by = users.id
    INNER JOIN job_management ON candidate_summery.job_refno = job_management.id
    WHERE (documents.ref_no, clintmanege.clint_name, candidate_summery.recuiter, candidate_summery.date) IN (
        SELECT documents.ref_no, clintmanege.clint_name, candidate_summery.recuiter, MAX(candidate_summery.date) AS max_date
        FROM candidate_summery
        INNER JOIN documents ON candidate_summery.application_id = documents.id
        INNER JOIN clintmanege ON candidate_summery.clint_id = clintmanege.clint_id
        INNER JOIN users ON candidate_summery.source_by = users.id
        INNER JOIN job_management ON candidate_summery.job_refno = job_management.id
        GROUP BY documents.ref_no, clintmanege.clint_name, candidate_summery.recuiter
    )
    ORDER BY candidate_summery.id DESC;
";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                      <th class="text-center">#</th>
						<th>Ref No</th>
						<th>Application</th>
						<th>Phone Number</th>
						<th>Email Address</th>
						<th>Client Name</th>
						<th>Feedback</th>
						<th>Job Title</th>
						<th>Job Ref</th>
						<th>Job Open Date</th>
						<th>Recruiter</th>
						<th>Account Manager</th>
						<th>Date</th>
						
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
    $recq=$row['rec'];
	$reqanswr=$recq."0".$row['ref_no'];
	$string = str_replace(' ','',$reqanswr);
	$feed = $row['feedback'];
    $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feed);
   $output .= '
    <tr>  
                         <th class="text-center">'. $i++ .'</th>
                         <td>'.$string.'</td>  
                         <td>'.$row["title"].' &nbsp; '.$row['last_name'].'</td>  
                         <td>'.$row["phonenumber"].'</td> 
                         <td>'.$row["email"].'</td> 
                         <td>'.$row["clint_name"].'</td> 
                            
       <td>'.$words.'</td>  
       <td>'.$row["jb_title"].'</td> 
       <td>'.$row["jb_ref"].'</td>
       <td>'.$row["jb_date"].'</td>
       <td>'.$row["name"].'</td>
       <td>'.$row["account_manager"].'</td>
       <td>'.$row["date"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=candidate_summary.xls');
  echo $output;
 }
}
?>
