<?php
include 'db_connect.php';
session_start();

if(isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    
    $qry_select = "SELECT * FROM candidate_summery WHERE id=$id";
    $result = mysqli_query($conn, $qry_select);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
    
        $clint_id = $row['clint_id'];
        $application_id = $row['application_id'];
        $feedback = $row['feedback'];
        $other_feedback = $row['other_feedback'];
        $recuiter = $row['recuiter'];
        $log_id = $row['log_id'];
        $user_id = $row['user_id'];
        $description = $row['description'];
        $date = $row['date'];
        $job_refno = $row['job_refno'];
        $source_by = $row['source_by'];
        $candi_updatedate = $row['candi_updatedate'];
        $created_date = $row['created_date'];
        
   
        $qry_insert = "INSERT INTO deletedcandidate_summeryhistory 
                        (id, clint_id, application_id, feedback, other_feedback, recuiter, log_id, user_id, description, date, job_refno, source_by, candi_updatedate, created_date) 
                       VALUES 
                        ($id, '$clint_id', '$application_id', '$feedback', '$other_feedback', '$recuiter', '$log_id', '$user_id', '$description', '$date', '$job_refno', '$source_by', '$candi_updatedate', '$created_date')";
        
        if (mysqli_query($conn, $qry_insert)) {
    
            $qry_delete = "DELETE FROM candidate_summery WHERE id=$id";
            mysqli_query($conn, $qry_delete);
            
           
            $_SESSION['status'] = "Data Deleted Successfully";
        } else {
            $_SESSION['status'] = "Failed to insert data into history table.";
        }
    } else {
        $_SESSION['status'] = "Record not found.";
    }


    header("location:index2.php?page=candidate");
}
?>
