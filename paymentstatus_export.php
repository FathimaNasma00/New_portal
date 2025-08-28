<?php  
//export.php  
include'db_connect.php';
$i = 1;
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT sale_target.id,sale_target.candidate,sale_target.amount,sale_target.account_manger,sale_target.join_date,sale_target.status,documents.id AS dmid,documents.ref_no,documents.title, documents.last_name,
					                     documents.recruiter,concat(users.firstname ,' ' ,users.lastname) as name,clintmanege.clint_name
					                     FROM `sale_target`
					                     INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
					                     INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
					                     INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
                                        order by id desc";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                      <th class="text-center">#</th>
                        <th>Ref_NO</th>
						<th>Candidate</th>
						<th>Amount</th>
						<th>Client</th>
						<th>Date Of Join</th>
						<th>Payment Status</th>
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
	        
       if ($row['status']==0) {  
                               $Pystus =  "Payment Due";  
      }if ($row['status']==1) {  
                               $Pystus=   "Pending Po";  
      }if ($row['status']==2) {  
                               $Pystus=  "Pending Invoice";  
      }if ($row['status']==3) {  
                              $Pystus=   "Pending Payment";  
      }if ($row['status']==4) {  
                              $Pystus=   "Payment Receive";  
       }
       
          
   
   $output .= '
    <tr>  
                         <th class="text-center">'. $i++ .'</th>
                         <th class="text-left">'. $string .'</th>
                         <td>'.$row["title"].' &nbsp; '.$row['last_name'].'</td>  
                         <td>'.number_format($row["amount"],2).'</td> 
                         <td>'.$row["clint_name"].'</td>
                         <td>'.$row["join_date"].'</td>
                         <td>'.$Pystus.' </td>

                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=PaymentStatus.xls');
  echo $output;
 }
}
?>