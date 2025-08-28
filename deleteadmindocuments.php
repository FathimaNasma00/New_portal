<?php
include 'db_connect.php';

function logDeletedDocument($conn, $id) {
    // Select the document to be deleted
    $qry = "SELECT * FROM documents WHERE id=$id";
    $result = mysqli_query($conn, $qry);
    if ($row = mysqli_fetch_assoc($result)) {
        // Prepare the data for insertion into the history table
        $ref_no = $row['ref_no'];
        $title = $row['title'];
        $last_name = $row['last_name'];
        $phonenumber = $row['phonenumber'];
        $email = $row['email'];
        $job = $row['job'];
        $tag = $row['tag'];
        $position = $row['position'];
        $industry = $row['industry'];
        $description = $row['description'];
        $file_json = $row['file_json'];
        $user_id = $row['user_id'];
        $date = $row['date'];
        $time = $row['time'];
        $recruiter = $row['recruiter'];
        $date_created = $row['date_created'];
        $status = $row['status'];
        $accesby = $row['accesby'];
        $accdt = $row['accdt'];
        $reject_resons = $row['reject_resons'];
        $created_datetime = $row['created_datetime'];

        // Insert the data into the history table
        $insertQry = "INSERT INTO documents_deletedhistory 
                      (id, ref_no, title, last_name, phonenumber, email, job, tag, position, industry, description, file_json, user_id, date, time, recruiter, date_created, status, accesby, accdt, reject_resons, created_datetime) 
                      VALUES 
                      ($id, '$ref_no', '$title', '$last_name', '$phonenumber', '$email', '$job', '$tag', '$position', '$industry', '$description', '$file_json', $user_id, '$date', '$time', '$recruiter', '$date_created', '$status', '$accesby', '$accdt', '$reject_resons', '$created_datetime')";
        mysqli_query($conn, $insertQry);
    }
}

if(isset($_GET['delete_id'])) {
    $id= $_GET['delete_id'];
    logDeletedDocument($conn, $id);
    $qry ="DELETE FROM documents WHERE id=$id";
    mysqli_query($conn,$qry);
    session_start();
    $_SESSION['datastatusz'] = "Data Deleted Successfully";
    header("location:index2.php?page=adminalldocs");
}
?>
<?php
include 'db_connect.php';

if(isset($_GET['deletereject_id'])) {
    $id= $_GET['deletereject_id'];
    logDeletedDocument($conn, $id);
    $qry ="DELETE FROM documents WHERE id=$id";
    mysqli_query($conn,$qry);
    session_start();
    $_SESSION['dataadminstatusz'] = "Data Deleted Successfully";
    header("location:index2.php?page=adminreject");
}
?>
