<?php
include('db_connect.php');

if(isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];

    $data = getEventData($month, $year, $conn);
    echo json_encode($data);
}

function getEventData($month, $year, $conn) {
    $sql = "SELECT 
                DATE(start_datetime) AS event_date, 
                COUNT(*) AS total_records, 
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count
            FROM 
                events_calender 
            WHERE 
                MONTH(start_datetime) = $month AND YEAR(start_datetime) = $year
            GROUP BY 
                DATE(start_datetime)";

    $result = $conn->query($sql);
    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $formattedDate = date("M-d", strtotime($row['event_date']));
            $data[$formattedDate] = array(
                'total_records' => $row['total_records'],
                'status_1_count' => $row['status_1_count']
            );
        }
    }

    return $data;
}
?>
