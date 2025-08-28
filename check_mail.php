<?php
error_reporting(E_ALL ^ E_NOTICE && E_ALL ^ E_WARNING); 
include 'db_connect.php';

if (isset($_POST['check_submit_btn'])) {
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];

    // Check if either phone number or email is empty
    if (empty($phonenumber) || empty($email)) {
        echo "Please fill in both Phone Number and Email.";
        exit; // Stop further execution
    }
    
    $phone_query = "SELECT documents.phonenumber,documents.ref_no ,documents.recruiter , CONCAT(users.firstname, ', ', users.middlename, ' ', users.lastname) AS name, status.status
                   FROM documents 
                   INNER JOIN users ON (documents.user_id = users.id)
                   INNER JOIN status ON (documents.status = status.status_id)
                   WHERE documents.phonenumber = '$phonenumber'";
    $email_query = "SELECT documents.email,documents.ref_no ,documents.recruiter , CONCAT(users.firstname, ', ', users.middlename, ' ', users.lastname) AS name, status.status
                   FROM documents 
                   INNER JOIN users ON (documents.user_id = users.id)
                   INNER JOIN status ON (documents.status = status.status_id) 
                   WHERE documents.email = '$email'";
    
    $phone_result = mysqli_query($conn, $phone_query);
    $email_result = mysqli_query($conn, $email_query);
    
    if (mysqli_num_rows($phone_result) > 0) {
        $phone_row = mysqli_fetch_assoc($phone_result);
        if($ref_no <= 99){
            $recq=$phone_row['recruiter'];
            $reqanswr=$recq."00".$phone_row['ref_no'];
            $string = str_replace(' ','',$reqanswr);
        } else {
            $recq=$phone_row['recruiter'];
            $reqanswr=$recq."0".$phone_row['ref_no'];
            $string = str_replace(' ','',$reqanswr);
        }
	
        echo "Phone Number Already Exists, Try another Phone Number ";
        echo "| RefNo: " . $string ;
        echo "| By: " . $phone_row['name'] . "|";
        echo "| Status: " . $phone_row['status'] . "|";
    } else if (mysqli_num_rows($email_result) > 0) {
        $email_row = mysqli_fetch_assoc($email_result);
     
        echo "Email Already Exists, Try another Email";
        
        echo "| By: " . $email_row['name'] . "|";
        echo "| Status: " . $email_row['status'] . "|";
    } else {
        echo "";
    }
}
?>
