<?php
include 'db_connect.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = (int) $_POST['id']; // Ensure ID is an integer
    $status = (int) $_POST['status']; // Ensure status is an integer
    $newDate = isset($_POST['new_date']) ? $_POST['new_date'] : null;

    // Debugging: Log received data
    error_log("Received ID: $id, Status: $status, New Date: " . ($newDate ? $newDate : "NULL"));

    // Fetch current event data before updating
    $query = "SELECT * FROM events_calender WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error fetching event data: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        die("Error: Event with ID $id not found.");
    }

    // Insert old event data into history table
    $insertQuery = "INSERT INTO eventscalender_roadmap 
                    (id, title, description, meeting_type, url, start_datetime, end_datetime, jb_recuiters, user_id, candidate_id, client_id, job_id, status, status_updatetime, created_date) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param(
        $stmt, 
        "isssssssssssss",
        $id,
        $row['title'], 
        $row['description'], 
        $row['meeting_type'], 
        $row['url'], 
        $row['start_datetime'], 
        $row['end_datetime'], 
        $row['jb_recuiters'], 
        $row['user_id'], 
        $row['candidate_id'], 
        $row['client_id'], 
        $row['job_id'], 
        $row['status'], 
        $row['created_date']
    );

    if (!mysqli_stmt_execute($stmt)) {
        die("Error inserting into history: " . mysqli_error($conn));
    }

    // Update the main table with new status and date (if rescheduled)
    if ($newDate) {
        $updateQuery = "UPDATE events_calender SET status = ?, start_datetime = ?, status_updatetime = NOW() WHERE id = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "ssi", $status, $newDate, $id);
    } else {
        $updateQuery = "UPDATE events_calender SET status = ?, status_updatetime = NOW() WHERE id = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "ii", $status, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "Success";
    } else {
        die("Error updating event: " . mysqli_error($conn));
    }
} else {
    die("Invalid request: Missing parameters.");
}
?>
