<?php include('db_connect.php'); ?>                                     
<div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .navigation-btn:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Box shadow effect on hover */
        }
    </style>
    <button class="navigation-btn" onclick="previousMonth()"><i class="bi bi-arrow-left"></i></button>
    <button class="navigation-btn" onclick="nextMonth()"><i class="bi bi-arrow-right"></i></button>
    
    <!-- Current Month Totals -->
    <div id="previousMonthTotals" style="position: absolute; top: 10px; right: 300px; background-color: #f0f0f0; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    <span>Loading...</span>
    </div>
    
    <div id="currentMonthTotals" style="position: absolute; top: 10px; right: 10px; background-color: #f0f0f0; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <span>Loading...</span>
    </div>


    <br><br><br>
   
    <div>
        <canvas id="myChart"></canvas>
    </div>

    <?php
    date_default_timezone_set("Asia/Colombo");
    $currentDate = date("Y-m-d");
    $currentMonth = date("m", strtotime($currentDate));
    $currentYear = date("Y", strtotime($currentDate));
    ?>

    <script>
        var currentMonth = <?php echo $currentMonth; ?>;
        var currentYear = <?php echo $currentYear; ?>;
        var chart;

 // Function to update chart and totals dynamically
function updateChart(month, year) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            var newData = response.data;
            var totals = response.totals;
            var previousTotals = response.previousTotals;

            // Update current month totals (exclude Rescheduled from Total Scheduled)
            document.querySelector("#currentMonthTotals").innerHTML = `
                <span style='font-size:12px;font-weight:100;'><b>Current Month Totals:</b></span><br>
                Scheduled Interviews: <b>${totals.scheduled}</b><br>
                Completed Interviews: <b>${totals.completed}</b><br>
                Not Completed Interviews: <b>${totals.not_completed}</b><br>
                Rescheduled Interviews: <b>${totals.rescheduled}</b>`;

            // Update previous month totals (exclude Rescheduled from Total Scheduled)
            document.querySelector("#previousMonthTotals").innerHTML = `
                <span style='font-size:12px;font-weight:100;'><b>Previous Month Totals:</b></span><br>
                Scheduled Interviews: <b>${previousTotals.scheduled}</b><br>
                Completed Interviews: <b>${previousTotals.completed}</b><br>
                Not Completed Interviews: <b>${previousTotals.not_completed}</b><br>
                Rescheduled Interviews: <b>${previousTotals.rescheduled}</b>`;

            // Update chart data
            var dates = Object.keys(newData);
            var totalRecordsData = dates.map(date => newData[date]['total_records']);
            var completedData = dates.map(date => newData[date]['completed_count']);
            var notCompletedData = dates.map(date => newData[date]['not_completed_count']);
            var rescheduledData = dates.map(date => newData[date]['rescheduled_count']);

            chart.data.labels = dates;
            chart.data.datasets[0].data = totalRecordsData;
            chart.data.datasets[1].data = completedData;
            chart.data.datasets[2].data = rescheduledData;
            chart.data.datasets[3].data = notCompletedData; 
            chart.update();
        }
    };
    xhttp.open("GET", `calenderinrerviewgraph_totalcountclass.php?month=${month}&year=${year}`, true);
    xhttp.send();
}
function previousMonth() {
    currentMonth--;
    if (currentMonth < 1) {
        currentMonth = 12;
        currentYear--;
    }
    updateChart(currentMonth, currentYear);
}

function nextMonth() {
    currentMonth++;
    if (currentMonth > 12) {
        currentMonth = 1;
        currentYear++;
    }
    updateChart(currentMonth, currentYear);
}


// Initialize Chart.js
var ctx = document.getElementById('myChart').getContext('2d');
chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [], 
        datasets: [
            {
                label: 'Scheduled',
                data: [], // Dynamically updated
                borderColor: 'rgba(31, 138, 173, 1)',
                backgroundColor: 'rgba(31, 138, 173, 0.2)',
                tension: 0.1,
                yAxisID: 'y'
            },
            {
                label: 'Completed',
                data: [], // Dynamically updated
                borderColor: 'rgba(51, 145, 76, 1)',
                backgroundColor: 'rgba(51, 145, 76, 0.2)',
                tension: 0.1,
                yAxisID: 'y'
            },
            {
                label: 'Rescheduled',
                data: [], // Dynamically updated
                borderColor: 'rgba(92, 51, 145, 3)', // Rescheduled color
                backgroundColor: 'rgba(92, 51, 145, 0.6)',
                tension: 0.1,
                yAxisID: 'y'
            },
            {
                label: 'Not Completed ',
                data: [], // Dynamically updated
                borderColor: 'rgba(255, 99, 71, 1)', // Not Completed color
                backgroundColor: 'rgba(255, 99, 71, 0.2)',
                tension: 0.1,
                yAxisID: 'y'
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Load current month data on page load
updateChart(currentMonth, currentYear);

    </script>
</div>
