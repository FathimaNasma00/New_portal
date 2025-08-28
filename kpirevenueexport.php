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
    $query1 = "SELECT sale_target.id, sale_target.candidate, sale_target.amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            WHERE sale_target.user_id = $empID
            AND sale_target.join_date BETWEEN '$frmDate' AND '$toDate'
            ORDER BY sale_target.id ASC  LIMIT 1";
 $result1 = mysqli_query($conn, $query1);
 if(mysqli_num_rows($result1) > 0)
 {
     while($row = mysqli_fetch_array($result1))
  {
       $output .= '
   <table class="table" bordered="1"> 
   
                    <tr><th colspan="5" style="border-top: 2px solid black;border-bottom: 2px solid black;"><b> '.$row["name"].' Total Revenue '.$frmDate.' - '.$toDate.' </b></th></tr>
    </table>           
  ';
  }
     
 }    
 $query = "SELECT sale_target.id, sale_target.candidate, sale_target.amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            WHERE sale_target.user_id = $empID
            AND sale_target.join_date BETWEEN '$frmDate' AND '$toDate'
            ORDER BY sale_target.id ASC";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1"> 
   
                   
                    <tr>  
                                        <th>No</th>
                                      <th>Candidate</th>
                						<th>Client</th>
                						<th>Date of Join</th>
                						<th>Amount</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
      
              
   
   $output .= '
                  <tr>  
                         <th class="text-center">'. $i++ .'</th>
                         <td>'.$row["title"].','.$row["last_name"].'</td> 
                         <td>'.$row["clint_name"].'</td>
                         <td>'.$row["join_date"].'</td>
                         <td>Rs. '.number_format($row['amount'], 2).'</td> 
                    </tr>
   ';
  }
  
  
  
  $qry = "SELECT sale_target.id, sale_target.candidate, sale_target.amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            ,SUM(sale_target.amount) AS total_amount
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            WHERE sale_target.user_id = $empID
            AND sale_target.join_date BETWEEN '$frmDate' AND '$toDate'
  ORDER BY sale_target.id ASC";
  
  
   $qry_run = mysqli_query($conn, $qry);
    if (mysqli_num_rows($qry_run) > 0) {
        while ($row = mysqli_fetch_array($qry_run)) {
            $amt = $row['total_amount'];
            $sum = 0;
            $sum += $amt;
          $output .= '
                  <tr>  
                         <td colspan="4" style="border-top: 2px solid black;border-bottom: 2px solid black;"><b>Total Revenue Per/month</b></td>
                         <td style="border-top: 2px solid black;border-bottom: 2px solid black;"><b>Rs. '.number_format($sum, 2).'</b></td> 
                    </tr>
        ';  
        }
        
    }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=TotalRevenuePermonth.xls');
  echo $output;
 }
}
?>