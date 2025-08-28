<?php  
//export.php  
include'db_connect.php';
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT `recruiter`,`ref_no`,`phonenumber`,`email`,`date_created`, MAX(`id`) AS ID
                            FROM documents
                            GROUP BY `phonenumber`,`email`
                            HAVING COUNT(email) > 1";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                      <th>Ref_NO</th>  
                  <th>Phone number</th> 
                   <th>Email</th>  
                    <th>Recuiter</th>  
                   <th>Date And Time</th>
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
                         <td>'.$string.'</td>  
                         <td>'.$row["phonenumber"].'</td>  
                         <td>'.$row["email"].'</td>  
       <td>'.$row["recruiter"].'</td>  
       <td>'.$row["date_created"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=duplicate_datasets.xls');
  echo $output;
 }
}
?>
