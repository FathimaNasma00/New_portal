<?php
include 'event_dppdo.php'; // Assuming this file contains your database connection

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set("Asia/Colombo");
    $datetime = date("Y-m-d H:i:sa");
  
    $eventId = $_POST['eventId'];
    $status = $_POST['status'];

    // Prepare and execute SQL statement to update event status and status_updatetime
    $sql = "UPDATE events_calender SET status = ?, status_updatetime = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$status, $datetime, $eventId]);

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();

    // Redirect to the same page
    header("location:index2.php");
    exit; // Stop further execution
} else {
    // Invalid request method
    echo "Invalid request method";
    exit; // Stop further execution
}
?>
