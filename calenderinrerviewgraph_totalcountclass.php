<?php
include('db_connect.php');
date_default_timezone_set("Asia/Colombo");

if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = intval($_GET['month']);
    $year = intval($_GET['year']);

    // Query for event data grouped by date
    $query = $conn->query("SELECT 
                                DATE(start_datetime) AS event_date, 
                                COUNT(*) AS total_records, 
                                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS completed_count, 
                                SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS not_completed_count,
                                SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS rescheduled_count
                            FROM 
                                events_calender 
                            WHERE 
                                MONTH(start_datetime) = $month AND YEAR(start_datetime) = $year
                            GROUP BY 
                                DATE(start_datetime)");
    
    $data = [];
    while ($row = $query->fetch_assoc()) {
        $formattedDate = date("M-d", strtotime($row['event_date']));
        $data[$formattedDate] = [
            'total_records' => $row['total_records'],
            'completed_count' => $row['completed_count'],
            'not_completed_count' => $row['not_completed_count'],
            'rescheduled_count' => $row['rescheduled_count']
        ];
    }

    // Totals for the current month excluding Rescheduled interviews from Scheduled
    $totalQuery = $conn->query("SELECT 
                                    COUNT(*) AS scheduled, 
                                    SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS completed,
                                    SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS not_completed,
                                    SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS rescheduled 
                                FROM 
                                    events_calender 
                                WHERE 
                                    MONTH(start_datetime) = $month AND YEAR(start_datetime) = $year");
    $totals = $totalQuery->fetch_assoc();

    // Totals for the previous month excluding Rescheduled interviews from Scheduled
    $previousMonth = $month - 1;
    $previousYear = $year;

    if ($previousMonth < 1) {
        $previousMonth = 12;
        $previousYear--;
    }

    $previousQuery = $conn->query("SELECT 
                                        COUNT(*) AS scheduled, 
                                        SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS completed,
                                        SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS not_completed,
                                        SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS rescheduled
                                    FROM 
                                        events_calender 
                                    WHERE 
                                        MONTH(start_datetime) = $previousMonth AND YEAR(start_datetime) = $previousYear");
    $previousTotals = $previousQuery->fetch_assoc();

    echo json_encode([
        'data' => $data,
        'totals' => [
            'scheduled' => $totals['scheduled'] ?? 0,
            'completed' => $totals['completed'] ?? 0,
            'not_completed' => $totals['not_completed'] ?? 0,
            'rescheduled' => $totals['rescheduled'] ?? 0
        ],
        'previousTotals' => [
            'scheduled' => $previousTotals['scheduled'] ?? 0,
            'completed' => $previousTotals['completed'] ?? 0,
            'not_completed' => $previousTotals['not_completed'] ?? 0,
            'rescheduled' => $previousTotals['rescheduled'] ?? 0
        ]
    ]);
}
?>
