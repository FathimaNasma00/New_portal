 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <div>
        <canvas id="myCvChartGarph"></canvas>
    </div>
<?php
include('db_connect.php');
date_default_timezone_set("Asia/Colombo");

// SQL query to retrieve feedback count for each month
$sql = "SELECT 
            YEAR(candidate_summery.date) AS year,
            MONTH(candidate_summery.date) AS month,
            COUNT(candidate_summery.id) AS total_feedback_count
        FROM 
            candidate_summery 
        WHERE 
            candidate_summery.user_id = '15'
            AND candidate_summery.feedback = 'ClientReview' 
        GROUP BY 
            YEAR(candidate_summery.date),
            MONTH(candidate_summery.date)
        ORDER BY 
            YEAR(candidate_summery.date),
            MONTH(candidate_summery.date)";

$resultcv = $conn->query($sql);
$data = array();

if ($result->num_rows > 0) {
    while ($row = $resultcv->fetch_assoc()) {
        $datacv[] = array(
            'year' => $row['year'],
            'month' => $row['month'],
            'total_feedback_count' => $row['total_feedback_count']
        );
    }
}
?>

<script>
    var feedbackDataCV = <?php echo json_encode($datacv); ?>;
    var cvmonths = [];
    var cvcounts = [];

    feedbackDataCV.forEach(function(item) {
        cvmonths.push(item.year + '-' + item.month);
        cvcounts.push(item.total_feedback_count);
    });

    var ctx = document.getElementById('myCvChartGarph').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Total Feedback Count',
                data: counts,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
