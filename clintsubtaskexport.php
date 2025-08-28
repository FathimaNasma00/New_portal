<?php  
//export.php  
include'db_connect.php';
$i = 1;
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT clintmanege.clint_name,clintsubaccount.subacount,clintsubaccount.id,clintsubaccount.created_date FROM `clintsubaccount`
                                        INNER JOIN clintmanege ON (clintsubaccount.clintname = clintmanege.clint_id)";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                      <th class="text-center">#</th>
						<th>Clint Name</th>
						<th>Sub Accounts </th>
						<th>Date</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <th class="text-center">'. $i++ .'</th>
                         <td>'.$row["clint_name"].'</td>  
                         <td>'.$row["subacount"].'</td>  
                        <td>'.$row["created_date"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=ClintSubAccounts.xls');
  echo $output;
 }
}
?>
