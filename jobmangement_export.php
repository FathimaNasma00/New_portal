<?php  
//export.php  
include 'db_connect.php';
$i = 1;
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT job_management.id,job_management.jb_ref,job_management.jb_title,job_management.jb_type,job_management.emp_type,job_management.jb_date,job_management.jb_workingtype,
                   job_management.jb_descrption,job_management.currency,job_management.paid_details,job_management.min_sal,job_management.max_sal,job_management.status,
                   job_management.deadline, concat(users.firstname,', ',users.middlename,' ',users.lastname) as name,clintmanege.clint_name,job_management.created_date
            FROM job_management
            INNER JOIN users ON (job_management.jb_recuiters = users.id)
            INNER JOIN clintmanege ON (job_management.jb_client = clintmanege.clint_id)
            WHERE job_management.id IN (
                SELECT MAX(id)
                FROM job_management
                GROUP BY jb_ref
            )
            ORDER BY job_management.id DESC";
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
                        <th scope="col">Job Open Date</th>
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
                        <th scope="col">Status</th>
                        <th scope="col">Created_date</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
       if($row["jb_type"]== "NW"){
                       $jb_type='New';
                      }elseif($row["jb_type"] == "RO"){
                      $jb_type='Re-open';
                      }elseif($row["jb_type"] == "Closed"){
                      $jb_type='Closed';
     }
     
     if($row["status"]== "1"){
         $status='ACTIVE';
     }else{
         $status='INACTIVE';
     }
              
   
   $output .= '
                  <tr>  
                         <td class="text-center">'. $i++ .'</td>
                         <td>'.$row["jb_ref"].'</td> 
                         <td>'.$row["jb_title"].'</td>
                         <td>'.$jb_type.'</td>
                         <td>'.$row["jb_date"].'</td> 
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
                         <td>'.$status.'</td>
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