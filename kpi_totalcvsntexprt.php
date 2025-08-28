<?php  
//export.php  
include'db_connect.php';
$i = 1;
$output = '';
if(isset($_POST["export"]))
{
    $empID = $_POST["jb_recuiters"];
    $frmDate = $_POST["st_date"];
    $toDate = $_POST["end_date"];
    $query1 = "SELECT documents.ref_no, documents.title, documents.last_name, candidate_summery.application_id, 
    clintmanege.clint_name, candidate_summery.feedback, documents.recruiter, candidate_summery.recuiter AS rec, candidate_summery.id, 
    candidate_summery.date, CONCAT(users.firstname, ' ', users.lastname) AS name 
    FROM `candidate_summery` 
    INNER JOIN documents ON (`candidate_summery`.`application_id` = `documents`.`id`) 
    INNER JOIN clintmanege ON (`candidate_summery`.`clint_id` = `clintmanege`.`clint_id`) 
    INNER JOIN users ON (`candidate_summery`.`user_id` = `users`.`id`) 
    WHERE candidate_summery.`user_id` = $empID 
    AND candidate_summery.feedback ='SentForClientReview' 
    AND candidate_summery.`date` BETWEEN '$frmDate' AND '$toDate'
    Group BY candidate_summery.application_id 
    ORDER BY candidate_summery.id ASC Limit 1";
 $result1 = mysqli_query($conn, $query1);
 if(mysqli_num_rows($result1) > 0)
 {
     while($row = mysqli_fetch_array($result1))
  {
       $output .= '
   <table class="table" bordered="1"> 
   
                    <tr><th colspan="6" style="border-top: 2px solid black;border-bottom: 2px solid black;"><b> '.$row["name"].' Total CV Sent '.$frmDate.' - '.$toDate.' </b></th></tr>
    </table>           
  ';
  }
     
 } 
  $qry1 = "SELECT COUNT(*) AS total_count 
    FROM ( SELECT candidate_summery.application_id FROM `candidate_summery` 
    INNER JOIN documents ON (`candidate_summery`.`application_id` = `documents`.`id`) 
    INNER JOIN clintmanege ON (`candidate_summery`.`clint_id` = `clintmanege`.`clint_id`) 
    INNER JOIN users ON (`candidate_summery`.`user_id` = `users`.`id`) 
    WHERE candidate_summery.`user_id` = $empID 
    AND candidate_summery.feedback = 'SentForClientReview' 
    AND candidate_summery.`date` BETWEEN '$frmDate' AND '$toDate'
    GROUP BY candidate_summery.application_id 
    ORDER BY candidate_summery.id ASC) AS subquery";
 $res1 = mysqli_query($conn, $qry1);
 if(mysqli_num_rows($res1) > 0)
 {
     while($row = mysqli_fetch_array($res1))
  {
       $output .= '
   <table class="table" bordered="1"> 
   
                    <tr><th colspan="6" style="border-top: 2px solid black;border-bottom: 2px solid black;"><b> Total Count of CV Sent  '.$row["total_count"].' </b></th></tr>
    </table>           
  ';
  }
     
 }
 $query = "SELECT documents.ref_no, documents.title, documents.last_name, candidate_summery.application_id, 
    clintmanege.clint_name, candidate_summery.feedback, documents.recruiter, candidate_summery.recuiter AS rec, candidate_summery.id, 
    candidate_summery.date, CONCAT(users.firstname, ' ', users.lastname) AS name 
    FROM `candidate_summery` 
    INNER JOIN documents ON (`candidate_summery`.`application_id` = `documents`.`id`) 
    INNER JOIN clintmanege ON (`candidate_summery`.`clint_id` = `clintmanege`.`clint_id`) 
    INNER JOIN users ON (`candidate_summery`.`user_id` = `users`.`id`) 
    WHERE candidate_summery.`user_id` = $empID 
    AND candidate_summery.feedback ='SentForClientReview' 
    AND candidate_summery.`date` BETWEEN '$frmDate' AND '$toDate'
    Group BY candidate_summery.application_id 
    ORDER BY candidate_summery.id ASC";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1"> 
   
                   
                    <tr>  
                                        <th>No</th>
                                      <th>Ref No</th>
                						<th>Application</th>
                						<th>Client Name</th>
                						<th>Feedback</th>
                						<th>Amount</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
                        if($row['ref_no'] <= 99){
						$recq=$row['recruiter'];
						$reqanswr=$recq."00".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}else{
						 $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}    
              
   
   $output .= '
                  <tr>  
                         <th class="text-center">'. $i++ .'</th>
                         <th class="text-center">'. $string .'</th>
                         <td>'.$row["title"].','.$row["last_name"].'</td> 
                         <td>'.$row["clint_name"].'</td>
                         <td>'.$row["feedback"].'</td>
                         <td>'.$row["date"].'</td>
                    </tr>
   ';
  }
  
  
  
  $qry = "SELECT COUNT(*) AS total_count 
    FROM ( SELECT candidate_summery.application_id FROM `candidate_summery` 
    INNER JOIN documents ON (`candidate_summery`.`application_id` = `documents`.`id`) 
    INNER JOIN clintmanege ON (`candidate_summery`.`clint_id` = `clintmanege`.`clint_id`) 
    INNER JOIN users ON (`candidate_summery`.`user_id` = `users`.`id`) 
    WHERE candidate_summery.`user_id` = $empID AND candidate_summery.feedback = 'SentForClientReview' 
    AND candidate_summery.`date` BETWEEN '$frmDate' AND '$toDate'
    GROUP BY candidate_summery.application_id 
    ORDER BY candidate_summery.id ASC) AS subquery";
  
  
   $qry_run = mysqli_query($conn, $qry);
    if (mysqli_num_rows($qry_run) > 0) {
        while ($row = mysqli_fetch_array($qry_run)) {
             $amt = $row['total_count'];
         
          $output .= '
                  <tr>  
                         <td colspan="5" style="border-top: 2px solid black;border-bottom: 2px solid black;"><b>Total Count OF Sent CV</b></td>
                         <td style="border-top: 2px solid black;border-bottom: 2px solid black;"><b>'.$amt.'</b></td> 
                    </tr>
        ';  
        }
        
    }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=TotalCountCvSent.xls');
  echo $output;
 }
}
?>