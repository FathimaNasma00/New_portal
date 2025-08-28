<?php
// Establish a database connection (replace the placeholders with your actual database credentials)
$db_host = 'localhost';
$db_name = 'mvjobvac_mycareers';
$db_user = 'mvjobvac_mycareers';
$db_pass = 'LkCarrers@123';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // Get the data from the AJAX request
    $fileId = $_POST['fileId'];
    $downloadCount = $_POST['downloadCount'];
    $ipAddress = $_POST['ipAddress'];
    $userid = $_POST['userid'];
    $date = date("Y-m-d");

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO count_download (file_id, ip_address, count, user_id, download_date) VALUES (:file_id, :ip_address, :download_count, :user_id, :download_date)");
    $stmt->bindParam(':file_id', $fileId);
    $stmt->bindParam(':ip_address', $ipAddress);
    $stmt->bindParam(':download_count', $downloadCount);
    $stmt->bindParam(':user_id', $userid);
    $stmt->bindParam(':download_date', $date);
    $stmt->execute();

    // Output a success response
    echo 'success';
} catch (PDOException $e) {
    // Output an error response and display the error message
    echo 'error: ' . $e->getMessage();
}
?>





