<?php  
//export.php  
include'db_connect.php';
$i = 1;
$output = '';
if(isset($_POST["export"]) && isset($_POST["name"]) && isset($_POST["frmdate"]) && isset($_POST["todate"]))
{

      $name= $_POST['name'];
       $frmDate = $_POST['frmdate'];
      $toDate = $_POST['todate'];
 $query = "SELECT timetracker.`id`, 
                                        timetracker.`log_id`, 
                                        timetracker.`recruiter`,
                                        timetracker.`task`, 
                                        timetracker.`starttime`, 
                                        timetracker.`endtime`,
                                        timetracker.`count`, 
                                        timetracker.`types`, 
                                        timetracker.`description`,
                                        timetracker.`date`, 
                                        timetracker.`action_date`, 
                                        timetracker.`user_id`,
                                        concat(users.firstname,', ',users.middlename,' ',users.lastname) as name
                                        FROM `timetracker`
                                        INNER JOIN users
                                        ON (`timetracker`.`user_id` = `users`.`id`) 
                                      Where timetracker.`user_id` IN($name) AND timetracker.`date` BETWEEN '$frmDate' AND '$toDate'
                                        order by id desc";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                        <th scope="col">#</th>
                        <th>Name</th>
						<th>Task</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Count</th>
						<th>Type</th>
						<th>Recruiter</th>
                        <th>Created_date</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   
   $output .= '
                  <tr>  
                         <th class="text-center">'. $i++ .'</th>
                         <td>'.$row["name"].'</td> 
                         <td>'.$row["task"].'</td>
                         <td>'.$row["starttime"].'</td>
                         <td>'.$row["endtime"].'</td> 
                         <td>'.$row["count"].'</td>
                         <td>'.$row["types"].'</td>
                         <td>'.$row["recruiter"].'</td>
                         <td>'.$row["action_date"].'</td>

                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=timetracker.xls');
  echo $output;
 }
}
?>