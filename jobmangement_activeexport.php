<?php  
//export.php  
include'db_connect.php';
$i = 1;
$output = '';
if(isset($_POST["export"]))
{
 $query = "
 SELECT j1.id,j1.jb_ref,j1.jb_title,j1.jb_type,j1.emp_type,j1.jb_workingtype,
                   j1.jb_descrption,j1.currency,j1.paid_details,j1.min_sal,j1.max_sal,
                   j1.deadline, concat(users.firstname,', ',users.middlename,' ',users.lastname) as name,clintmanege.clint_name,j1.created_date  FROM job_management
                            INNER JOIN users ON (j1.jb_recuiters = users.id)
                            INNER JOIN clintmanege ON (j1.jb_client = clintmanege.clint_id) 
                            W WHERE j1.status = 1 AND j1.`created_date` = (
        SELECT MAX(j2.`created_date`)
        FROM job_management j2
        WHERE j1.jb_ref = j2.jb_ref
    )
    ORDER BY j1.id DESC ";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                        <th scope="col">#</th>
                        <th scope="col">Jb-Ref.No</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Job Type</th>
                        <th scope="col">Employment type</th>
                        <th scope="col">Client</th>
                        <th scope="col">Working type</th>
                        <th scope="col">Descrption</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Paid every</th>
                        <th scope="col">Minimum salary</th>
                        <th scope="col">Maximum salary</th>
                        <th scope="col">Dead Line</th>
                        <th scope="col">Recuiters</th>
                        <th scope="col">Created_date</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   
   $output .= '
                  <tr>  
                         <th class="text-center">'. $i++ .'</th>
                         <td>'.$row["jb_ref"].'</td> 
                         <td>'.$row["jb_title"].'</td>
                         <td>'.$row["jb_type"].'</td>
                         <td>'.$row["emp_type"].'</td> 
                         <td>'.$row["clint_name"].'</td>
                         <td>'.$row["jb_workingtype"].'</td>
                         <td>'.$row["jb_descrption"].'</td>
                         <td>'.$row["currency"].'</td>
                         <td>'.$row["paid_details"].'</td>
                         <td>'.number_format($row["min_sal"],2).'</td>
                         <td>'.number_format($row["max_sal"],2).'</td>
                         <td>'.$row["deadline"].'</td>
                         <td>'.$row["name"].'</td>
                         <td>'.$row["created_date"].'</td>

                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=JobManagement.xls');
  echo $output;
 }
}
?>