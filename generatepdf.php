<?php
require 'db_connect.php';
require ('vendor/autoload.php');

if(isset($_GET['generate_report'])){
    $empID = $_GET['employeeid'];
    $frmDate = $_GET['frmDate'];
    $toDate = $_GET['toDate'];
    $status = $_GET['status'];
    
     $qry = "SELECT COUNT(`id`) as DOCS FROM `documents` WHERE documents.`date` BETWEEN '$frmDate' AND '$toDate' AND documents.user_id='$empID' AND documents.`status`='$status'";
     $qry_run= mysqli_query($conn,$qry);
                            if(mysqli_num_rows($qry_run)>0)
                            {
                                foreach($qry_run as $row)
                                {
                                    $totalcount=$row['DOCS'];
                                }
                            }
    
    $qry1 = "SELECT documents.`id`,documents. `title`, documents.`last_name`,documents. `phonenumber`, documents.`job`, documents.`tag`, documents.`description`, documents.`file_json`, documents.`user_id`, documents.`date`, documents.`recruiter`, documents.`date_created`, documents.`status`,concat(users.firstname,', ',users.middlename,' ',users.lastname) as name FROM `documents` INNER JOIN users ON (`documents`.`user_id` = `users`.`id`)  WHERE documents.`date` BETWEEN '$frmDate' AND '$toDate' AND documents.user_id='$empID'  AND documents.`status`='$status'" ;
     $qry_run1= mysqli_query($conn,$qry1);
                            if(mysqli_num_rows($qry_run1)>0)
                            {
                                foreach($qry_run1 as $row)
                                {
                                    $username=$row['name'];
                                }
                            }
    $qry2 = "SELECT documents.`id`,documents. `title`, documents.`last_name`,documents. `phonenumber`, documents.`job`, documents.`tag`, documents.`description`, documents.`file_json`, documents.`user_id`, documents.`date`, documents.`recruiter`, documents.`date_created`, documents.`status`,concat(users.firstname,', ',users.middlename,' ',users.lastname) as name FROM `documents` INNER JOIN users ON (`documents`.`user_id` = `users`.`id`)  WHERE documents.`date` BETWEEN '$frmDate' AND '$toDate' AND documents.user_id='$empID'  AND documents.`status`='$status'" ;
     $qry_run2= mysqli_query($conn,$qry1);
                            if(mysqli_num_rows($qry_run2)>0)
                            {
                                foreach($qry_run2 as $row)
                                {
                      
						  		
                                }
                            }
    
     
 
   

$res=mysqli_query($conn,"SELECT documents.`id`, documents.`ref_no`, documents. `title`, documents.`last_name`,documents. `phonenumber`, documents.`job`, documents.`tag`, documents.`description`, documents.`file_json`, documents.`user_id`, documents.`date`, documents.`recruiter`, documents.`date_created`, status.`status`,concat(users.firstname,', ',users.middlename,' ',users.lastname) as name FROM `documents` INNER JOIN users ON (`documents`.`user_id` = `users`.`id`) 
INNER JOIN status ON (`documents`.`status` = `status`.`status_id`)
WHERE documents.`date` BETWEEN '$frmDate' AND '$toDate' AND documents.user_id='$empID'  AND documents.`status`='$status'" );

$x=1;
if(mysqli_num_rows($res)>0){
    	
	$html='<style>
            .fontth{
            font-size:18px;
            }
            td {
          border: 1px solid black;
        }
            </style>
        <table class="table table-striped" style="margin:auto;" border="1px;">';
		$html.='
        
        <tr style="margin:auto;fontth"><th colspan="3" style="text-align:right;">Date From :'.$frmDate.'</th><th>To :'.$toDate.'</th></tr>
        <tr style="margin:auto;"><th colspan="3" style="text-align:right;">Total Count : </th> <th style="text-align:left;">'.$totalcount.'</th></tr>
        <tr style="margin:auto;"><th colspan="3" style="text-align:right;">Employee Name : </th> <th style="text-align:left;">'.$username.'</th></tr>
        
        <tr>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>
        
    <thead style="margin-top:50px;">
    <tr style="margin-top:50px;">
      <th scope="col">#</th>
      <th scope="col" style="padding-left:5px;">Ref No</th>
      <th scope="col" style="padding-left:5px;">Document Name</th>
      <th scope="col" style="padding-left:5px;">Recruiter</th>
      <th scope="col" style="padding-left:5px;">Status</th>
      <th scope="col" style="padding-left:5px;">Date</th>

    </tr>
  </thead>';
		while($row=mysqli_fetch_assoc($res)){
		        $recq=$row['recruiter'];
		        $reqanswr=$recq."00".$row['ref_no'];
		        $string = str_replace(' ','',$reqanswr); 
			$html.='
            <tbody>
            <tr>
            <td scope="row">'.$x++.'</td>
            <td style="padding-left:5px;text-align:left;">'.$string.'</td>
            <td style="padding-left:5px;">'.$row['title'].' '.$row['last_name'].'</td>
            <td style="padding-left:5px;">'.$row['recruiter'].'</td>
            <td style="padding-left:5px;">'.$row['status'].'</td>
            <td style="padding-left:5px;">'.$row['date'].'</td>
            </tr>
             </tbody>
             ';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
    }
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='emp/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

?>


