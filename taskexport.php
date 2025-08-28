<?php  
//export.php  
include'db_connect.php';
$i = 1;
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT project_list.id,concat(users.firstname,' ',users.lastname) as name,project_list.start_date,project_list.rolname,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN users ON (project_list.name = users.id)
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id)";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                      <th class="text-center">#</th>
						<th>Account Manager</th>
						<th>Project Started</th>
						<th>Project Due Date</th>
						<th>Clint Name</th>
						<th>Role</th>
						<th>Recuiters</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   
   $output .= '
    <tr>  
                         <th class="text-center">'. $i++ .'</th>
                         <td>'.$row["name"].'</td>  
                         <td>'. $row['start_date'] .'</td>  
                         <td>'.$row["end_date"].'</td>
                         <td>'.$row["clint_name"].'</td>
                         <td>'.$row["rolname"].'</td>
                         <td>'.$row["user_ids"].'</td>


                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=TaskManagement.xls');
  echo $output;
 }
}
?>
