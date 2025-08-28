<?php
include 'db_connect.php';

$status = 0;
$statusMsg = 'Oops! Something went wrong! Please try again late.';
if(isset($_POST['contact_submit'])){
    // Get the submitted form data
    $clids = $_POST['clints'];
     $ids = $_POST['appli_ids'];
    $amount = $_POST['amount'];
    $month= date("M",strtotime($_POST['join_date']));
    $join_date = $_POST['join_date'];
    $year= date("Y",strtotime($_POST['join_date']));
    $user_id=$_POST['user_id'];
    $account_manger=$_POST['recuiter'];
    
    // Check whether submitted data is not empty
    if(!empty($ids) && !empty($amount) && !empty($month) && !empty($join_date) && !empty($year) && !empty($user_id) && !empty($account_manger)){
        
     
           $qry ="INSERT INTO `sale_target`(`candidate`,`client`,`amount`, `month`, `join_date`, `year`, `user_id`,`account_manger`) 
                                     VALUES('$ids','$clids','$amount','$month','$join_date','$year','$user_id','$account_manger')";
            mysqli_query($conn,$qry);
            if(mysqli_query){
                $status = 1;
                $statusMsg = '<div class="alert alert-success" role="alert">
                                 Candidate Sale Revenue Details Added Successfully..!
                                </div>';
            }else{
                $statusMsg = '<div class="alert alert-danger" role="alert">
                              Failed!, please try again.
                            </div>';
            }
        
    }else{
        $statusMsg = 'Please fill in all the mandatory fields.';
    }
}

$response = array(
    'status' => $status,
    'message' => $statusMsg
);
echo json_encode($response);
?>
