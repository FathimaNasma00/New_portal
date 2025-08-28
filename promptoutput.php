<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user's query from the form
    $userQuery = htmlspecialchars($_POST['userQuery']);

    // Prepare the API URL with the user's query
    $apiUrl = 'https://promptaisearch-dnd3b8fccnacebgb.canadacentral-01.azurewebsites.net/search_cv?query=' . urlencode($userQuery);

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'accept: application/json',
    ]);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo "Error in API request: " . curl_error($ch);
    } else {
        // Parse and display the API response
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($statusCode === 200) {
            $responseData = json_decode($response, true);
            if (!empty($responseData)) {
                // Save data to session
                session_start();
                $_SESSION['api_data'] = $responseData;

                // Redirect to the view page with the session data
                header("Location: https://mycareers.lk/index2.php?page=prompthuntview");
                exit();
            } else {
                echo "<h2>No data received from API.</h2>";
            }
        } else {
            echo "<h2>Error:</h2>";
            echo "<p>Received HTTP status code " . $statusCode . "</p>";
        }
    }

    // Close cURL session
    curl_close($ch);
}
?>
